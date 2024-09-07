<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodsystem";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donor_id = $_SESSION['donor_id']; // Assuming donor_id is stored in session after login
    $blood_type = $_POST['blood_type'];
    $quantity_units = $_POST['quantity_units'];
    $donation_date = date("Y-m-d");

    // Insert into donations table
    $sql = "INSERT INTO donations (donor_id, blood_type, quantity_units, donation_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isds", $donor_id, $blood_type, $quantity_units, $donation_date);

    if ($stmt->execute()) {
        // Check if blood type already exists in inventory
        $sql = "SELECT * FROM blood_inventory WHERE blood_type = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $blood_type);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Update existing inventory
            $sql = "UPDATE blood_inventory SET quantity_units = quantity_units + ?, last_updated = ? WHERE blood_type = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("dss", $quantity_units, $donation_date, $blood_type);
        } else {
            // Insert new record into inventory
            $sql = "INSERT INTO blood_inventory (blood_type, quantity_units, last_updated) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sds", $blood_type, $quantity_units, $donation_date);
        }

        if ($stmt->execute()) {
            // Notify admin (you can send an email, SMS, or just a session message)
            $_SESSION['message'] = "New donation added: $blood_type, $quantity_units units.";
            header("Location: admindashboard.php");
            exit();
        } else {
            echo "Error updating inventory: " . $conn->error;
        }
    } else {
        echo "Error donating blood: " . $conn->error;
    }
}

$conn->close();
