<?php
require '../includes/db.php';

if (isset($_GET['id'])) {
    $parentID = $_GET['id'];
    $query = "DELETE FROM Parents WHERE ParentID = :parentID";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':parentID', $parentID);
    $stmt->execute();
}

header("Location: view_parents.php");
exit();
?>
