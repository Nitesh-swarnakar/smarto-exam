<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smarto Exam | Signing Out</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(at 0% 0%, #1e293b 0%, #0f172a 100%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: white;
            text-align: center;
        }
        .loader-content {
            animation: fadeIn 0.8s ease-out;
        }
        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(99, 102, 241, 0.1);
            border-top: 3px solid #6366f1;
            border-radius: 50%;
            margin: 0 auto 20px auto;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { 100% { transform: rotate(360deg); } }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        
        .status-text { font-size: 1.1rem; letter-spacing: 1px; opacity: 0.8; }
    </style>
    <meta http-equiv="refresh" content="1.5;url=index.php">
</head>
<body>
    <div class="loader-content">
        <div class="spinner"></div>
        <p class="status-text"><i class="fas fa-lock me-2"></i> Securely signing out...</p>
    </div>
</body>
</html>