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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blood_type = $_POST['blood_type'];
    $quantity_units = $_POST['quantity_units'];
    $expiration_date = $_POST['expiration_date'];
    $last_updated = date("Y-m-d H:m:s");

    // Insert the data into the blood_inventory table
    $sql = "INSERT INTO blood_inventory (blood_type, quantity_units, expiration_date, last_updated) 
            VALUES (?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdss", $blood_type, $quantity_units, $expiration_date, $last_updated);

    if ($stmt->execute()) {
        // Notify admin (can be email, SMS, or just a session message)
        $_SESSION['message'] = "New blood inventory added: $blood_type, $quantity_units units.";

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
