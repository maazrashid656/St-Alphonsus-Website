<?php
require '../includes/db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $classID = $_POST['ClassID'];
    $className = $_POST['ClassName'];
    $capacity = $_POST['Capacity'];
    $teacherID = !empty($_POST['TeacherID']) ? $_POST['TeacherID'] : NULL;

    $query = "UPDATE Classes SET ClassName = :className, Capacity = :capacity, TeacherID = :teacherID WHERE ClassID = :classID";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':classID', $classID);
    $stmt->bindParam(':className', $className);
    $stmt->bindParam(':capacity', $capacity);
    $stmt->bindParam(':teacherID', $teacherID, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: view_classes.php");
    exit();
}

// Fetch class details
$classID = $_GET['id'];
$query = "SELECT * FROM Classes WHERE ClassID = :classID";
$stmt = $conn->prepare($query);
$stmt->bindParam(':classID', $classID);
$stmt->execute();
$class = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch all teachers
$query = "SELECT TeacherID, CONCAT(FirstName, ' ', LastName) AS TeacherName FROM Teachers";
$stmt = $conn->prepare($query);
$stmt->execute();
$teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Class</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>
    <h2>Edit Class</h2>
    <form method="POST" action="">
        <input type="hidden" name="ClassID" value="<?= $class['ClassID'] ?>">
        
        <label for="ClassName">Class Name:</label>
        <input type="text" name="ClassName" value="<?= htmlspecialchars($class['ClassName']) ?>" required><br>
        
        <label for="Capacity">Capacity:</label>
        <input type="number" name="Capacity" value="<?= $class['Capacity'] ?>" required><br>
        
        <label for="TeacherID">Assign Teacher (Optional):</label>
        <select name="TeacherID">
            <option value="">None</option>
            <?php foreach ($teachers as $teacher): ?>
                <option value="<?= $teacher['TeacherID'] ?>" <?= ($class['TeacherID'] == $teacher['TeacherID']) ? 'selected' : '' ?>> <?= htmlspecialchars($teacher['TeacherName']) ?> </option>
            <?php endforeach; ?>
        </select>
        <br>
        <button type="submit">Update Class</button>
    </form>
    <br>
    <a href="view_classes.php">Back to Classes</a>
</body>
</html>
