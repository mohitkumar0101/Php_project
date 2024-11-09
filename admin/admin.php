<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../navbar.php'; ?>
    <main>
        <h1>Admin Dashboard</h1>
        <a href="create_event.php" class="register-button">Create Event</a>
        <h2>Manage Events</h2>
        <form method="GET" action="admin.php" class="search-form">
            <input type="text" name="search" placeholder="Search events by title">
            <button type="submit">Search</button>
        </form>
        <div class="events-grid">
            <?php
            include '../db.php';
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $sql = "SELECT events.*, COUNT(registrations.event_id) AS registrations_count 
                    FROM events 
                    LEFT JOIN registrations ON events.id = registrations.event_id 
                    WHERE events.title LIKE '%$search%' 
                    GROUP BY events.id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='event'>";
                    echo "<h3>" . $row["title"] . "</h3>";
                    echo "<p>" . $row["description"] . "</p>";
                    echo "<p>Date: " . $row["date"] . "</p>";
                    echo "<p>Location: " . $row["location"] . "</p>";
                    echo "<p>Registrations: " . $row["registrations_count"] . "</p>";
                    echo "<a href='edit_event.php?id=" . $row["id"] . "'>Edit</a> | ";
                    echo "<a href='delete_event.php?id=" . $row["id"] . "'>Delete</a> | ";
                    echo "<a href='view_registrations.php?event_id=" . $row["id"] . "' class='view-registrations-button'>View Registrations</a>";
                    echo "</div>";
                }
            } else {
                echo "No events found.";
            }
            $conn->close();
            ?>
        </div>
    </main>
    <?php include '../footer.php'; ?>
</body>
</html>