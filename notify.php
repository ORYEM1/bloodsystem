<?php
// Display all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodsystem";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding a new user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt the password

    // Insert the new user into the users table
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        // Create a notification for the admin
        $notificationText = "New user added: $username";
        $notificationType = "new_user";
        $notificationSql = "INSERT INTO notifications (notification_type, notification_text) VALUES (?, ?)";

        // Prepare and bind for notifications
        $notifStmt = $conn->prepare($notificationSql);
        $notifStmt->bind_param("ss", $notificationType, $notificationText);
        $notifStmt->execute();
        $notifStmt->close();

        // Store a session message
        $_SESSION['message'] = "New user added successfully.";

        // Redirect to admin dashboard or refresh the page
        header("Location: admindashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
