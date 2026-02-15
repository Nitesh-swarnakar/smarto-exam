<?php
include '../db.php';
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); }

// Add hall
if (isset($_POST['add_hall'])) {
    $name = $_POST['name'];
    $sql = "INSERT INTO halls (name) VALUES ('$name')";
    $conn->query($sql);
}

// Delete hall
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM halls WHERE id = $id";
    $conn->query($sql);
}

// Edit hall (simple, POST from form)
if (isset($_POST['edit_hall'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $sql = "UPDATE halls SET name = '$name' WHERE id = $id";
    $conn->query($sql);
}

$halls = $conn->query("SELECT * FROM halls");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Halls</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <h2>Manage Halls</h2>
    <form method="POST" class="mb-3">
        <input type="text" name="name" placeholder="Enter Hall Name" required>
        <button type="submit" name="add_hall" class="btn btn-primary">Add Hall</button>
    </form>
    <table class="table">
        <thead><tr><th>Hall Name</th><th>Actions</th></tr></thead>
        <tbody>
            <?php while ($row = $halls->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td>
                        <!-- Edit form -->
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
                            <button type="submit" name="edit_hall" class="btn btn-warning btn-sm">Edit</button>
                        </form>
                        <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>