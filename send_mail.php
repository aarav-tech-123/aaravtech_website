<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';


$mail = new PHPMailer(true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // 1. reCAPTCHA verification
    $secretKey = "6Ld29s0rAAAAALA0SDvjS8cFk9DZ6gXTAwkqx-Yx"; // <-- Replace with your real secret key
    $responseKey = $_POST['g-recaptcha-response'] ?? '';
    $userIP = $_SERVER['REMOTE_ADDR'];

    $verifyUrl = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($verifyUrl);
    $responseKeys = json_decode($response, true);

    if (!$responseKeys["success"]) {
        die("Verification failed. Please check the reCAPTCHA.");
    }

    // 2. Collect form data
    $name     = htmlspecialchars($_POST['name'] ?? '');
    $email    = htmlspecialchars($_POST['email'] ?? '');
    $phone    = htmlspecialchars($_POST['Phone'] ?? '');
    $subject  = htmlspecialchars($_POST['subject'] ?? '');
    $message  = htmlspecialchars($_POST['message'] ?? '');



    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'aditya.gupin1950@gmail.com'; 
        $mail->Password   = 'jrehsbhvkmjoajgb'; // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('aditya.gupin1950@gmail.com', 'Website Contact Form');
        $mail->addAddress('support@aaravtech.net', 'Support Team');

        // 4. Email content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission: $subject";
        $mail->Body    = "
            <h2>New Contact Form Submission</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Service Requested:</strong> $subject</p>
            <p><strong>Message:</strong><br>$message</p>
        ";
        $mail->AltBody = "Name: $name\nEmail: $email\nPhone: $phone\nService: $subject\nMessage: $message";

        $mail->send();
        // echo "Your message has been sent successfully!";

        header("Location: thankyou.html");
        exit();

    } catch (Exception $e) {
        echo "Message could not be sent. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid Request.";
}

    $to = "aaravtech"; // Replace with your email address
    $subject = "$subject";
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    $mailBody = "Name: $name\nEmail: $email\n\nPhone: $phone\nMessage:\n$message";

    if (mail($to, $subject, $mailBody, $headers)) {
        echo '<div style="text-align:center; align-items: center; justify-content: center; margin-top: 10%;"><h1>Thank you for contacting us. We will get back to you shortly.</h1><a href="/index.html" style="background: #333; color: #fff; border: 0; padding: 15px 25px; cursor: pointer; border-radius: 5px;">Go Back</a></div>';
    } else {
        echo '<div style="text-align:center; align-items: center; justify-content: center; margin-top: 10%;"><h2>Sorry, there was an error sending your message. Please try again later.</h2><a href="/index.html" style="background: #333; color: #fff; border: 0; padding: 15px 25px; cursor: pointer; border-radius: 5px;">Go Back</button></div>';
    }
?>
