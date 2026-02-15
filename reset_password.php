<?php
include '../db.php';
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT * FROM admins WHERE reset_token = '$token' AND reset_expiry > NOW()";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql_update = "UPDATE admins SET password = '$new_password', reset_token = NULL, reset_expiry = NULL WHERE reset_token = '$token'";
            $conn->query($sql_update);
            echo "<div class='alert alert-success'>Password reset! Login now.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Invalid or expired token</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 bg-dark text-white">
        <h3>Reset Password</h3>
        <form method="POST">
            <input type="password" name="password" class="form-control mb-2" placeholder="New Password" required>
            <button type="submit" class="btn btn-primary">Reset</button>
        </form>
        <a href="login.php" class="text-light">Back to Login</a>
    </div>
</body>
</html>