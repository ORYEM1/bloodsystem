<?php
// Display all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve form data
$subject = $_POST['subject'];
$message = $_POST['message'];
$users = $_POST['users'];

// Email headers
$headers = "From: oryemreagan7@gmail.com\r\n";
$headers .= "Reply-To: oryemreagan7@gmail.com\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// Send email to each user
foreach ($users as $email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (mail($email, $subject, $message, $headers)) {
            echo "Email sent to $email<br>";
        } else {
            echo "Failed to send email to $email<br>";
        }
    }
}

// Redirect back to admin dashboard or show a message
header("Location: admindashboard.php");
exit();
