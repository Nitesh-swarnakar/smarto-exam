<?php
include 'db.php';
session_start();

$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $register_no = mysqli_real_escape_string($conn, $_POST['register_no']);
    $sql = "SELECT * FROM students WHERE register_no = '$register_no'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        $_SESSION['student_id'] = $student['id'];
        $_SESSION['student_name'] = $student['name']; // Store name for a personal welcome
        header("Location: dashboard.php");
        exit();
    } else {
        $error_msg = "Register Number not found. Please check and try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smarto Exam | Student Access</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #6366f1;
            --success: #10b981;
            --dark-bg: #0f172a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--dark-bg);
            /* Subtle animated mesh background */
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.1) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(16, 185, 129, 0.05) 0px, transparent 50%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f8fafc;
        }

        .login-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 28px;
            width: 420px;
            max-width: 90%;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .icon-circle {
            width: 70px;
            height: 70px;
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 20px auto;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .form-control {
            background: rgba(15, 23, 42, 0.8) !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            padding: 14px 20px;
            color: white !important;
            text-align: center;
            font-size: 1.1rem;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: var(--success);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--success), #059669);
            border: none;
            border-radius: 14px;
            padding: 14px;
            font-weight: 700;
            width: 100%;
            margin-top: 15px;
            transition: all 0.3s;
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -5px rgba(16, 185, 129, 0.4);
        }

        .alert-custom {
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .footer-link {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.9rem;
            transition: 0.2s;
        }

        .footer-link:hover { color: var(--success); }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="icon-circle">
            <i class="fas fa-user-graduate"></i>
        </div>
        
        <h3 class="fw-bold mb-1">Student Portal</h3>
        <p class="text-secondary small mb-4">Enter your Register No. to view your seat</p>

        <?php if ($error_msg): ?>
            <div class="alert alert-custom py-2">
                <i class="fas fa-circle-exclamation me-2"></i> <?php echo $error_msg; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <input type="text" name="register_no" class="form-control" placeholder="REG-2026-000" required autofocus>
            </div>
            <button type="submit" class="btn btn-login text-white">
                Access Dashboard <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </form>

        <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
            <a href="register.php" class="footer-link">First time? <strong>Create account</strong></a>
        </div>
    </div>

</body>
</html>