<?php
// PHPMailer namespace use
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Required files
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

// Random OTP
$otp = rand(100000, 999999);

// Create PHPMailer object
$mail = new PHPMailer(true);

try {
    // SMTP Config
    $mail = new PHPMailer(true);
    try {
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'dhruviahir238@gmail.com';
      $mail->Password   = 'qkwsuyhvfhtfuoyw';
      $mail->SMTPSecure = 'tls';
      $mail->Port       = 587;
    
      $mail->setFrom('dhruviahir238@gmail.com', 'Your Website');
      $mail->addAddress($email);
    
      $mail->isHTML(true);
      $mail->Subject = 'Your OTP Code';
      $mail->Body    = "Your OTP is: <b>$otp</b>";
    
      $mail->send();
      $message = "OTP sent successfully to your email.";
      $step = "otp";
    } catch (Exception $e) {
      $message = "Mailer Error: " . $mail->ErrorInfo;
      $step = "forgot";
    }
 }❌ Failed to send OTP. Mailer Error: " . $mail->ErrorInfo;
}
