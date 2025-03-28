<?php
require '../includes/db.php'; // Include database connection

$query = "SELECT * FROM Teachers ORDER BY TeacherID";
$stmt = $conn->prepare($query);
$stmt->execute();
$teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Teachers</title>
</head>
<body>
    <h2>Teacher List</h2>
    <a href="add_teacher.php">Add New Teacher</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Annual Salary</th>
            <th>Background Check Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($teachers as $teacher): ?>
        <tr>
            <td><?= $teacher['TeacherID'] ?></td>
            <td><?= htmlspecialchars($teacher['FirstName']) ?></td>
            <td><?= htmlspecialchars($teacher['LastName']) ?></td>
            <td><?= htmlspecialchars($teacher['Address']) ?></td>
            <td><?= htmlspecialchars($teacher['PhoneNumber']) ?></td>
            <td><?= $teacher['AnnualSalary'] ?></td>
            <td><?= htmlspecialchars($teacher['BackgroundCheckStatus']) ?></td>
            <td>
                <a href="edit_teacher.php?id=<?= $teacher['TeacherID'] ?>">Edit</a> |
                <a href="delete_teacher.php?id=<?= $teacher['TeacherID'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="../index.php">Back to Home</a>
</body>
</html>
