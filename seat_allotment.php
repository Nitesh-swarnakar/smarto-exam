<?php
include '../db.php';
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); }

// Add allotment (simplified, assume exam ID 1)
if (isset($_POST['add_allotment'])) {
    $student_id = $_POST['student_id'];
    $hall_id = $_POST['hall_id'];
    $seat_no = $_POST['seat_no'];
    $exam_id = 1;  // Hardcoded; make dynamic in full version
    $sql = "INSERT INTO seat_allotments (student_id, exam_id, hall_id, seat_no) VALUES ($student_id, $exam_id, $hall_id, $seat_no)";
    $conn->query($sql);
}

// Delete allotment
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM seat_allotments WHERE id = $id";
    $conn->query($sql);
}

// Reassign (similar to edit)
if (isset($_POST['reassign'])) {
    $id = $_POST['id'];
    $hall_id = $_POST['hall_id'];
    $seat_no = $_POST['seat_no'];
    $sql = "UPDATE seat_allotments SET hall_id = $hall_id, seat_no = $seat_no WHERE id = $id";
    $conn->query($sql);
}

$allotments = $conn->query("SELECT sa.id, s.register_no, s.name, s.class, s.department, s.course, s.email, h.name AS hall, sa.seat_no 
                            FROM seat_allotments sa JOIN students s ON sa.student_id = s.id JOIN halls h ON sa.hall_id = h.id");

$students = $conn->query("SELECT id, name FROM students");
$halls = $conn->query("SELECT id, name FROM halls");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seat Allotment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <h2>Seat Allotment</h2>
    <form method="POST" class="mb-3">
        <select name="student_id" required><option>Select Student</option><?php while($row = $students->fetch_assoc()) echo "<option value='{$row['id']}'>{$row['name']}</option>"; ?></select>
        <select name="hall_id" required><option>Select Hall</option><?php $halls->data_seek(0); while($row = $halls->fetch_assoc()) echo "<option value='{$row['id']}'>{$row['name']}</option>"; ?></select>
        <input type="number" name="seat_no" placeholder="Seat No" required>
        <button type="submit" name="add_allotment" class="btn btn-primary">Add Student</button>
    </form>
    <table class="table">
        <thead><tr><th>Register No</th><th>Name</th><th>Class</th><th>Department</th><th>Course</th><th>Email</th><th>Hall</th><th>Seat</th><th>Actions</th></tr></thead>
        <tbody>
            <?php while ($row = $allotments->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['register_no']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['class']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo $row['course']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['hall']; ?></td>
                    <td><?php echo $row['seat_no']; ?></td>
                    <td>
                        <!-- Reassign form -->
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <select name="hall_id" required><?php $halls->data_seek(0); while($h = $halls->fetch_assoc()) echo "<option value='{$h['id']}' " . ($h['id'] == $row['hall_id'] ? 'selected' : '') . ">{$h['name']}</option>"; ?></select>
                            <input type="number" name="seat_no" value="<?php echo $row['seat_no']; ?>" required>
                            <button type="submit" name="reassign" class="btn btn-success btn-sm">Reassign</button>
                        </form>
                        <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="dashboard.php">Back</a>
</body>
</html>