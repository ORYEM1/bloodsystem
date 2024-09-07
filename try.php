<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodsystem";

// Create a connection using PDO
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and sanitize form inputs
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $email = htmlspecialchars(strip_tags($_POST['email']));
        $phone = htmlspecialchars(strip_tags($_POST['phone']));
        $address = htmlspecialchars(strip_tags($_POST['address']));
        $blood_type = htmlspecialchars(strip_tags($_POST['blood_type']));
        $date_of_birth = htmlspecialchars(strip_tags($_POST['date_of_birth']));
        $gender = htmlspecialchars(strip_tags($_POST['gender']));
        $password = htmlspecialchars(strip_tags($_POST['password']));

        // Validate input
        if (empty($name) || empty($email) || empty($phone) || empty($blood_type) || empty($date_of_birth) || empty($gender) || empty($password)) {
            die("Please fill in all required fields.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email format.");
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert data into the database
        $sql = "INSERT INTO donors (name, email, phone, address, blood_type, date_of_birth, gender, password) 
                VALUES (:name, :email, :phone, :address, :blood_type, :date_of_birth, :gender, :password)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':blood_type', $blood_type);
        $stmt->bindParam(':date_of_birth', $date_of_birth);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: Could not register user.";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
