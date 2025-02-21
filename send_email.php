<?php
// Include PHPMailer for SMTP mail
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];



    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'mail.leafbloom.in';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'admin@leafbloom.in';  // SMTP username
        $mail->Password   = 'India@4321'; // SMTP password (replace with your email password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 465;                   // TCP port to connect to

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('admin@leafbloom.in'); // Add a recipient, replace with your email address

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'New Contact Form Query From : '.$name;
        $mail->Body    = "<p>Name: $name</p><p>Email: $email</p><p>Phone: $phone</p><p>Message: $message</p>";

        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Message has been sent']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);

}
?>
