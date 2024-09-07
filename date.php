<?php
// Include database connection
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $blood_type = $_POST['blood_type'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hashing the password
    $registration_date = date("Y-m-d"); // Current date for registration

    // Check if user already exists
    $check_query = $conn->prepare("SELECT * FROM donors WHERE email = ? OR phone = ?");
    $check_query->bind_param("ss", $email, $phone);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        // User already exists
        echo "<script>alert('User with this email or phone number already exists in the system.'); window.history.back();</script>";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO donors (name, email, phone, address, blood_type, date_of_birth, gender, password, registration_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $name, $email, $phone, $address, $blood_type, $date_of_birth, $gender, $password, $registration_date);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href = 'home.html';</script>";
        } else {
            echo "<script>alert('Error occurred during registration. Please try again.'); window.history.back();</script>";
        }

        $stmt->close();
    }

    $check_query->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Registration</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Existing styles */
    </style>
    <script>
        function validateForm() {
            var name = document.getElementById('name').value;
            var phone = document.getElementById('phone').value;
            var password = document.getElementById('password').value;
            var dateOfBirth = document.getElementById('date_of_birth').value;

            var nameRegex = /^[a-zA-Z\s]+$/;
            var phoneRegex = /^\d{10}$/;
            var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            // Validate Name
            if (!nameRegex.test(name)) {
                alert('Name must contain only letters and spaces.');
                return false;
            }

            // Validate Phone
            if (!phoneRegex.test(phone)) {
                alert('Phone number must be exactly 10 digits.');
                return false;
            }

            // Validate Password
            if (!passwordRegex.test(password)) {
                alert('Password must be at least 8 characters long, include both upper and lower case letters, a digit, and a special character.');
                return false;
            }

            // Validate Age
            var dob = new Date(dateOfBirth);
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            var month = today.getMonth() - dob.getMonth();

            if (month < 0 || (month === 0 && today.getDate() < dob.getDate())) {
                age--;
            }

            if (age < 17) {
                alert('You must be at least 17 years old to register.');
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <div class="container my-5">
        <h1>Donor Registration</h1>
        <form action="register.php" method="post" onsubmit="return validateForm()">
            <!-- Form Fields -->
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required><br><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address"><br><br>

            <label for="blood_type">Blood Type:</label>
            <select id="blood_type" name="blood_type" required>
                <option value="A+">A+</option>
                <option value="B+">B+</option>
                <option value="AB+">AB+</option>
                <option value="O+">O+</option>
            </select><br><br>

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required><br><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="hidden" id="registration_date" name="registration_date" value="<?php echo date('Y-m-d'); ?>">

            <div class="submit">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</body>

</html>