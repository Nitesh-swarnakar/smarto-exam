<?php
include '../db.php';
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); }

// Add exam
if (isset($_POST['schedule_exam'])) {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $department = $_POST['department'];
    $course = $_POST['course'];
    $sql = "INSERT INTO exams (name, date, start_time, end_time, department, course) VALUES ('$name', '$date', '$start_time', '$end_time', '$department', '$course')";
    $conn->query($sql);
}

$exams = $conn->query("SELECT * FROM exams");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule Exam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <h2>Schedule Exam</h2>
    <form method="POST" class="mb-3">
        <input type="text" name="name" placeholder="Exam Name" required><br>
        <input type="date" name="date" required><br>
        <input type="time" name="start_time" required><br>
        <input type="time" name="end_time" required><br>
        <select name="department"><option>All Departments</option><option>Computer Science</option></select><br>
        <select name="course"><option>All Courses</option><option>BCA</option></select><br>
        <button type="submit" name="schedule_exam" class="btn btn-primary">Schedule Exam</button>
    </form>
    <h4>View Scheduled Exams</h4>
    <table class="table">
        <thead><tr><th>Name</th><th>Date</th><th>Start</th><th>End</th><th>Dept</th><th>Course</th></tr></thead>
        <tbody>
            <?php while ($row = $exams->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['start_time']; ?></td>
                    <td><?php echo $row['end_time']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo $row['course']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="dashboard.php">Back</a>
</body>
</html>