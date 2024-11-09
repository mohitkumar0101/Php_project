<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}

include '../db.php';
$event_id = $_GET['event_id'];
$sql = "SELECT users.username, users.email 
        FROM registrations 
        JOIN users ON registrations.user_id = users.id 
        WHERE registrations.event_id = '$event_id'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Registrations</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../navbar.php'; ?>
    <main>
        <h1>Registrations for Event ID: <?php echo $event_id; ?></h1>
        <div class="registrations-list">
            <?php
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Username</th><th>Email</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No registrations found.";
            }
            $conn->close();
            ?>
        </div>
        <a href="admin.php">Back to Dashboard</a>
    </main>
    <?php include '../footer.php'; ?>
</body>
</html>