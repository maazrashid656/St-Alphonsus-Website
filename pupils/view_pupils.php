<?php
require '../includes/db.php'; // Include database connection

$query = "SELECT p.PupilID, p.FirstName, p.LastName, p.DOB, p.Address, p.MedicalInfo, p.ClassID, p.ParentID
          FROM Pupils p";
$stmt = $conn->prepare($query);
$stmt->execute();
$pupils = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Pupils</title>
</head>
<body>
    <h2>Pupil List</h2>
    <a href="add_pupil.php">Add New Pupil</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Address</th>
            <th>Medical Info</th>
            <th>Class</th>
            <th>ParentID</th>
            <th>Actions</th>
            
        </tr>
        <?php foreach ($pupils as $pupil): ?>
            <tr>
                <td><?= $pupil['PupilID'] ?></td>
                <td><?= htmlspecialchars($pupil['FirstName'] . ' ' . $pupil['LastName']) ?></td>
                <td><?= $pupil['DOB'] ?></td>
                <td><?= $pupil['Address'] ?></td>
                <td><?= $pupil['MedicalInfo'] ?></td>
                <td><?= $pupil['ClassID'] ?></td>
                <td><?= $pupil['ParentID'] ?></td>
                <td>
                    <a href="edit_pupil.php?id=<?= $pupil['PupilID'] ?>">Edit</a> | 
                    <a href="delete_pupil.php?id=<?= $pupil['PupilID'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="../index.php">Back to Home</a>
</body>
</html>
