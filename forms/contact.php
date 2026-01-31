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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start(); 

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Get the form fields and sanitize slightly to prevent breaking HTML
  $first_name = htmlspecialchars($_POST['first_name'] ?? '');
  $last_name = htmlspecialchars($_POST['last_name'] ?? '');
  $company_name = htmlspecialchars($_POST['company_name'] ?? '');
  $company_gstin = htmlspecialchars($_POST['company_gstin'] ?? '');
  $contact = htmlspecialchars($_POST['contact'] ?? '');
  $address = htmlspecialchars($_POST['address'] ?? '');
  $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
  $subject = htmlspecialchars($_POST['subject'] ?? '');
  $message = nl2br(htmlspecialchars($_POST['message'] ?? ''));

  // Your HTML Body
  $body = "
  <body class='bg-light'>
  <div class='container'>   
    <div class='card my-10'>
      <a href='https://manualtoolsco.com' target='_blank'>
        <img src='https://manualtoolsco.com/assets/img/MTC%20Logo.png' style='height:40px;' alt='Logo'/>
      </a>
      <div class='card-body'>
        <h2 class='h3 mb-2'>Thank you for contacting us</h2>
        <hr>
        <table style='width: 100%; border-collapse: collapse;'>
          <tbody>
            <tr><td style='padding: 5px; font-weight:bold;'>Name:</td><td style='padding: 5px;'>$first_name $last_name</td></tr>
            <tr><td style='padding: 5px; font-weight:bold;'>Company Name:</td><td style='padding: 5px;'>$company_name</td></tr>
            <tr><td style='padding: 5px; font-weight:bold;'>GSTIN:</td><td style='padding: 5px;'>$company_gstin</td></tr>
            <tr><td style='padding: 5px; font-weight:bold;'>Contact:</td><td style='padding: 5px;'>$contact</td></tr>
            <tr><td style='padding: 5px; font-weight:bold;'>Address:</td><td style='padding: 5px;'>$address</td></tr>
            <tr><td style='padding: 5px; font-weight:bold;'>Email:</td><td style='padding: 5px;'>$email</td></tr>
            <tr><td style='padding: 5px; font-weight:bold;'>Subject:</td><td style='padding: 5px;'>$subject</td></tr>
            <tr><td style='padding: 5px; font-weight:bold;'>Requirement:</td><td style='padding: 5px;'>$message</td></tr>
          </tbody>
        </table>
        <hr>
        <p class='text-gray-700'>We will reach out to you after reviewing your requirements.</p>
        <p class='text-gray-700'>Check out other <a href='https://manualtoolsco.com/products.php' target='_blank'>Products</a> to know more.</p>
      </div>
    </div>
  </div>
  </body>";

  try {
    $mail = new PHPMailer(true);

    // Server settings
    $mail->isSMTP(); 
    $mail->Host       = 'smtp.gmail.com'; 
    $mail->SMTPAuth   = true; 
    $mail->Username   = 'manualtoolsco.dhn@gmail.com'; 
    $mail->Password   = 'mynyxuwmsctnfglq'; // Ensure this App Password is correct
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Port       = 587; 

    // Recipients
    $mail->setFrom('manualtoolsco.dhn@gmail.com', 'MANUAL TOOLS COMPANY'); 
    
    if($email) {
        $mail->addAddress($email, "$first_name $last_name"); 
    }
    
    // Add CC
    $mail->addCC('ravindrakumaragarwal@rocketmail.com', 'Ravindra Kumar Agarwal'); 

    // Content
    $mail->isHTML(true); 
    $mail->Subject = $subject;
    $mail->Body    = $body;

    $mail->send();

    $response = array('success' => true, 'message' => 'Your message has been sent. Thank you!');

  } catch (Exception $e) {
    // Return the detailed error from PHPMailer so you can debug
    $errorMsg = $mail->ErrorInfo ?: $e->getMessage();
    $response = array('success' => false, 'message' => 'Mailer Error: ' . $errorMsg);
  }

} else {
    $response = array('success' => false, 'message' => 'Invalid Request Method');
}

// 4. Clean Buffer and Output JSON
ob_end_clean(); 
echo json_encode($response);
?>