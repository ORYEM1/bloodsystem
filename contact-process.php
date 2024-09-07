<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Starting script.<br>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodsystem";

try {
    echo "Connecting to database.<br>";
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to database.<br>";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "Form was submitted.<br>";

        $name = htmlspecialchars(strip_tags($_POST['name']));
        $email = htmlspecialchars(strip_tags($_POST['email']));
        $subject = htmlspecialchars(strip_tags($_POST['subject']));
        $message = htmlspecialchars(strip_tags($_POST['message']));

        echo "Form data captured.<br>";

        // Insert the message into the database
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, subject, message, created_at) VALUES (:name, :email, :subject, :message, NOW())");

        if ($stmt) {
            echo "Statement prepared successfully.<br>";
        } else {
            echo "Failed to prepare statement.<br>";
        }

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            echo "Message inserted into database.<br>";
            echo "Your message has been sent. Thank you!";
        } else {
            echo "Failed to execute statement.<br>";
        }
    } else {
        echo "Form was not submitted.<br>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

echo "Script completed.<br>";
