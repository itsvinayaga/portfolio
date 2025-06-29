<?php
// Include PHPMailer classes
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                                      // Use SMTP
    $mail->Host       = 'smtp.gmail.com';                 // Gmail SMTP server
    $mail->SMTPAuth   = true;                             // Enable authentication
    $mail->Username   = 'vinayagamoorthi49@gmail.com';           // Your Gmail address
    $mail->Password   = 'yokxwokyuhuacrmz';              // Gmail App Password (not your Gmail password)
    $mail->SMTPSecure = 'tls';                            // TLS encryption
    $mail->Port       = 587;                              // TLS port

    // Recipients
    $mail->setFrom('vinayagamoorthi49@gmail.com', 'Vinayagamoorthi');
    $mail->addAddress('vinayagamoorthi49@gmail.com', 'Vinayaga');

    // Content
    $mail->isHTML(true);                                  // Email format is HTML
    $mail->Subject = 'Test SMTP Email';
    $mail->Body    = '<strong>Hello!</strong> This is a test email using PHPMailer without Composer.';
    $mail->AltBody = 'Hello! This is a test email using PHPMailer without Composer.';

    // Send email
    $mail->send();
    echo 'Message has been sent successfully.';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}