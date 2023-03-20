<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

function send_email($to_email, $to_name) {
    $mail = new PHPMailer(true);

 try {

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'lsurahman157@gmail.com';
    $mail->Password   = 'whhkejqqufkmbibt';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('lsurahman157@gmail.com', 'Lsu Online Tutoring Site');
    $mail->addAddress($to_email, $to_email);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Email Confirmation for Online Tutor';
    $mail->Body = '<i>Mail body in HTML</i><br><br>' .
              'Click the link below to verify your email:<br>' .
              '<a href="localhost/website/verify.php?code=' . $to_email . '">Verify Email</a>';
    $mail->AltBody = 'This is the plain text version of the email content';

    $mail->send();
    echo 'Message has been sent';
    return true;
    } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}



?>
