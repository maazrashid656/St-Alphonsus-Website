<?php
require '../includes/db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $address = $_POST['Address'];
    $phoneNumber = $_POST['PhoneNumber'];
    $annualSalary = $_POST['AnnualSalary'];
    $backgroundCheck = $_POST['BackgroundCheckStatus'];

    $query = "INSERT INTO Teachers (FirstName, LastName, Address, PhoneNumber, AnnualSalary, BackgroundCheckStatus) 
              VALUES (:firstName, :lastName, :address, :phoneNumber, :annualSalary, :backgroundCheck)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phoneNumber', $phoneNumber);
    $stmt->bindParam(':annualSalary', $annualSalary);
    $stmt->bindParam(':backgroundCheck', $backgroundCheck);
    $stmt->execute();

    header("Location: view_teachers.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Teacher</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>
    <h2>Add New Teacher</h2>
    <form method="POST" action="">
        <label>First Name:</label>
        <input type="text" name="FirstName" required><br>

        <label>Last Name:</label>
        <input type="text" name="LastName" required><br>

        <label>Address:</label>
        <input type="text" name="Address" required><br>

        <label>Phone Number:</label>
        <input type="text" name="PhoneNumber" required><br>

        <label>Annual Salary:</label>
        <input type="number" step="0.01" name="AnnualSalary" required><br>

        <label>Background Check Status:</label>
        <select name="BackgroundCheckStatus" required>
            <option value="Pending">Pending</option>
            <option value="Approved">Approved</option>
            <option value="Rejected">Rejected</option>
        </select><br>

        <button type="submit">Add Teacher</button>
    </form>
    <br>
    <a href="view_teachers.php">Back to Teachers</a>
</body>
</html>
