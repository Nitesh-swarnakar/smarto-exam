<?php
include '../db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $sql = "SELECT * FROM admins WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(32));  // Generate token
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));
        $sql_update = "UPDATE admins SET reset_token = '$token', reset_expiry = '$expiry' WHERE username = '$username'";
        $conn->query($sql_update);
        
        // Simulate email (in production, use mail() or PHPMailer)
        $reset_link = "http://localhost/exam_hall_system2/admin/reset_password.php?token=$token";
        echo "<div class='alert alert-success'>Reset link sent: $reset_link (Check console or implement email)</div>";
    } else {
        echo "<div class='alert alert-danger'>Username not found</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 bg-dark text-white">
        <h3>Forgot Password</h3>
        <form method="POST">
            <input type="text" name="username" class="form-control mb-2" placeholder="Admin Username" required>
            <button type="submit" class="btn btn-warning">Send Reset Link</button>
        </form>
        <a href="login.php" class="text-light">Back to Login</a>
    </div>
</body>
</html>