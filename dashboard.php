<?php
include 'db.php';
session_start();

if (!isset($_SESSION['student_id'])) { 
    header("Location: login.php"); 
    exit();
}

$student_id = $_SESSION['student_id'];

// Use Prepared Statements for security (Good for your BCA project viva!)
$stmt_student = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt_student->bind_param("i", $student_id);
$stmt_student->execute();
$student = $stmt_student->get_result()->fetch_assoc();

// Fetch Allotment
$sql_allotment = "SELECT h.name AS hall, sa.seat_no 
                  FROM seat_allotments sa 
                  JOIN halls h ON sa.hall_id = h.id 
                  WHERE sa.student_id = $student_id LIMIT 1";
$allotment = $conn->query($sql_allotment)->fetch_assoc();

// Fetch Exam
$sql_exams = "SELECT * FROM exams LIMIT 1";
$exam = $conn->query($sql_exams)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Smarto Exam</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #6366f1;
            --accent: #10b981;
            --bg-dark: #0f172a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-dark);
            background-image: radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.1) 0px, transparent 50%);
            color: #f8fafc;
            min-height: 100vh;
            padding: 20px;
        }

        .dashboard-container {
            max-width: 900px;
            margin: 40px auto;
        }

        /* Hero Section */
        .welcome-box {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
        }

        /* Seating Card - THE HIGHLIGHT */
        .seat-highlight {
            background: linear-gradient(135deg, var(--primary) 0%, #4338ca 100%);
            border-radius: 24px;
            padding: 40px;
            color: white;
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.3);
            display: flex;
            align-items: center;
            justify-content: space-between;
            overflow: hidden;
            position: relative;
        }

        .seat-highlight::after {
            content: "\f0c0"; /* FontAwesome Icon */
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            right: -20px;
            bottom: -20px;
            font-size: 150px;
            opacity: 0.1;
        }

        .seat-info h2 { font-size: 3rem; font-weight: 800; margin: 0; }
        .seat-info span { text-transform: uppercase; letter-spacing: 2px; opacity: 0.8; font-weight: 600; }

        /* Detail Tables */
        .info-card {
            background: rgba(30, 41, 59, 0.5);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 25px;
            height: 100%;
        }

        .data-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .data-row:last-child { border: none; }
        .label { color: #94a3b8; font-weight: 500; }
        .value { font-weight: 600; color: #f1f5f9; }

        .btn-logout {
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
            padding: 10px 25px;
            border-radius: 12px;
            transition: 0.3s;
            text-decoration: none;
        }
        .btn-logout:hover { background: #ef4444; color: white; }
    </style>
</head>
<body>

<div class="dashboard-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="welcome-text">
            <h4 class="fw-bold mb-0 text-white">Hello, <?php echo explode(' ', $student['name'])[0]; ?> 👋</h4>
            <p class="text-secondary small">Your exam details are ready</p>
        </div>
        <a href="logout.php" class="btn-logout"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
    </div>

    <div class="seat-highlight mb-4">
        <div class="seat-info">
            <span>Room / Hall</span>
            <h2 class="mb-3"><?php echo $allotment['hall'] ?? 'Pending...'; ?></h2>
            <div class="badge bg-white bg-opacity-20 p-2 px-3 rounded-pill">
                <i class="fas fa-chair me-2"></i>Seat Number: <strong><?php echo $allotment['seat_no'] ?? 'N/A'; ?></strong>
            </div>
        </div>
        <div class="d-none d-md-block">
            <i class="fas fa-map-location-dot fa-5x opacity-50"></i>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="info-card">
                <h6 class="fw-bold mb-3 text-primary"><i class="fas fa-user-circle me-2"></i>Student Profile</h6>
                <div class="data-row">
                    <span class="label">Register No.</span>
                    <span class="value"><?php echo $student['register_no']; ?></span>
                </div>
                <div class="data-row">
                    <span class="label">Course</span>
                    <span class="value"><?php echo $student['course']; ?></span>
                </div>
                <div class="data-row">
                    <span class="label">Department</span>
                    <span class="value"><?php echo $student['department']; ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="info-card">
                <h6 class="fw-bold mb-3 text-accent"><i class="fas fa-calendar-check me-2"></i>Upcoming Exam</h6>
                <div class="data-row">
                    <span class="label">Subject</span>
                    <span class="value"><?php echo $exam['name']; ?></span>
                </div>
                <div class="data-row">
                    <span class="label">Date</span>
                    <span class="value"><?php echo date('d M Y', strtotime($exam['date'])); ?></span>
                </div>
                <div class="data-row">
                    <span class="label">Timing</span>
                    <span class="value text-accent">
                        <?php echo date('h:i A', strtotime($exam['start_time'])); ?> - 
                        <?php echo date('h:i A', strtotime($exam['end_time'])); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 p-3 rounded-4 bg-primary bg-opacity-10 border border-primary border-opacity-20 text-center">
        <p class="small mb-0 opacity-75">
            <i class="fas fa-info-circle me-2"></i> Please carry your physical ID card and reach the hall 15 minutes before the start time.
        </p>
    </div>
</div>

</body>
</html>