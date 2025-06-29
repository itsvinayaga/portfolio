<?php
// Enable error reporting (for testing)

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer files
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name    = htmlspecialchars(trim($_POST['contactName']));
    $email   = htmlspecialchars(trim($_POST['contactEmail']));
    $subject = htmlspecialchars(trim($_POST['contactSubject']));
    $message = htmlspecialchars(trim($_POST['contactMessage']));

    // Validation
    if (empty($name) || empty($email) || empty($message)) {
        echo "Please fill all required fields.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();                                      // Use SMTP
        $mail->Host       = 'smtp.gmail.com';                 // Gmail SMTP server
        $mail->SMTPAuth   = true;                             // Enable authentication
        $mail->Username   = 'vinayagamoorthi49@gmail.com';           // Your Gmail address
        $mail->Password   = 'yokxwokyuhuacrmz';              // Gmail App Password (not your Gmail password)
        $mail->SMTPSecure = 'tls';                            // TLS encryption
        $mail->Port       = 587;                              // 465 for ssl

        // Sender and recipient
        $mail->setFrom('vinayagamoorthi49@gmail.com', 'Vinayagamoorthi');
        $mail->addAddress('vinayagamoorthi49@gmail.com', 'Vinayaga');

        // Content
        $mail->isHTML(true);
        $mail->Subject = !empty($subject) ? $subject : 'New Message from Contact Form';
        $mail->Body    = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong><br>" . nl2br($message) . "</p>
        ";
        $mail->AltBody = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";

        $mail->send();
        echo "success";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
} else {
    echo "Invalid request.";
}
?>
