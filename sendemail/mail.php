<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

function send_email($to_email, $to_name) {
    $mail = new PHPMailer(true);

    try {
    //Server settings
   // $mail->SMTPDebug = 2;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'lsurahman157@gmail.com';                     // SMTP username
    $mail->Password   = '';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('lsurahman157@gmail.com', 'Lsu Online Tutoring Site');
    $mail->addAddress($to_email, $to_email);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Email Confirmation for Online Tutor';
    $mail->Body = '<i>Mail body in HTML</i><br><br>' .
              'Click the link below to verify your email:<br>' .
              '<a href="localhost/tutoronline/verify.php?code=' . $verification_code . '">Verify Email</a>';
    $mail->AltBody = 'This is the plain text version of the email content';

    $mail->send();
    echo 'Message has been sent';
    } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}



?>
