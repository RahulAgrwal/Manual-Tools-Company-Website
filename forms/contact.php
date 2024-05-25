<?php
include_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if the form has already been submitted in this session

  // Set session flag to indicate form submission
  $_SESSION['form_submitted'] = true;

  // Get the form fields
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $company_name = $_POST['company_name'];
  $company_gstin = $_POST['company_gstin'];
  $contact = $_POST['contact'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  try {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    // Server settings
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true; // Enable SMTP authentication
    $mail->Username   = 'manualtoolsco.dhn@gmail.com'; // SMTP username
    $mail->Password   = 'mynyxuwmsctnfglq'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587; // TCP port to connect to

    // Recipients
    $mail->setFrom('manualtoolsco.dhn@gmail.com', 'MANUAL TOOLS COMPANY'); // Sender's email address and name
    $mail->addAddress($email, $first_name . " " . $last_name); // Recipient's email address and name
    // Add CC recipient
    $mail->addCC('ravindrakumaragarwal@rocketmail.com', 'Ravindra Kumar Agarwal'); // CC recipient's email address and name

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = "First Name: $first_name<br>Last Name: $last_name<br>Company Name: $company_name<br>Company GSTIN: $company_gstin<br>Contact: $contact<br>Address: $address<br><br>Message:<br>$message";

    // Send the email
    $mail->send();

    $response = array('success' => true, 'message' => 'Your message has been sent. Thank you!');
    echo json_encode($response);
  } catch (Exception $e) {
    $response = array('success' => false, 'message' => 'Failed to send email. Please try again later.');
    echo json_encode($response);
  }
}
