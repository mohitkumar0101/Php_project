<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../navbar.php'; ?>
    <main>
        <h1>Admin Login</h1>
        <form action="admin_login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include '../db.php';
            $username = $_POST["username"];
            $password = $_POST["password"];

            $sql = "SELECT * FROM admins WHERE username='$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row["password"])) {
                    $_SESSION['admin_username'] = $username;
                    header("Location: admin.php");
                    exit();
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "No admin found with that username.";
            }

            $conn->close();
        }
        ?>
    </main>
    <?php include '../footer.php'; ?>
</body>
</html>