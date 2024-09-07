<?php
// Display errors for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodsystem";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$date_of_birth = $_POST['date_of_birth'];
$gender = $_POST['gender'];
$user_roles = $_POST['user_roles'];


// Check if the donor already exists in the database
$checkQuery = "SELECT * FROM donors WHERE email = '$email'";
$checkResult = $conn->query($checkQuery);

if ($checkResult->num_rows > 0) {
    // Donor already exists
    echo "<script>alert('Donor already exists in the database.'); window.location.href='/bloodsystem/adduser.php';</script>";
} else {
    // Insert data into the database
    $sql = "INSERT INTO donors (name, email, phone, address,date_of_birth, gender,user_roles) 
            VALUES ('$name',  '$email', '$phone', '$address', '$date_of_birth', '$gender','$user_roles')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New donor added successfully.'); window.location.href='/bloodsystem/adduser.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
