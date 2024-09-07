<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Starting script.<br>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodsystem";

try {
    echo "Connecting to database.<br>";
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to database.<br>";

    // Fetch messages from the database
    $stmt = $pdo->prepare("SELECT * FROM messages ORDER BY created_at DESC");
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "Messages fetched:<br>";
    foreach ($messages as $message) {
        echo htmlspecialchars($message['email']) . " - " . htmlspecialchars($message['subject']) . "<br>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .top-bar {
            background-color: #343a40;
            color: white;
            padding: 10px;
            position: relative;
        }

        .message-icon {
            font-size: 24px;
            cursor: pointer;
            position: relative;
            margin-left: 15px;
        }

        .message-icon .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <header class="top-bar d-flex justify-content-between align-items-center">
        <h1>Admin Dashboard</h1>
        <div class="message-icon">
            <i class="fas fa-envelope"></i>
            <span class="badge">3</span>
        </div>
    </header>
    <section class="container mt-4">
        <!-- Page content goes here -->
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>