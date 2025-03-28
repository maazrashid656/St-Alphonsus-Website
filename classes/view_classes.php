<?php
require '../includes/db.php'; // Include database connection

$query = "SELECT c.ClassID, c.ClassName, c.Capacity, 
                 CONCAT(t.FirstName, ' ', t.LastName) AS TeacherName 
          FROM Classes c
          LEFT JOIN Teachers t ON c.TeacherID = t.TeacherID
          ORDER BY c.ClassID";
$stmt = $conn->prepare($query);
$stmt->execute();
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Classes</title>
</head>
<body>
    <h2>Class List</h2>
    <a href="add_class.php">Add New Class</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Class Name</th>
            <th>Capacity</th>
            <th>Teacher</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($classes as $class): ?>
        <tr>
            <td><?= $class['ClassID'] ?></td>
            <td><?= htmlspecialchars($class['ClassName']) ?></td>
            <td><?= $class['Capacity'] ?></td>
            <td><?= $class['TeacherName'] ? htmlspecialchars($class['TeacherName']) : 'Not Assigned' ?></td>
            <td>
                <a href="edit_class.php?id=<?= $class['ClassID'] ?>">Edit</a> |
                <a href="delete_class.php?id=<?= $class['ClassID'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="../index.php">Back to Home</a>
</body>
</html>
