<?php
include '../db.php';
session_start();

$error_msg = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Using a simple prepared statement for better security
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: dashboard.php");
            exit();
        } else {
            $error_msg = "Invalid password. Access denied.";
        }
    } else {
        $error_msg = "Username not recognized.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smarto Exam | Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #4f46e5;
            --accent: #f59e0b;
        }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .main-container {
            width: 1000px;
            max-width: 95%;
            height: 600px;
            display: flex;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        /* Creative Sidebar */
        .info-side {
            flex: 1;
            background: linear-gradient(135deg, var(--primary), #3730a3);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 50px;
            position: relative;
        }
        .info-side::after {
            content: "";
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        /* Form Section */
        .form-side {
            flex: 1.2;
            background: #1e293b;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary);
            color: white;
            box-shadow: none;
        }
        .btn-warning {
            background: var(--accent);
            border: none;
            font-weight: 700;
            padding: 12px;
            border-radius: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        .btn-warning:hover {
            background: #d97706;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.3);
        }
        .error-toast {
            background: rgba(239, 68, 68, 0.1);
            border-left: 4px solid #ef4444;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            color: #fca5a5;
        }
        @media (max-width: 768px) {
            .info-side { display: none; }
        }
    </style>
</head>
<body>

    <div class="main-container">
        <div class="info-side">
            <h1 class="fw-bold mb-3"><i class="fas fa-microchip me-2"></i>Smarto Exam</h1>
            <p class="lead opacity-75">Revolutionizing seating management with automated intelligence.</p>
            <div class="mt-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-check-circle text-warning me-3"></i>
                    <span>Real-time Room Tracking</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-check-circle text-warning me-3"></i>
                    <span>Anti-Cheat Seat Mapping</span>
                </div>
            </div>
        </div>

        <div class="form-side">
            <h2 class="fw-bold mb-1">Admin Access</h2>
            <p class="text-secondary mb-4">Please enter your credentials to manage exams.</p>

            <?php if ($error_msg): ?>
                <div class="error-toast">
                    <i class="fas fa-circle-exclamation me-2"></i> <?php echo $error_msg; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-1">
                    <label class="small text-secondary mb-2">USERNAME</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter username" required>
                </div>
                <div class="mb-1">
                    <label class="small text-secondary mb-2">PASSWORD</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                
                <button type="submit" class="btn btn-warning w-100 mt-2">
                    Login to System <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </form>

            <div class="mt-4 d-flex justify-content-between">
                <a href="forgot_password.php" class="text-secondary text-decoration-none small">Forgot Password?</a>
                <a href="register.php" class="text-primary text-decoration-none small fw-bold">Create Account</a>
            </div>
        </div>
    </div>

</body>
</html>