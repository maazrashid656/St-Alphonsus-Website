<?php
require '../includes/db.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $phone = $_POST['Phone']; // Updated to match DB column
    $email = $_POST['Email'];
    $address = $_POST['Address'];

    // Correct SQL query with exact column names
    $query = "INSERT INTO Parents (FirstName, LastName, Phone, Email, Address) 
              VALUES (:firstName, :lastName, :phone, :email, :address)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    
    $stmt->execute();
    header("Location: view_parents.php"); // Redirect after adding
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Parent</title>
</head>
<body>
    <h2>Add New Parent</h2>
    <form method="POST" action="">
        <label for="FirstName">First Name:</label>
        <input type="text" name="FirstName" required><br>
        
        <label for="LastName">Last Name:</label>
        <input type="text" name="LastName" required><br>
        
        <label for="Phone">Phone:</label>
        <input type="text" name="Phone" required><br>  <!-- Updated field name -->
        
        <label for="Email">Email:</label>
        <input type="email" name="Email" required><br>
        
        <label for="Address">Address:</label>
        <textarea name="Address" required></textarea><br>
        
        <button type="submit">Add Parent</button>
    </form>
    <br>
    <a href="view_parents.php">Back to Parents</a>
</body>
</html>
