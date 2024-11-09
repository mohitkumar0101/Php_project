<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include '../db.php';
$username = $_SESSION['username'];

// Get user_id from the users table
$user_sql = "SELECT id FROM users WHERE username='$username'";
$user_result = $conn->query($user_sql);
$user_row = $user_result->fetch_assoc();
$user_id = $user_row['id'];

// Get registered events for the user
$sql = "SELECT events.title, events.description, events.date, events.location 
        FROM events 
        JOIN registrations ON events.id = registrations.event_id 
        WHERE registrations.user_id = '$user_id'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registered Events</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../navbar.php'; ?>
    <main>
        <h1>Registered Events</h1>
        <div class="events-grid">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='event'>";
                    echo "<h3>" . $row["title"] . "</h3>";
                    echo "<p>" . $row["description"] . "</p>";
                    echo "<p>Date: " . $row["date"] . "</p>";
                    echo "<p>Location: " . $row["location"] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "No registered events found.";
            }
            $conn->close();
            ?>
        </div>
        <a href="../index.php" class="register-button">Back to Events</a>
    </main>
    <?php include '../footer.php'; ?>
</body>
</html>