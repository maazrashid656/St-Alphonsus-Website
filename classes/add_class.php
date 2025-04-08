
<?php
require '../includes/db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $className = $_POST['ClassName'];
    $capacity = $_POST['Capacity'];
    $teacherID = !empty($_POST['TeacherID']) ? $_POST['TeacherID'] : NULL;

    $query = "INSERT INTO Classes (ClassName, Capacity, TeacherID) VALUES (:className, :capacity, :teacherID)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':className', $className);
    $stmt->bindParam(':capacity', $capacity);
    $stmt->bindParam(':teacherID', $teacherID, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: view_classes.php");
    exit();
}

// Fetch all teachers
$query = "SELECT TeacherID, CONCAT(FirstName, ' ', LastName) AS TeacherName FROM Teachers";
$stmt = $conn->prepare($query);
$stmt->execute();
$teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Class</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>
    <h2>Add New Class</h2>
    <form method="POST" action="">
        <label for="ClassName">Class Name:</label>
        <input type="text" name="ClassName" required><br>
        
        <label for="Capacity">Capacity:</label>
        <input type="number" name="Capacity" required><br>
        
        <label for="TeacherID">Assign Teacher (Optional):</label>
        <select name="TeacherID">
            <option value="">None</option>
            <?php foreach ($teachers as $teacher): ?>
                <option value="<?= $teacher['TeacherID'] ?>"> <?= htmlspecialchars($teacher['TeacherName']) ?> </option>
            <?php endforeach; ?>
        </select>
        <br>
        <button type="submit">Add Class</button>
    </form>
    <br>
    <a href="view_classes.php">Back to Classes</a>
</body>
</html>
