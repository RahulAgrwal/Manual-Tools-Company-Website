<?php
// 1. Prevent stray text/errors from breaking JSON
ob_start(); 

// 2. Set Header
header('Content-Type: application/json');

// 3. Check if Vendor folder exists (Common cause of crash)
if (!file_exists('../vendor/autoload.php')) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Server Error: vendor folder missing. Please upload the vendor directory.']);
    exit;
}

include_once '../vendor/autoload.php';
require_once __DIR__ . '/../load-secrets.php';

$secrets = mtc_secrets();
if (empty($secrets['smtp_pass']) || empty($secrets['recaptcha_secret'])) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Server Error: mail configuration missing. Please contact us by phone or email.']);
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start(); 

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $recaptchaSecret = $secrets['recaptcha_secret'];
  $recaptchaToken = trim($_POST['g-recaptcha-response'] ?? '');
  $expectedRecaptchaAction = trim($_POST['recaptcha_action'] ?? '');
  $minimumRecaptchaScore = 0.5;

  if ($recaptchaSecret === '' || $recaptchaToken === '') {
    $response = array('success' => false, 'message' => 'reCAPTCHA verification failed. Please try again.');
    ob_end_clean();
    echo json_encode($response);
    exit;
  }

  $verifyPostData = http_build_query([
    'secret' => $recaptchaSecret,
    'response' => $recaptchaToken,
    'remoteip' => $_SERVER['REMOTE_ADDR'] ?? ''
  ]);

  $verifyContext = stream_context_create([
    'http' => [
      'method' => 'POST',
      'header' => "Content-type: application/x-www-form-urlencoded\r\n",
      'content' => $verifyPostData,
      'timeout' => 10
    ]
  ]);

  $verifyResult = @file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $verifyContext);
  $verifyJson = json_decode($verifyResult ?? '', true);

  if (empty($verifyJson['success'])) {
    $response = array('success' => false, 'message' => 'reCAPTCHA validation failed. Please retry.');
    ob_end_clean();
    echo json_encode($response);
    exit;
  }

  if (!isset($verifyJson['score'])) {
    $response = array('success' => false, 'message' => 'Invalid reCAPTCHA key type. Please use reCAPTCHA v3 keys.');
    ob_end_clean();
    echo json_encode($response);
    exit;
  }

  if ((float)$verifyJson['score'] < $minimumRecaptchaScore) {
    $response = array('success' => false, 'message' => 'Submission blocked by spam protection. Please try again.');
    ob_end_clean();
    echo json_encode($response);
    exit;
  }

  if ($expectedRecaptchaAction !== '' && !empty($verifyJson['action']) && $verifyJson['action'] !== $expectedRecaptchaAction) {
    $response = array('success' => false, 'message' => 'Security action mismatch. Please refresh and try again.');
    ob_end_clean();
    echo json_encode($response);
    exit;
  }

  // Raw values (trimmed, single-line where appropriate) - escaped separately for HTML below
  $oneLine = function ($key) {
    return trim(preg_replace('/[\r\n]+/', ' ', (string)($_POST[$key] ?? '')));
  };
  $raw_first_name = $oneLine('first_name');
  $raw_last_name  = $oneLine('last_name');
  $raw_subject    = $oneLine('subject');
  $raw_source     = $oneLine('source_page');
  $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);

  if ($raw_first_name === '' || !$email) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Please enter your name and a valid email address.']);
    exit;
  }

  // HTML-escaped values for the email body
  $first_name = htmlspecialchars($raw_first_name);
  $last_name = htmlspecialchars($raw_last_name);
  $company_name = htmlspecialchars($_POST['company_name'] ?? '');
  $company_gstin = htmlspecialchars($_POST['company_gstin'] ?? '');
  $contact = htmlspecialchars($_POST['contact'] ?? '');
  $address = htmlspecialchars($_POST['address'] ?? '');
  $email_html = htmlspecialchars($email);
  $subject = htmlspecialchars($raw_subject);
  $source_page = htmlspecialchars($raw_source);
  $message = nl2br(htmlspecialchars($_POST['message'] ?? ''));

  // Enquiry email to the company (contains the visitor's details)
  $body = "
  <body style='font-family: Arial, sans-serif; color:#333;'>
    <a href='https://www.manualtoolsco.com' target='_blank'>
      <img src='https://www.manualtoolsco.com/assets/img/MTC%20Logo.png' style='height:40px;' alt='Logo'/>
    </a>
    <h2 style='margin:16px 0 8px;'>New enquiry from the website</h2>
    <p style='margin:0 0 12px; color:#777;'>Reply to this email to respond directly to the customer.</p>
    <hr>
    <table style='width: 100%; border-collapse: collapse;'>
      <tbody>
        <tr><td style='padding: 5px; font-weight:bold; width:150px;'>Name:</td><td style='padding: 5px;'>$first_name $last_name</td></tr>
        <tr><td style='padding: 5px; font-weight:bold;'>Email:</td><td style='padding: 5px;'>$email_html</td></tr>
        <tr><td style='padding: 5px; font-weight:bold;'>Contact:</td><td style='padding: 5px;'>$contact</td></tr>
        <tr><td style='padding: 5px; font-weight:bold;'>Company Name:</td><td style='padding: 5px;'>$company_name</td></tr>
        <tr><td style='padding: 5px; font-weight:bold;'>GSTIN:</td><td style='padding: 5px;'>$company_gstin</td></tr>
        <tr><td style='padding: 5px; font-weight:bold;'>Address:</td><td style='padding: 5px;'>$address</td></tr>
        <tr><td style='padding: 5px; font-weight:bold;'>Subject:</td><td style='padding: 5px;'>$subject</td></tr>
        <tr><td style='padding: 5px; font-weight:bold;'>Submitted from:</td><td style='padding: 5px;'>$source_page</td></tr>
        <tr><td style='padding: 5px; font-weight:bold; vertical-align:top;'>Requirement:</td><td style='padding: 5px;'>$message</td></tr>
      </tbody>
    </table>
  </body>";

  // Fixed confirmation to the visitor - intentionally contains NO user-supplied text,
  // so the form cannot be used to send arbitrary content to arbitrary addresses.
  $confirmationBody = "
  <body style='font-family: Arial, sans-serif; color:#333;'>
    <a href='https://www.manualtoolsco.com' target='_blank'>
      <img src='https://www.manualtoolsco.com/assets/img/MTC%20Logo.png' style='height:40px;' alt='Logo'/>
    </a>
    <h2 style='margin:16px 0 8px;'>Thank you for contacting Manual Tools Company</h2>
    <p>We have received your enquiry. Our team will review your requirements and get back to you shortly.</p>
    <p>For urgent requirements, call us at <strong>+91 94307 07348</strong>.</p>
    <p>Explore our <a href='https://www.manualtoolsco.com/products' target='_blank'>products</a>.</p>
    <hr>
    <p style='font-size:12px; color:#999;'>Manual Tools Company, Bastacolla, P.O. Dhansar, Dhanbad - 828106, Jharkhand</p>
  </body>";

  $newMailer = function () use ($secrets) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $secrets['smtp_user'];
    $mail->Password   = $secrets['smtp_pass']; // Google App Password, stored in secrets file
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->CharSet    = 'UTF-8';
    $mail->setFrom($secrets['smtp_user'], 'MANUAL TOOLS COMPANY');
    $mail->isHTML(true);
    return $mail;
  };

  $visitorName = trim("$raw_first_name $raw_last_name");

  try {
    // 1. Enquiry to the company; Reply-To is the visitor
    $mail = $newMailer();
    $mail->addAddress($secrets['smtp_user'], 'Manual Tools Company');
    $mail->addCC('ravindrakumaragarwal@rocketmail.com', 'Ravindra Kumar Agarwal');
    $mail->addReplyTo($email, $visitorName);
    $mail->Subject = 'Website Enquiry: ' . ($raw_subject !== '' ? $raw_subject : $visitorName);
    $mail->Body    = $body;
    $mail->send();

    $response = array('success' => true, 'message' => 'Your message has been sent. Thank you!');
  } catch (Exception $e) {
    // Log details server-side; don't expose mailer internals to visitors
    error_log('contact form: ' . (isset($mail) && $mail->ErrorInfo ? $mail->ErrorInfo : $e->getMessage()));
    $response = array('success' => false, 'message' => 'Sorry, we could not send your message. Please call +91 94307 07348 or email manualtoolsco.dhn@gmail.com.');
  }

  // 2. Fixed confirmation to the visitor (best effort - failure doesn't affect the enquiry)
  if ($response['success']) {
    try {
      $confirm = $newMailer();
      $confirm->addAddress($email, $visitorName);
      $confirm->Subject = 'We received your enquiry - Manual Tools Company';
      $confirm->Body    = $confirmationBody;
      $confirm->send();
    } catch (Exception $e) {
      error_log('contact form confirmation: ' . (isset($confirm) && $confirm->ErrorInfo ? $confirm->ErrorInfo : $e->getMessage()));
    }
  }

} else {
    $response = array('success' => false, 'message' => 'Invalid Request Method');
}

// 4. Clean Buffer and Output JSON
ob_end_clean(); 
echo json_encode($response);
?>