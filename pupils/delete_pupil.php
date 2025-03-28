<?php
require '../includes/db.php'; // Include database connection

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$pupilID = $_GET['id'];

// Check if pupil exists before deleting
$query = "SELECT * FROM Pupils WHERE PupilID = :pupilID";
$stmt = $conn->prepare($query);
$stmt->bindParam(':pupilID', $pupilID);
$stmt->execute();
$pupil = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pupil) {
    die("Pupil not found.");
}

// Delete pupil record
$deleteQuery = "DELETE FROM Pupils WHERE PupilID = :pupilID";
$deleteStmt = $conn->prepare($deleteQuery);
$deleteStmt->bindParam(':pupilID', $pupilID);
$deleteStmt->execute();

header("Location: view_pupils.php");
exit();
?>
