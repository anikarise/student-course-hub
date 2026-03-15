<?php
include "db.php";

$sql = "SELECT InterestedStudents.StudentName,
               InterestedStudents.Email,
               InterestedStudents.RegisteredAt,
               Programmes.ProgrammeName
        FROM InterestedStudents
        JOIN Programmes ON InterestedStudents.ProgrammeID = Programmes.ProgrammeID
        ORDER BY InterestedStudents.RegisteredAt DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Student Interests</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <div class="nav-container">
        <div class="logo">Student Course Hub</div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="admin.php">Admin</a>
        </div>
    </div>
</nav>

<section class="page-section">
    <h1 class="section-title">Registered Student Interests</h1>

    <div class="admin-list">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='admin-card'>";
                echo "<h3>" . htmlspecialchars($row["ProgrammeName"]) . "</h3>";
                echo "<p><strong>Student Name:</strong> " . htmlspecialchars($row["StudentName"]) . "</p>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($row["Email"]) . "</p>";
                echo "<p><strong>Registered At:</strong> " . htmlspecialchars($row["RegisteredAt"]) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No student interests found.</p>";
        }
        ?>
    </div>
</section>

</body>
</html>