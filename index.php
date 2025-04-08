<?php
require 'includes/db.php'; // Include database connection

// Summary stats
$totalTeachers = $conn->query("SELECT COUNT(*) FROM Teachers")->fetchColumn();
$totalPupils = $conn->query("SELECT COUNT(*) FROM Pupils")->fetchColumn();
$totalParents = $conn->query("SELECT COUNT(*) FROM Parents")->fetchColumn();
$totalClasses = $conn->query("SELECT COUNT(*) FROM Classes")->fetchColumn();

// Pupils per class for chart
$classData = $conn->query("
    SELECT ClassName, COUNT(*) as PupilsCount 
    FROM Pupils 
    JOIN Classes ON Pupils.ClassID = Classes.ClassID 
    GROUP BY ClassName
")->fetchAll(PDO::FETCH_ASSOC);

$classLabels = json_encode(array_column($classData, 'ClassName'));
$pupilCounts = json_encode(array_column($classData, 'PupilsCount'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <section class="dashboard">
            <div class="stat-box">👨‍🏫 Teachers: <?= $totalTeachers ?></div>
            <div class="stat-box">👶 Pupils: <?= $totalPupils ?></div>
            <div class="stat-box">👨‍👩‍👧 Parents: <?= $totalParents ?></div>
            <div class="stat-box">🏫 Classes: <?= $totalClasses ?></div>
        </section>

        <section class="chart-section">
            <h2>Pupils per Class</h2>
            <canvas id="pupilsPerClassChart" width="400" height="200"></canvas>
        </section>
    </main>

    <script>
        const ctx = document.getElementById('pupilsPerClassChart').getContext('2d');
        const pupilsPerClassChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= $classLabels ?>,
                datasets: [{
                    label: 'Number of Pupils',
                    data: <?= $pupilCounts ?>,
                    backgroundColor: '#0078d4'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Pupils per Class'
                    },
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
