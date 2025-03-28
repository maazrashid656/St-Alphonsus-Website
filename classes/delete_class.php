<?php
require '../db.php'; // Include database connection

// Get class ID from URL
$class_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($class_id <= 0) {
    die('Invalid class ID.');
}

// Delete class from database
$query = "DELETE FROM classes WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->execute(['id' => $class_id]);

// Redirect to view classes page
header('Location: view_classes.php');
exit;
?>
