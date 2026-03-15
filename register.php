<?php
// Student interest registration form
include "db.php";

if (!isset($_GET['programme_id'])) {
    die("Programme not selected.");
}

$programme_id = $_GET['programme_id'];

$stmt = $conn->prepare("SELECT * FROM Programmes WHERE ProgrammeID = ?");
$stmt->bind_param("i", $programme_id);
$stmt->execute();
$result = $stmt->get_result();
$programme = $result->fetch_assoc();

if (!$programme) {
    die("Programme not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Interest</title>
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

<section class="form-page">
    <div class="form-card">
        <h1>Register Your Interest</h1>
        <h2><?php echo htmlspecialchars($programme['ProgrammeName']); ?></h2>
        <p class="programme-text"><?php echo htmlspecialchars($programme['Description']); ?></p>

        <form action="process.php" method="POST">
            <input type="hidden" name="programme_id" value="<?php echo $programme_id; ?>">

            <label for="student_name">Your Name</label>
            <input type="text" id="student_name" name="student_name" required>

            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Submit</button>
        </form>
    </div>
</section>

</body>
</html>