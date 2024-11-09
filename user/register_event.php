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

if ($user_result->num_rows > 0) {
    $user_row = $user_result->fetch_assoc();
    $user_id = $user_row['id'];

    $event_id = $_GET['event_id'];

    $sql = "INSERT INTO registrations (user_id, event_id) VALUES ('$user_id', '$event_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location: registered_events.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "User not found.";
}

$conn->close();
?>