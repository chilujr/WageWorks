<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['email'], $_POST['subject'], $_POST['message'])) {
        die("Missing required fields.");
    }

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(strip_tags($_POST['subject']));
    $message = htmlspecialchars(strip_tags($_POST['message']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@wageworkszm.com'; // Your Hostinger email
        $mail->Password = 'AdminUser_@2025'; // Your Hostinger email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('info@wageworkszm.com', 'Website Contact Form');
        $mail->addReplyTo($email);
        $mail->addAddress('info@wageworkszm.com');

        $mail->isHTML(true);
        $mail->Subject = "Subject: " . $subject;
        $mail->Body    = "<p><strong>Email:</strong> $email</p>
                          <p><strong>Message:</strong> $message</p>";

        if ($mail->send()) {
            // **Redirect to homepage after successful submission**
            header("Location: ../index.html?success=1");
            exit();
        } else {
            echo "Message could not be sent.";
        }
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
} else {
    echo "Invalid request!";
}
?>
