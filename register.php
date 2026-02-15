<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smarto Exam | Student Enrollment</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #6366f1;
            --success: #10b981;
            --dark-surface: #0f172a;
            --glass: rgba(255, 255, 255, 0.03);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background: radial-gradient(at 0% 0%, #1e293b 0%, #0f172a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #f1f5f9;
        }

        .register-card {
            width: 800px;
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .section-title {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 20px;
            display: block;
        }

        .form-control, .form-select {
            background: rgba(15, 23, 42, 0.6) !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #fff !important;
            padding: 12px 15px;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
        }

        /* Creative Icon Labels */
        .input-group-text {
            background: transparent;
            border: none;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary), #4f46e5);
            border: none;
            padding: 15px;
            border-radius: 15px;
            font-weight: 700;
            letter-spacing: 1px;
            transition: 0.4s;
            margin-top: 20px;
        }

        .btn-register:hover {
            transform: scale(1.02);
            box-shadow: 0 20px 30px rgba(99, 102, 241, 0.3);
            background: white;
            color: var(--primary);
        }

        .brand-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            margin-bottom: 30px;
            padding-bottom: 20px;
        }

        /* Image/Status Icon Background */
        .brand-icon {
            width: 60px;
            height: 60px;
            background: rgba(99, 102, 241, 0.1);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="register-card">
    <div class="brand-header d-flex align-items-center justify-content-between">
        <div>
            <div class="brand-icon"><i class="fas fa-id-card"></i></div>
            <h3 class="fw-bold m-0">Join Smarto Exam</h3>
            <p class="text-secondary small">Enroll now to access your seating details</p>
        </div>
        <div class="text-end d-none d-md-block">
            <span class="badge bg-primary bg-opacity-10 text-primary p-2 px-3 rounded-pill">
                <i class="fas fa-shield-check me-1"></i> Student Verification
            </span>
        </div>
    </div>

    <form method="POST">
        <span class="section-title">Academic Details</span>
        <div class="row g-3">
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                    <input type="text" class="form-control" name="register_no" placeholder="Registration No." required>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <select name="class" class="form-select" required>
                    <option value="" hidden>Class</option>
                    <option>Semester 4</option>
                    <option>Semester 6</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <select name="department" class="form-select" required>
                    <option value="" hidden>Department</option>
                    <option>Computer Science</option>
                    <option>Information Technology</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <select name="course" class="form-select" required>
                    <option value="" hidden>Course</option>
                    <option>BCA</option>
                    <option>BSc CS</option>
                </select>
            </div>
        </div>

        <span class="section-title mt-2">Contact Information</span>
        <div class="row g-3">
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input type="text" class="form-control" name="mobile" placeholder="Mobile Number" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-register w-100 text-white">
            Create Student Account <i class="fas fa-arrow-right ms-2"></i>
        </button>
    </form>

    <div class="text-center mt-4">
        <p class="small text-secondary">
            Already have an account? <a href="login.php" class="text-primary fw-bold text-decoration-none">Sign In</a>
        </p>
    </div>
</div>

</body>
</html>