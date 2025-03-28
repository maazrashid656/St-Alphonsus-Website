<?php
require '../includes/db.php'; // Include database connection

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$teacherID = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $address = $_POST['Address'];
    $phoneNumber = $_POST['PhoneNumber'];
    $annualSalary = $_POST['AnnualSalary'];
    $backgroundCheck = $_POST['BackgroundCheckStatus'];

    $query = "UPDATE Teachers SET FirstName=:firstName, LastName=:lastName, Address=:address, 
              PhoneNumber=:phoneNumber, AnnualSalary=:annualSalary, BackgroundCheckStatus=:backgroundCheck 
              WHERE TeacherID=:teacherID";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phoneNumber', $phoneNumber);
    $stmt->bindParam(':annualSalary', $annualSalary);
    $stmt->bindParam(':backgroundCheck', $backgroundCheck);
    $stmt->bindParam(':teacherID', $teacherID);
    $stmt->execute();

    header("Location: view_teachers.php");
    exit();
}

$query = "SELECT * FROM Teachers WHERE TeacherID=:teacherID";
$stmt = $conn->prepare($query);
$stmt->bindParam(':teacherID', $teacherID);
$stmt->execute();
$teacher = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Teacher</title>
</head>
<body>
    <h2>Edit Teacher</h2>
    <form method="POST" action="">
        <label>First Name:</label>
        <input type="text" name="FirstName" value="<?= htmlspecialchars($teacher['FirstName']) ?>" required><br>

        <label>Last Name:</label>
        <input type="text" name="LastName" value="<?= htmlspecialchars($teacher['LastName']) ?>" required><br>

        <label>Address:</label>
        <input type="text" name="Address" value="<?= htmlspecialchars($teacher['Address']) ?>" required><br>

        <label>Phone Number:</label>
        <input type="text" name="PhoneNumber" value="<?= htmlspecialchars($teacher['PhoneNumber']) ?>" required><br>

        <label>Annual Salary:</label>
        <input type="number" step="0.01" name="AnnualSalary" value="<?= $teacher['AnnualSalary'] ?>" required><br>

        <label>Background Check Status:</label>
        <select name="BackgroundCheckStatus" required>
            <option value="Pending" <?= $teacher['BackgroundCheckStatus'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="Approved" <?= $teacher['BackgroundCheckStatus'] == 'Approved' ? 'selected' : '' ?>>Approved</option>
            <option value="Rejected" <?= $teacher['BackgroundCheckStatus'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
        </select><br>

        <button type="submit">Update Teacher</button>
    </form>
    <br>
    <a href="view_teachers.php">Back to Teachers</a>
</body>
</html>
