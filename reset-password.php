<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];

    // Validate the token
    $stmt = $pdo->prepare("SELECT * FROM donors WHERE reset_token = :token AND reset_token_expires > NOW()");
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // Update the user's password and clear the reset token
        $stmt = $pdo->prepare("UPDATE donors SET password = :password, reset_token = NULL, reset_token_expires = NULL WHERE reset_token = :token");
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        echo "Your password has been reset.";
    } else {
        echo "Invalid or expired token.";
    }
} else if (isset($_GET['token'])) {
    $token = $_GET['token'];
    // Show a form to reset the password
    echo '<form action="reset-password.php" method="POST">';
    echo '<input type="hidden" name="token" value="' . htmlspecialchars($token) . '">';
    echo '<input type="password" name="new_password" placeholder="New Password" required>';
    echo '<button type="submit">Reset Password</button>';
    echo '</form>';
} else {
    echo "No reset token provided."
}
?>
