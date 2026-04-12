<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = trim($_POST["name"] ?? "");
    $email   = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name === "" || $email === "" || $message === "") {
        http_response_code(400);
        echo "Please fill out all fields.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please enter a valid email address.";
        exit;
    }

    $to = "sam@leisureanalytics.com.au";
    $subject = "New website enquiry — " . $name;

    $email_content  = "New contact form submission\n\n";
    $email_content .= "Name: {$name}\n";
    $email_content .= "Email: {$email}\n\n";
    $email_content .= "Message:\n{$message}\n";

    $from = "website@leisureanalytics.com.au"; // create as alias/mailbox if possible

    $headers  = "From: Leisure Analytics <{$from}>\r\n";
    $headers .= "Reply-To: {$email}\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $sent = @mail($to, $subject, $email_content, $headers, "-f {$from}");

    if ($sent) {
        echo "Thank you! Your message has been sent.";
    } else {
        http_response_code(500);
        echo "Mail failed (server mail is not configured).";
    }
}
?>
