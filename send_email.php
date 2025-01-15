<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    $mail = new PHPMailer(true);

    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Server SMTP Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'yourgmail@gmail.com'; // Ganti dengan Gmail Anda
        $mail->Password = 'yourpassword'; // Ganti dengan password Gmail Anda
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Pengaturan Email
        $mail->setFrom('yourgmail@gmail.com', 'Your Website'); // Ganti sesuai nama pengirim
        $mail->addAddress('youremail@example.com'); // Email tujuan

        $mail->Subject = "New Contact Form Submission: " . $subject;
        $mail->Body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        $mail->send();
        echo "Message sent successfully.";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
