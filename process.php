<?php
// Processes and stores student interest in the database
include "db.php";

$programme_id = $_POST['programme_id'];
$name = trim($_POST['student_name']);
$email = trim($_POST['email']);

$message = "";
// Prevent duplicate registrations and validate user input
if (empty($name) || empty($email)) 
$message_class = "message-box";

if (empty($name) || empty($email)) {
    $message = "Please fill in all fields.";
    $message_class .= " error";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = "Please enter a valid email address.";
    $message_class .= " error";
} else {
    $check_stmt = $conn->prepare("SELECT InterestID FROM InterestedStudents WHERE ProgrammeID = ? AND Email = ?");
    $check_stmt->bind_param("is", $programme_id, $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $message = "You have already registered interest in this programme.";
        $message_class .= " warning";
    } else {
        $stmt = $conn->prepare("INSERT INTO InterestedStudents (ProgrammeID, StudentName, Email) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $programme_id, $name, $email);

        if ($stmt->execute()) {
            $message = "Thank you! Your interest has been registered.";
            $message_class .= " success";
        } else {
            $message = "Something went wrong. Please try again.";
            $message_class .= " error";
        }

        $stmt->close();
    }

    $check_stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Status</title>
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
        <h1>Registration Status</h1>
        <div class="<?php echo $message_class; ?>">
            <p><?php echo htmlspecialchars($message); ?></p>
        </div>
        <a class="btn" href="index.php">Go back to homepage</a>
    </div>
</section>

</body>
</html>