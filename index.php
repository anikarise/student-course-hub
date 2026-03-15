<?php
// Displays available programmes from the database
include "db.php";

$sql = "SELECT * FROM Programmes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Course Hub</title>
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

<section class="hero">
    <div class="hero-content">
        <h1>Find Your Future Course</h1>
        <p>Explore modern undergraduate and postgraduate programmes and register your interest with ease.</p>
    </div>
</section>

<section class="page-section">
    <h2 class="section-title">Available Programmes</h2>

    <div class="card-grid">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                echo "<div class='card'>";
                echo "<div class='card-image-wrapper'>";

                if ($row["ProgrammeName"] == "BSc Computer Science") {
                    echo "<img src='images/cs.jpg' class='programme-img' alt='Computer Science programme image'>";
                } elseif ($row["ProgrammeName"] == "BSc Cyber Security") {
                    echo "<img src='images/cyber.jpg' class='programme-img' alt='Cyber Security programme image'>";
                } elseif ($row["ProgrammeName"] == "MSc Artificial Intelligence") {
                    echo "<img src='images/ai.jpg' class='programme-img' alt='Artificial Intelligence programme image'>";
                } else {
                    echo "<img src='images/cs.jpg' class='programme-img' alt='Programme image'>";
                }

                echo "</div>";
                echo "<div class='card-content'>";
                echo "<h3>" . htmlspecialchars($row["ProgrammeName"]) . "</h3>";
                echo "<p>" . htmlspecialchars($row["Description"]) . "</p>";
                echo "<a class='btn' href='register.php?programme_id=" . $row["ProgrammeID"] . "'>Register Interest</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No programmes found.</p>";
        }
        ?>
    </div>
</section>

</body>
</html>