<?php
include '../db.php';
$event_id = $_GET['id'];

$sql = "DELETE FROM events WHERE id=$event_id";

if ($conn->query($sql) === TRUE) {
    echo "Event deleted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: admin.php");
exit();
?>