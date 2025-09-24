<?php
include 'db.php';

// CREATE - Insert new employee
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];

    $sql = "INSERT INTO employees (name, email, phone, department) VALUES ('$name','$email','$phone','$department')";
    $conn->query($sql);
    header("Location: index.php");
}

// DELETE employee
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM employees WHERE id=$id";
    $conn->query($sql);
    header("Location: index.php");
}

// UPDATE employee
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];

    $sql = "UPDATE employees SET name='$name', email='$email', phone='$phone', department='$department' WHERE id=$id";
    $conn->query($sql);
    header("Location: index.php");
}

// FETCH employees
$result = $conn->query("SELECT * FROM employees");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Registration</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        table { width: 80%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background: #eee; }
        form { margin-top: 20px; }
    </style>
</head>
<body>

<h2>Employee Registration</h2>

<!-- Add New Employee Form -->
<form method="POST" action="">
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="phone" placeholder="Phone">
    <input type="text" name="department" placeholder="Department">
    <button type="submit" name="add">Add Employee</button>
</form>

<!-- Display Employees -->
<table>
    <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Department</th><th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['phone'] ?></td>
        <td><?= $row['department'] ?></td>
        <td>
            <!-- Edit Form -->
            <form method="POST" action="" style="display:inline;">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <input type="text" name="name" value="<?= $row['name'] ?>" required>
                <input type="email" name="email" value="<?= $row['email'] ?>" required>
                <input type="text" name="phone" value="<?= $row['phone'] ?>">
                <input type="text" name="department" value="<?= $row['department'] ?>">
                <button type="submit" name="update">Update</button>
            </form>

            <!-- Delete Button -->
            <a href="index.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this record?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>