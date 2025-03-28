<?php
require 'includes/db.php'; // Include database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School</title>
    <link rel="stylesheet" href="assets/css/style.css"> 
</head>
<body>
    <header>
        <h1>Welcome to St Alphonsus Primary School Database</h1>
        <nav>
            <ul>
                <li><a href="classes/view_classes.php">Manage Classes</a></li>
                <li><a href="pupils/view_pupils.php">Manage Pupils</a></li>
                <li><a href="parents/view_parents.php">Manage Parents</a></li>
                <li><a href="teachers/view_teachers.php">Manage Teachers</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <p>Select a category from the navigation above to manage school records.</p>
    </main>
</body>
</html>
