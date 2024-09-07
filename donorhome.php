<?php

session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the donor is logged in
if (!isset($_SESSION['donor_id'])) {
    echo "Donor ID is not set. Redirecting to login page...";
    header("Location: login.html");
    exit();
}

// Fetch the donor_id from the session
$donor_id = $_SESSION['donor_id'];
echo "Donor ID: " . htmlspecialchars($donor_id); // Debugging line to check if donor ID is available
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Welcome to Your Dashboard</h1>
        <p>Your Donor ID: <?php echo htmlspecialchars($donor_id); ?></p>

        <!-- Send Message Section -->
        <h2>Send a Message to the Admin</h2>
        <form action="send_message.php" method="POST">
            <div class="form-group">
                <label for="message">Your Message:</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <input type="hidden" name="donor_id" value="<?php echo htmlspecialchars($donor_id); ?>">
            <button type="submit" class="btn btn-primary mt-3">Send Message</button>
        </form>
    </div>
</body>

</html>