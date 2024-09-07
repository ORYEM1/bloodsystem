<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodsystem";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch messages from the database
    $stmt = $pdo->prepare("SELECT * FROM messages ORDER BY created_at DESC");
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    /*if ($messages) {
        echo "Messages fetched successfully:<br>";
        foreach ($messages as $message) {
            echo "From: " . htmlspecialchars($message['email']) . "<br>";
            echo "Subject: " . htmlspecialchars($message['subject']) . "<br>";
            echo "Message: " . htmlspecialchars($message['message']) . "<br>";
            echo "Date: " . htmlspecialchars($message['created_at']) . "<br><br>";
        }
    } else {
        echo "No messages found.<br>";
    } */
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

        .blink {
            animation: blink 1s step-start 0s infinite;
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <header class="top-bar d-flex justify-content-between align-items-center">
        <h1>Admin Dashboard</h1>
        <div class="message-icon">
            <i class="fas fa-envelope"></i>
            <span class="badge" id="message-count">
                <?php
                // PHP code to count the number of messages
                $messageCount = count($messages);
                echo $messageCount;
                ?>
            </span>
        </div>
    </header>

    <section class="container mt-4">
        <!-- Display messages fetched from the database -->
        <?php
        if (!empty($messages)) {
            foreach ($messages as $message) {
                echo "<div class='alert alert-warning'>";
                echo "<strong>From:</strong> " . htmlspecialchars($message['email']) . "<br>";
                echo "<strong>Subject:</strong> " . htmlspecialchars($message['subject']) . "<br>";
                echo "<strong>Message:</strong> " . htmlspecialchars($message['message']) . "<br>";
                echo "<strong>Date:</strong> " . htmlspecialchars($message['created_at']);
                echo "</div>";
            }
        }
        ?>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        // Simulate checking for new messages
        function checkForNewMessages() {
            // Simulated check - replace this with your actual logic
            const hasNewMessages = <?php echo $messageCount > 0 ? 'true' : 'false'; ?>;
            const messageCountElement = document.getElementById('message-count');

            if (hasNewMessages) {
                messageCountElement.classList.add('blink');
            } else {
                messageCountElement.classList.remove('blink');
            }
        }

        // Call function to check for new messages on page load
        checkForNewMessages();
    </script>
</body>

</html>