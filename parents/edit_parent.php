<?php
require '../includes/db.php'; // Include database connection

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$parentID = $_GET['id'];

// Fetch parent data
$query = "SELECT * FROM Parents WHERE ParentID = :parentID";
$stmt = $conn->prepare($query);
$stmt->bindParam(':parentID', $parentID);
$stmt->execute();
$parent = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$parent) {
    die("Parent not found.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $phone = $_POST['Phone'];
    $email = $_POST['Email'];
    $address = $_POST['Address'];

    $updateQuery = "UPDATE Parents SET FirstName = :firstName, LastName = :lastName, 
                    Phone = :phone, Email = :email, Address = :address
                    WHERE ParentID = :parentID";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':parentID', $parentID);
    $stmt->execute();

    header("Location: view_parents.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Parent</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>
    <h2>Edit Parent</h2>
    <form method="POST">
        <label>First Name:</label>
        <input type="text" name="FirstName" value="<?= htmlspecialchars($parent['FirstName']) ?>" required><br>

        <label>Last Name:</label>
        <input type="text" name="LastName" value="<?= htmlspecialchars($parent['LastName']) ?>" required><br>

        <label>Phone Number:</label>
        <input type="text" name="Phone" value="<?= htmlspecialchars($parent['Phone']) ?>" required><br>

        <label>Email:</label>
        <input type="email" name="Email" value="<?= htmlspecialchars($parent['Email']) ?>" required><br>

        <label>Address:</label>
        <textarea name="Address" required><?= htmlspecialchars($parent['Address']) ?></textarea><br>

        <button type="submit">Update Parent</button>
    </form>
    <br>
    <a href="view_parents.php">Back to Parents</a>
</body>
</html>
