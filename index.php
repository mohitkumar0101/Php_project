<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Management</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <main>
        <h1>Welcome to Event Management</h1>
        <h2>Upcoming Events</h2>
        <form method="GET" action="index.php" class="search-form">
            <input type="text" name="search" placeholder="Search events by title">
            <button type="submit">Search</button>
        </form>
        <div class="events-grid">
            <?php
            include 'db.php';
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $sql = "SELECT * FROM events WHERE title LIKE '%$search%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='event'>";
                    echo "<h3>" . $row["title"] . "</h3>";
                    echo "<p>" . $row["description"] . "</p>";
                    echo "<p>Date: " . $row["date"] . "</p>";
                    echo "<p>Location: " . $row["location"] . "</p>";
                    echo "<a href='user/event.php?id=" . $row["id"] . "'>View Details</a>";
                    echo "</div>";
                }
            } else {
                echo "No events found.";
            }
            $conn->close();
            ?>
        </div>
        <a href="user/registered_events.php" class="register-button">Show Registered Events</a>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>