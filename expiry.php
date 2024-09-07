<?php
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

// Get current date and calculate the date 7 days from now
$current_date = date('Y-m-d');
$future_date = date('Y-m-d', strtotime('+7 days'));

// Fetch blood units that are expiring within the next 7 days
$sql = "SELECT blood_type, expiration_date FROM blood_inventory WHERE expiration_date BETWEEN ? AND ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $current_date, $future_date);
$stmt->execute();
$result = $stmt->get_result();
$expiring_blood = [];

while ($row = $result->fetch_assoc()) {
    $expiring_blood[] = $row;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Admin Dashboard</h1>

        <!-- Notification Section -->
        <?php if (!empty($expiring_blood)): ?>
            <div class="alert alert-warning" role="alert" style="color: brown;">
                <h4 class="alert-heading">Warning!</h4>
                <p>The following blood units are expiring within the next 7 days:</p>
                <hr />
                <ul>
                    <?php foreach ($expiring_blood as $blood): ?>
                        <li>
                            <strong>Blood Type:</strong>
                            <?php echo htmlspecialchars($blood['blood_type']); ?>
                            | <strong>Expiration Date:</strong>
                            <?php echo htmlspecialchars($blood['expiration_date']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else: ?>
            <div class="alert alert-success" role="alert">
                No blood units are expiring within the next 7 days.
            </div>
        <?php endif; ?>

        <!-- Other Admin Dashboard Content -->
        <!-- Add any other content you want to display on the admin dashboard -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>