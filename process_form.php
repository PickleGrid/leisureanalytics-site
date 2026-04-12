<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    // Validate and sanitize the email address
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Send the email to you
    $to = 'admin@paramountanalytics.com.au';
    $subject = "Sample Report Request";
    $message = "Email Address: " . $email;

    if (mail($to, $subject, $message)) {
        // If the mail function succeeds, return a success message
        http_response_code(200); // Set response code to 200 (OK)
        echo "Success"; // Echoing a success message (or you can echo JSON data)
        exit();
    } else {
        // If there's an issue sending the email, return an error message
        http_response_code(500); // Set response code to 500 (Internal Server Error)
        echo "Error"; // Echoing an error message (or you can echo JSON data)
        exit();
    }
}
?>
