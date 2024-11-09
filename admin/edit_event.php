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
    <title>Edit Event</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../navbar.php'; ?>
    <main>
        <h1>Edit Event</h1>
        <?php
        include '../db.php';
        $event_id = $_GET['id'];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST["title"];
            $description = $_POST["description"];
            $date = $_POST["date"];
            $location = $_POST["location"];

            $sql = "UPDATE events SET title='$title', description='$description', date='$date', location='$location' WHERE id=$event_id";

            if ($conn->query($sql) === TRUE) {
                echo "Event updated successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        } else {
            $sql = "SELECT * FROM events WHERE id=$event_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form action="edit_event.php?id=<?php echo $event_id; ?>" method="post">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="<?php echo $row["title"]; ?>" required>
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required><?php echo $row["description"]; ?></textarea>
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" value="<?php echo $row["date"]; ?>" required>
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" value="<?php echo $row["location"]; ?>" required>
                    <button type="submit">Update Event</button>
                </form>
                <?php
            } else {
                echo "Event not found.";
            }
            $conn->close();
        }
        ?>
        <a href="admin.php">Back to Admin Dashboard</a>
    </main>
    <?php include '../footer.php'; ?>
</body>
</html>