<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $message = $_POST["Message"];

    $to = "sabinmhx@gmail.com"; // Your email address
    $subject = "Contact Form Submission"; // Subject of your email

    // Construct the headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/alternative; boundary=\"boundary\"\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n"; // Additional header

    // Construct the message body
    $text_message = "Contact Form Submission\n\n";
    $text_message .= "Name: $name\n";
    $text_message .= "Email: $email\n";
    $text_message .= "Message:\n$message\n";

    $html_message = "<html><body>";
    $html_message .= "<h2>Contact Form Submission</h2>";
    $html_message .= "<p><strong>Name:</strong> $name</p>";
    $html_message .= "<p><strong>Email:</strong> $email</p>";
    $html_message .= "<p><strong>Message:</strong><br>$message</p>";
    $html_message .= "</body></html>";

    $message = "--boundary\r\n";
    $message .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $message .= $text_message . "\r\n\r\n";
    $message .= "--boundary\r\n";
    $message .= "Content-Type: text/html; charset=UTF-8\r\n";
    $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $message .= $html_message . "\r\n\r\n";
    $message .= "--boundary--";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send the message. Please try again later.";
    }
} else {
    echo "Form submission method not allowed.";
}
?>
