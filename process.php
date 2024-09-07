<?php
// Include database connection
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $status = $_POST['status'];
    $date = $_POST['date'];
    $gender = $_POST['gender'];
    $blood_type = $_POST['type'];

    // Check if donor already exists by email or contact
    $check_query = $conn->prepare("SELECT * FROM donors WHERE email = ? OR contact = ?");
    $check_query->bind_param("ss", $email, $contact);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        // Donor already exists
        echo "<script>alert('Donor with this email or contact number already exists in the system.'); window.history.back();</script>";
    } else {
        // Insert new donor into the database
        $stmt = $conn->prepare("INSERT INTO donors (firstname, lastname, email, contact, address, age, status, date, gender, blood_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $firstname, $lastname, $email, $contact, $address, $age, $status, $date, $gender, $blood_type);

        if ($stmt->execute()) {
            echo "<script>alert('Donor added successfully!'); window.location.href = 'success_page.php';</script>";
        } else {
            echo "<script>alert('Error occurred while adding donor. Please try again.'); window.history.back();</script>";
        }

        $stmt->close();
    }

    $check_query->close();
    $conn->close();

}
    ?>


