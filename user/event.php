<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Details</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../navbar.php'; ?>
    <main>
        <h1>Event Details</h1>
        <?php
        include '../db.php';
        $event_id = $_GET['id'];
        $sql = "SELECT * FROM events WHERE id=$event_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h2>" . $row["title"] . "</h2>";
            echo "<p>" . $row["description"] . "</p>";
            echo "<p>Date: " . $row["date"] . "</p>";
            echo "<p>Location: " . $row["location"] . "</p>";
            if (isset($_SESSION['username'])) {
                echo "<a href='register_event.php?event_id=$event_id' class='register-button'>Register for the Event</a>";
            } else {
                echo "<p><a href='login.php'>Login</a> to register for this event.</p>";
            }
        } else {
            echo "Event not found.";
        }
        $conn->close();
        ?>
        <a href="../index.php">Back to Events</a>
    </main>
    <?php include '../footer.php'; ?>
</body>
</html>