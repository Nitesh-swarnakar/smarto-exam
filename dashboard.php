<?php
include '../db.php';
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

/* --- DASHBOARD COUNTS --- */
$total_students = $conn->query("SELECT COUNT(*) FROM students")->fetch_row()[0] ?? 0;
$exams_scheduled = $conn->query("SELECT COUNT(*) FROM exams")->fetch_row()[0] ?? 0;
$halls_assigned = $conn->query("SELECT COUNT(*) FROM halls")->fetch_row()[0] ?? 0;

/* --- PDF GENERATION LOGIC (UNCHANGED) --- */
if (isset($_POST['generate_pdf'])) {
    require('fpdf/fpdf.php');
    $pdf = new FPDF('L','mm','A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',18);
    $pdf->Cell(0,10,'Exam Hall Seating Arrangement',0,1,'C');
    $pdf->Ln(5);
    $pdf->SetFont('Arial','B',10);
    $headers = ['Reg No', 'Name', 'Class', 'Department', 'Course', 'Email', 'Hall', 'Seat'];
    $widths = [25, 35, 20, 35, 30, 45, 25, 20];
    foreach($headers as $i => $head) $pdf->Cell($widths[$i], 8, $head, 1);
    $pdf->Ln();
    $sql = "SELECT s.register_no, s.name, s.class, s.department, s.course, s.email, h.name AS hall, sa.seat_no
            FROM seat_allotments sa
            JOIN students s ON sa.student_id = s.id
            JOIN halls h ON sa.hall_id = h.id";
    $result = $conn->query($sql);
    $pdf->SetFont('Arial','',9);
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(25,8,$row['register_no'],1); $pdf->Cell(35,8,$row['name'],1);
        $pdf->Cell(20,8,$row['class'],1); $pdf->Cell(35,8,$row['department'],1);
        $pdf->Cell(30,8,$row['course'],1); $pdf->Cell(45,8,$row['email'],1);
        $pdf->Cell(25,8,$row['hall'],1); $pdf->Cell(20,8,$row['seat_no'],1);
        $pdf->Ln();
    }
    $pdf->Output('D','Seating_Arrangement.pdf');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smarto Exam | Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #6366f1;
            --bg-body: #f8fafc;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-body); }
        
        /* Creative Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: #0f172a;
            color: #fff;
            padding: 1.5rem;
            transition: all 0.3s;
        }
        .nav-link {
            color: #94a3b8;
            padding: 0.8rem 1rem;
            border-radius: 12px;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            transition: all 0.2s;
            text-decoration: none;
        }
        .nav-link i { width: 25px; font-size: 1.1rem; }
        .nav-link:hover, .nav-link.active {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
        }
        .logout-btn { color: #ef4444 !important; margin-top: auto; }

        /* Main Content Area */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2.5rem;
        }

        /* Creative Stat Cards */
        .stat-card {
            border: none;
            border-radius: 20px;
            padding: 1.5rem;
            background: #fff;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        .stat-card:hover { transform: translateY(-5px); }
        .icon-box {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .bg-soft-primary { background: #e0e7ff; color: #4338ca; }
        .bg-soft-success { background: #dcfce7; color: #15803d; }
        .bg-soft-warning { background: #fef9c3; color: #a16207; }

        .btn-generate {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            border: none;
            border-radius: 12px;
            padding: 12px 25px;
            font-weight: 600;
            color: #000;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }
    </style>
</head>
<body>

    <nav class="sidebar d-flex flex-column">
        <div class="d-flex align-items-center mb-4 px-2">
            <div class="bg-primary rounded-3 p-2 me-2">
                <i class="fas fa-graduation-cap text-white"></i>
            </div>
            <h5 class="mb-0 fw-bold">Smarto Exam</h5>
        </div>
        
        <div class="nav-list flex-grow-1">
            <a href="#" class="nav-link active"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="seat_allotment.php" class="nav-link"><i class="fas fa-chair"></i> Seat Allotment</a>
            <a href="exam_schedule.php" class="nav-link"><i class="fas fa-calendar-alt"></i> Schedule Exam</a>
            <a href="manage_students.php" class="nav-link"><i class="fas fa-user-graduate"></i> Manage Students</a>
            <a href="manage_halls.php" class="nav-link"><i class="fas fa-building"></i> Manage Halls</a>
        </div>

        <a href="logout.php" class="nav-link logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>

    <main class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold text-slate-800">Welcome, Krishna 🎓</h2>
                <p class="text-secondary">Overview of your exam management system</p>
            </div>
            <form method="POST">
                <button type="submit" name="generate_pdf" class="btn btn-generate">
                    <i class="fas fa-file-pdf me-2"></i> Export Seating Plan
                </button>
            </form>
        </header>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="icon-box bg-soft-primary"><i class="fas fa-users"></i></div>
                    <span class="text-secondary small fw-bold">TOTAL STUDENTS</span>
                    <h2 class="fw-bold mt-1"><?php echo number_format($total_students); ?></h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="icon-box bg-soft-success"><i class="fas fa-file-invoice"></i></div>
                    <span class="text-secondary small fw-bold">EXAMS SCHEDULED</span>
                    <h2 class="fw-bold mt-1"><?php echo $exams_scheduled; ?></h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="icon-box bg-soft-warning"><i class="fas fa-door-open"></i></div>
                    <span class="text-secondary small fw-bold">HALLS ACTIVE</span>
                    <h2 class="fw-bold mt-1"><?php echo $halls_assigned; ?></h2>
                </div>
            </div>
        </div>

        <div class="mt-5 card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold mb-4">Quick Actions</h5>
            <div class="d-flex gap-3">
                <div class="p-3 bg-light rounded-3 flex-fill text-center border">
                    <i class="fas fa-plus-circle text-primary d-block mb-2 fs-4"></i>
                    <a href="manage_students.php" class="text-decoration-none text-dark small fw-bold">Add Student</a>
                </div>
                <div class="p-3 bg-light rounded-3 flex-fill text-center border">
                    <i class="fas fa-tools text-primary d-block mb-2 fs-4"></i>
                    <a href="seat_allotment.php" class="text-decoration-none text-dark small fw-bold">Run AI Allotment</a>
                </div>
                <div class="p-3 bg-light rounded-3 flex-fill text-center border">
                    <i class="fas fa-print text-primary d-block mb-2 fs-4"></i>
                    <a href="#" class="text-decoration-none text-dark small fw-bold">Print Hall Tickets</a>
                </div>
            </div>
        </div>
    </main>

</body>
</html>