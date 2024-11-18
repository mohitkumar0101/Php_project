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
    <title>Create Event</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../navbar.php'; ?>
    <main>
        <h1>Create Event</h1>
        <form action="create_event.php" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
            <button type="submit">Create Event</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include '../db.php';
            $title = mysqli_real_escape_string($conn, $_POST["title"]);
            $description = mysqli_real_escape_string($conn, $_POST["description"]);
            $date = mysqli_real_escape_string($conn, $_POST["date"]);
            $location = mysqli_real_escape_string($conn, $_POST["location"]);

            $sql = "INSERT INTO events (title, description, date, location) VALUES ('$title', '$description', '$date', '$location')";

            if ($conn->query($sql) === TRUE) {
                echo "Event created successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>
    </main>
    <?php include '../footer.php'; ?>
</body>
</html>