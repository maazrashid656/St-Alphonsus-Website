<?php
require '../includes/db.php'; // Include database connection

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$pupilID = $_GET['id'];

// Fetch pupil data
$query = "SELECT * FROM Pupils WHERE PupilID = :pupilID";
$stmt = $conn->prepare($query);
$stmt->bindParam(':pupilID', $pupilID);
$stmt->execute();
$pupil = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pupil) {
    die("Pupil not found.");
}

// Fetch all classes
$query = "SELECT ClassID, ClassName FROM Classes";
$stmt = $conn->prepare($query);
$stmt->execute();
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $dob = $_POST['DOB'];
    $address = $_POST['Address'];
    $medicalInfo = $_POST['MedicalInfo'];
    $classID = !empty($_POST['ClassID']) ? $_POST['ClassID'] : NULL;

    $updateQuery = "UPDATE Pupils SET FirstName = :firstName, LastName = :lastName, DOB = :dob, 
                    Address = :address, MedicalInfo = :medicalInfo, ClassID = :classID WHERE PupilID = :pupilID";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':dob', $dob);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':medicalInfo', $medicalInfo);
    $stmt->bindParam(':classID', $classID, PDO::PARAM_INT);
    $stmt->bindParam(':pupilID', $pupilID);
    $stmt->execute();

    header("Location: view_pupils.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Pupil</title>
</head>
<body>
    <h2>Edit Pupil</h2>
    <form method="POST">
        <label for="FirstName">First Name:</label>
        <input type="text" name="FirstName" value="<?= htmlspecialchars($pupil['FirstName']) ?>" required><br>
        
        <label for="LastName">Last Name:</label>
        <input type="text" name="LastName" value="<?= htmlspecialchars($pupil['LastName']) ?>" required><br>
        
        <label for="DOB">Date of Birth:</label>
        <input type="date" name="DOB" value="<?= $pupil['DOB'] ?>" required><br>

        <label for="Address">Address:</label>
        <textarea name="Address" required><?= htmlspecialchars($pupil['Address']) ?></textarea><br>

        <label for="MedicalInfo">Medical Information:</label>
        <textarea name="MedicalInfo"><?= htmlspecialchars($pupil['MedicalInfo']) ?></textarea><br>

        <label for="ClassID">Assign to Class:</label>
        <select name="ClassID">
            <option value="">None</option>
            <?php foreach ($classes as $class): ?>
                <option value="<?= $class['ClassID'] ?>" 
                    <?= ($class['ClassID'] == $pupil['ClassID']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($class['ClassName']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Update Pupil</button>
    </form>
    <br>
    <a href="view_pupils.php">Back to Pupils</a>
</body>
</html>
