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
    $mail->Password   = 'aiycioojjoessscp';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('lsurahman157@gmail.com', 'Lsu Online Tutoring Site');
    $mail->addAddress($to_email, $to_email);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = '[Online Tutoring System] Student Account Activation - Please Confirm Your Email';


    // $mail->Body = '<i>Confirmation Email for Student Account Activation</i><br><br>' .
    //           'Click the link below to verify your email:<br>' .
    //           '<a href="http://phpapplication-env.eba-mrbqpmvh.us-east-1.elasticbeanstalk.com/verify.php?code=' . $to_email . '">Verify Email</a>';

    $mail->Body = '<html>

    <head>
      <style>
        body {
          font-family: Arial, sans-serif;
          line-height: 1.6;
          color: #333;
          background-color: #f6f6f6;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
          }
          
          .header {
            text-align: center;
            margin-bottom: 20px;
          }
          
          .header img {
            max-width: 150px;
          }
          
          .content {
            text-align: left;
          }
          
          .button {
            display: inline-block;
            font-weight: bold;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #ffffff;
            margin-top: 15px;
          }
          
          .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9em;
          }
          </style>
          </head>
          <body>
            <div class="container">
              <div class="header">
                <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="Your University Logo">
              </div>
              <div class="content">
              <h2>Confirm Your Email to Activate Your Student Account</h2>
              <p>Dear Student,</p>
              <p>Thank you for registering with Lsu Online Portal. Please confirm your email address to activate your student account. Once activated, you will be able to access university services and resources.</p>
              <p>To confirm your email address, please click the button below:</p>
              <a href="http://phpapplication-env.eba-mrbqpmvh.us-east-1.elasticbeanstalk.com/verify.php?code=' . $to_email . '" class="button">Verify Email</a>
              <p>If the button above does not work, please copy and paste the following link into your browser:</p>
              <p>http://phpapplication-env.eba-mrbqpmvh.us-east-1.elasticbeanstalk.com/verify.php?code=' . $to_email . '</p>
              <p>Once your email is confirmed, you will be able to access your student account and start enjoying the benefits of being a student at Lsu Online Portal.</p>
              <p>If you did not register for a student account, please ignore this email.</p>
              <p>Best regards,</p>
              <p>Online Tutoring System <p>
            </div>
            
            <div class="footer">
              <p>&copy; Online Tutoring Sytem, All rights reserved.</p>
              <p>1315 Bob Pettit Blvd, Baton Rouge, 70820</p>
            </div>
            
            </div>
            </body>
            </html>';



    $mail->AltBody = 'Dear Student,

    Thank you for registering with Online Tutoring System. Please confirm your email address to activate your student account. Once activated, you will be able to access university services and resources.
    To confirm your email address, please copy and paste the following link into your browser:
    http://phpapplication-env.eba-mrbqpmvh.us-east-1.elasticbeanstalk.com/verify.php?code=' . $to_email . '
    
    Once your email is confirmed, you will be able to access your student account and start enjoying the benefits of being a student at Lsu Online';

    $mail->send();
    echo 'Message has been sent';
    return true;
    } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}



function send_tutor_email($to_email, $to_name) {
    $mail = new PHPMailer(true);

 try {

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'lsurahman157@gmail.com';
    $mail->Password   = 'aiycioojjoessscp';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('lsurahman157@gmail.com', 'Lsu Online Tutoring Site');
    $mail->addAddress($to_email, $to_email);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Email Confirmation for Online Tutor';
    // $mail->Body = '<i>Mail body in HTML</i><br><br>' .
    //           'Click the link below to verify your email:<br>' .
    //           '';

    $mail->Body = '<html>
    <head>
      <style>
        body {
          font-family: Arial, sans-serif;
          line-height: 1.6;
          color: #333;
          background-color: #f6f6f6;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
          }
          
          .header {
            text-align: center;
            margin-bottom: 20px;
          }
          
          .header img {
            max-width: 150px;
          }
          
          .content {
            text-align: left;
          }
          
          .button {
            display: inline-block;
            font-weight: bold;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #ffffff;
            margin-top: 15px;
          }
          
          .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9em;
          }
          </style>
          </head>
          <body>
            <div class="container">
              <div class="header">
                <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="Your University Logo">
              </div>
              <div class="content">
              <h2> Your Credential for Tutor Account</h2>
              <p>Dear Tutor,</p>
             
              <p>An Account for Tutor Account is Created</p>
              <a href="http://phpapplication-env.eba-mrbqpmvh.us-east-1.elasticbeanstalk.com/admin" class="button">Login</a>
              <p>If the button above does not work, please copy and paste the following link into your browser:</p>
              <p>http://phpapplication-env.eba-mrbqpmvh.us-east-1.elasticbeanstalk.com/admin</p>
              <p>Your One time Password is: 123456</p>
              <p>
              <p>http://localhost/andrewgit/admin</p>
           
              <p>Best regards,</p>
              <p>Online Tutoring System<p>
            </div>
            
            <div class="footer">
              <p>&copy; Online Tutoring Sytem, All rights reserved.</p>
              <p>1315 Bob Pettit Blvd, Baton Rouge, 70820</p>
            </div>
            
            </div>
            </body>
            </html>';


    
    
            $mail->AltBody = 'This is the plain text version of the email content';

    $mail->send();
    return true;
    } catch (Exception $e) {
    return false;
    }
}




function send_appointment_email($to_email, $to_name) {
    $mail = new PHPMailer(true);

 try {

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'lsurahman157@gmail.com';
    $mail->Password   = 'aiycioojjoessscp';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('lsurahman157@gmail.com', 'Lsu Online Tutoring Site');
    $mail->addAddress($to_email, $to_email);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Appointment Request';



              $mail->Body = '<html>
              <head>
                <style>
                  body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    color: #333;
                    background-color: #f6f6f6;
                  }
                  .container {
                      max-width: 600px;
                      margin: 30px auto;
                      padding: 20px;
                      background-color: #ffffff;
                      border-radius: 5px;
                      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                    }
                    
                    .header {
                      text-align: center;
                      margin-bottom: 20px;
                    }
                    
                    .header img {
                      max-width: 150px;
                    }
                    
                    .content {
                      text-align: left;
                    }
                    
                    .button {
                      display: inline-block;
                      font-weight: bold;
                      text-decoration: none;
                      padding: 12px 24px;
                      border-radius: 5px;
                      background-color: #4CAF50;
                      color: #ffffff;
                      margin-top: 15px;
                    }
                    
                    .footer {
                      text-align: center;
                      margin-top: 30px;
                      font-size: 0.9em;
                    }
                    </style>
                    </head>
                    <body>
                      <div class="container">
                        <div class="header">
                          <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="Your University Logo">
                        </div>
                        <div class="content">
                        <h2> Appointment Request</h2>
                        <p>Dear Tutor,</p>
                       
                        <p>An appointment request is requested</p>
                        <a href="http://phpapplication-env.eba-mrbqpmvh.us-east-1.elasticbeanstalk.com/admin" class="button">Login</a>
                        <p>If the button above does not work, please copy and paste the following link into your browser:</p>
                        <p>http://phpapplication-env.eba-mrbqpmvh.us-east-1.elasticbeanstalk.com/admin</p>
                       
                        <p>
                        <p>http://localhost/andrewgit/admin</p>
                     
                        <p>Best regards,</p>
                        <p>Online Tutoring System<p>
                      </div>
                      
                      <div class="footer">
                        <p>&copy; Online Tutoring Sytem, All rights reserved.</p>
                        <p>1315 Bob Pettit Blvd, Baton Rouge, 70820</p>
                      </div>
                      
                      </div>
                      </body>
                      </html>';







    $mail->AltBody = 'Please Login to your account to accept or cancel the appointment';

    $mail->send();
    return true;
    } catch (Exception $e) {
    return false;
    }
}

function confirm_appointment_email($to_email, $to_name) {
    $mail = new PHPMailer(true);

 try {

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'lsurahman157@gmail.com';
    $mail->Password   = 'aiycioojjoessscp';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('lsurahman157@gmail.com', 'Lsu Online Tutoring Site');
    $mail->addAddress($to_email, $to_email);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Email Regarding for Appointment';
    $mail->Body = '<i>Appointment Confirmed</i><br><br>' .
              'Your appointment request is '. $to_name .  'by the Tutor<br>';

    
   
    $mail->AltBody = 'Please Login to your for Details.';

    $mail->send();
    return true;
    } catch (Exception $e) {
    return false;
    }
}



?>
