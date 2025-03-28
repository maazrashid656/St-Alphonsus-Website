<?php
require '../includes/db.php'; // Include database connection

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$teacherID = $_GET['id'];

// Check if the teacher exists before deleting
$query = "SELECT * FROM Teachers WHERE TeacherID = :teacherID";
$stmt = $conn->prepare($query);
$stmt->bindParam(':teacherID', $teacherID);
$stmt->execute();
$teacher = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$teacher) {
    die("Teacher not found.");
}

// Delete teacher record
$deleteQuery = "DELETE FROM Teachers WHERE TeacherID = :teacherID";
$deleteStmt = $conn->prepare($deleteQuery);
$deleteStmt->bindParam(':teacherID', $teacherID);
$deleteStmt->execute();

// Redirect back to the teachers list
header("Location: view_teachers.php");
exit();
?>
