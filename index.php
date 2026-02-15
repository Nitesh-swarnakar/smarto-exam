<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smarto Exam | Hybrid Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #6366f1;
            --accent: #06b6d4;
            --mixed-bg: #1e293b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            color: #f8fafc;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        /* Animated Mesh Gradient for Creativity */
        .mesh-gradient {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(6, 182, 212, 0.15) 0px, transparent 50%);
        }

        .main-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 40px;
            padding: 50px;
            text-align: center;
            max-width: 900px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 40px;
        }

        .hero-text { text-align: left; flex: 1; }

        h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 20px;
            background: linear-gradient(to bottom right, #fff 30%, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .action-hub {
            flex: 0.8;
            background: rgba(15, 23, 42, 0.6);
            padding: 30px;
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Creative Hybrid Buttons */
        .btn-custom {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 15px 20px;
            margin-bottom: 15px;
            border-radius: 18px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-student {
            background: linear-gradient(90deg, var(--primary), #818cf8);
            color: white !important;
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.5);
        }

        .btn-admin {
            background: rgba(255, 255, 255, 0.05);
            color: #cbd5e1 !important;
        }

        .btn-custom:hover {
            transform: translateX(10px);
            background: white;
            color: black !important;
        }

        .icon-circle {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        @media (max-width: 768px) {
            .main-card { flex-direction: column; padding: 30px; }
            h1 { font-size: 2.5rem; }
        }
    </style>
</head>
<body>

    <div class="mesh-gradient"></div>

    <div class="main-card">
        <div class="hero-text">
            <div class="badge bg-info bg-opacity-10 text-info mb-3 px-3 py-2 rounded-pill">
                <i class="fas fa-sparkles me-2"></i>Smart Allotment Engine
            </div>
            <h1>Smarto <br><span style="color: var(--accent)">Exam</span></h1>
            <p class="text-secondary">Precision seating management with a seamless hybrid interface for Krishna Marketing's academic wing.</p>
        </div>

        <div class="action-hub">
            <h5 class="mb-4 fw-bold">Select Portal</h5>
            
            <a href="login.php" class="btn-custom btn-student">
                <div class="icon-circle"><i class="fas fa-user-graduate"></i></div>
                <span>Student Login</span>
            </a>

            <a href="register.php" class="btn-custom btn-admin">
                <div class="icon-circle"><i class="fas fa-user-plus text-primary"></i></div>
                <span>Create Account</span>
            </a>

            <a href="admin/login.php" class="btn-custom btn-admin">
                <div class="icon-circle"><i class="fas fa-shield-halved text-accent"></i></div>
                <span>Administrator</span>
            </a>
        </div>
    </div>

</body>
</html>