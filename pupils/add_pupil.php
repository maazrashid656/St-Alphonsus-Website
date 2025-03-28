<?php
require '../includes/db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $dob = $_POST['DOB'];
    $address = $_POST['Address'];
    $medicalInfo = $_POST['MedicalInfo'];
    
    // Ensure ClassID and ParentID are integers or NULL
    $classID = isset($_POST['ClassID']) && is_numeric($_POST['ClassID']) ? (int) $_POST['ClassID'] : NULL;
    $parentID = isset($_POST['ParentID']) && is_numeric($_POST['ParentID']) ? (int) $_POST['ParentID'] : NULL;

    $query = "INSERT INTO Pupils (FirstName, LastName, DOB, Address, MedicalInfo, ClassID, ParentID) 
              VALUES (:firstName, :lastName, :dob, :address, :medicalInfo, :classID, :parentID)";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':dob', $dob);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':medicalInfo', $medicalInfo);
    $stmt->bindParam(':classID', $classID, PDO::PARAM_INT);
    $stmt->bindParam(':parentID', $parentID, PDO::PARAM_INT);
    
    $stmt->execute();

    header("Location: view_pupils.php");
    exit();
}

// Fetch classes
$query = "SELECT ClassID, ClassName FROM Classes";
$stmt = $conn->prepare($query);
$stmt->execute();
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Pupil</title>
</head>
<body>
    <h2>Add New Pupil</h2>
    <form method="POST">
        <label for="FirstName">First Name:</label>
        <input type="text" name="FirstName" required><br>
        
        <label for="LastName">Last Name:</label>
        <input type="text" name="LastName" required><br>
        
        <label for="DOB">Date of Birth:</label>
        <input type="date" name="DOB" required><br>

        <label for="Address">Address:</label>
        <textarea name="Address" required></textarea><br>

        <label for="MedicalInfo">Medical Information:</label>
        <textarea name="MedicalInfo"></textarea><br>

        <label for="ClassID">Assign to Class:</label>
        <select name="ClassID">
            <option value="">None</option>
            <?php foreach ($classes as $class): ?>
                <option value="<?= htmlspecialchars($class['ClassID']) ?>">
                    <?= htmlspecialchars($class['ClassName'], ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="ParentID">Parent ID:</label>
        <input type="text" name="ParentID" required><br>

        <button type="submit">Add Pupil</button>
    </form>
    <br>
    <a href="view_pupils.php">Back to Pupils</a>
</body>
</html>
