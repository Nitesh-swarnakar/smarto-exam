<?php
include '../db.php';
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); }

// Delete student
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM students WHERE id = $id";
    $conn->query($sql);
}

// Edit student
if (isset($_POST['edit_student'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $course = $_POST['course'];
    $sql = "UPDATE students SET name = '$name', email = '$email', mobile = '$mobile', course = '$course' WHERE id = $id";
    $conn->query($sql);
}

$students = $conn->query("SELECT * FROM students");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <h2>Manage Students</h2>
    <table class="table">
        <thead><tr><th>Register No</th><th>Name</th><th>Email</th><th>Mobile</th><th>Course</th><th>Actions</th></tr></thead>
        <tbody>
            <?php while ($row = $students->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['register_no']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><?php echo $row['course']; ?></td>
                    <td>
                        <!-- Edit form -->
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
                            <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
                            <input type="text" name="mobile" value="<?php echo $row['mobile']; ?>" required>
                            <input type="text" name="course" value="<?php echo $row['course']; ?>" required>
                            <button type="submit" name="edit_student" class="btn btn-warning btn-sm">Edit</button>
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