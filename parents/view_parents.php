<?php
require '../includes/db.php'; // Include database connection

$query = "SELECT * FROM Parents";
$stmt = $conn->prepare($query);
$stmt->execute();
$parents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Parents</title>
</head>
<body>
    <h2>Parents List</h2>
    <a href="add_parent.php">Add New Parent</a><br><br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($parents as $parent): ?>
            <tr>
                <td><?= $parent['ParentID'] ?></td>
                <td><?= htmlspecialchars($parent['FirstName'] . ' ' . $parent['LastName']) ?></td>
                <td><?= htmlspecialchars($parent['Phone']) ?></td>
                <td><?= htmlspecialchars($parent['Email']) ?></td>
                <td><?= htmlspecialchars($parent['Address']) ?></td>
                <td>
                    <a href="edit_parent.php?id=<?= $parent['ParentID'] ?>">Edit</a> |
                    <a href="delete_parent.php?id=<?= $parent['ParentID'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="../index.php">Back to Home</a>
</body>
</html>
