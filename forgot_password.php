<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $stmt = $pdo->prepare("SELECT * FROM donors WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Generate a token
        $token = bin2hex(random_bytes(16));

        // Store the token in the database with an expiration time
        $stmt = $pdo->prepare("UPDATE donors SET reset_token = :token, reset_token_expires = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = :email");
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Send email with the reset link
        $resetLink = "http://yourdomain.com/reset-password.php?token=$token";
        mail($email, "Password Reset Request", "Click this link to reset your password: $resetLink");

        echo "A password reset link has been sent to your email.";
    } else {
        echo "No account found with that email address.";
    }
}
?>