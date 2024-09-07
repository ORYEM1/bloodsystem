<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$database = "childadoption";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add a new user and notify admin
function addUser($conn, $donorId)
{
    // Fetch user data from the donors table using donorId
    $query = "SELECT * FROM user WHERE id = $donorId";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
        $username = $userData['username'];
        $email = $userData['email'];
        $password = $userData['password']; // Assuming password is already hashed in the donors table

        // Insert new user into the users table
        $insertQuery = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

        if (mysqli_query($conn, $insertQuery)) {
            // If the user is successfully added, create a notification for the admin
            $notificationText = "A new user has been added: " . $username;
            $notificationType = "new_user";

            // Insert the notification into the notifications table
            $notificationQuery = "INSERT INTO notifications (notification_type, notification_text) VALUES ('$notificationType', '$notificationText')";
            mysqli_query($conn, $notificationQuery);
        } else {
            echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Donor not found!";
    }
}

// Function to log in a user and notify admin
function loginUser($conn, $username, $password)
{
    // Fetch the user from the database
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the user's password
        if (password_verify($password, $user['password'])) {
            // If the login is successful, create a notification for the admin
            $notificationText = "User logged in: " . $username;
            $notificationType = "user_login";

            // Insert the notification into the notifications table
            $notificationQuery = "INSERT INTO notifications (notification_type, notification_text) VALUES ('$notificationType', '$notificationText')";
            mysqli_query($conn, $notificationQuery);
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}

// Function to add new blood stock and notify admin
function addStock($conn, $bloodType, $quantity)
{
    // Insert the new stock into the blood_inventory table
    $query = "INSERT INTO blood_inventory (blood_type, quantity) VALUES ('$bloodType', $quantity)";

    if (mysqli_query($conn, $query)) {
        // If the stock is successfully added, create a notification for the admin
        $notificationText = "New stock added: $bloodType, Quantity: $quantity";
        $notificationType = "new_stock";

        // Insert the notification into the notifications table
        $notificationQuery = "INSERT INTO notifications (notification_type, notification_text) VALUES ('$notificationType', '$notificationText')";
        mysqli_query($conn, $notificationQuery);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Function to receive a message from a donor and notify admin
function receiveMessage($conn, $donorId, $message)
{
    // Insert the message into the messages table
    $query = "INSERT INTO messages (donor_id, message) VALUES ($donorId, '$message')";

    if (mysqli_query($conn, $query)) {
        // If the message is successfully stored, create a notification for the admin
        $notificationText = "New message from Donor ID: $donorId";
        $notificationType = "new_message";

        // Insert the notification into the notifications table
        $notificationQuery = "INSERT INTO notifications (notification_type, notification_text) VALUES ('$notificationType', '$notificationText')";
        mysqli_query($conn, $notificationQuery);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Function to mark a notification as read
function markAsRead($conn, $notificationId)
{
    // Update the is_read field to 1 (true) for the given notification ID
    $query = "UPDATE notifications SET is_read = 1 WHERE id = $notificationId";
    mysqli_query($conn, $query);
}
