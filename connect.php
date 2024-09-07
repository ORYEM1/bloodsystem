<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodsystem";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $email = htmlspecialchars(strip_tags($_POST['email']));
        $phone = htmlspecialchars(strip_tags($_POST['phone']));
        $address = htmlspecialchars(strip_tags($_POST['address']));
        $blood_type = htmlspecialchars(strip_tags($_POST['blood_type']));
        $date_of_birth = htmlspecialchars(strip_tags($_POST['date_of_birth']));
        $gender = htmlspecialchars(strip_tags($_POST['gender']));
        $password = htmlspecialchars(strip_tags($_POST['password']));

        // Validation Rules
        $nameRegex = "/^[a-zA-Z\s]+$/";
        $phoneRegex = "/^\d{10}$/";
        $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

        // Validate Name
        if (!preg_match($nameRegex, $name)) {
            die("Name must contain only letters and spaces.");
        }

        // Validate Phone
        if (!preg_match($phoneRegex, $phone)) {
            die("Phone number must be exactly 10 digits.");
        }

        // Validate Password
        if (!preg_match($passwordRegex, $password)) {
            die("Password must be at least 8 characters long, include both upper and lower case letters, a digit, and a special character.");
        }

        // Validate Age
        $dob = new DateTime($date_of_birth);
        $today = new DateTime();
        $age = $today->diff($dob)->y;

        if ($age < 17) {
            die("You must be at least 17 years old to register.");
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
            header("Location: donor_home.php");
            exit();
        } else {
            echo "Error: Could not register user.";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
