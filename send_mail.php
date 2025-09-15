<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $to = "@gmail.com"; // Replace with your email address
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
}
?>
