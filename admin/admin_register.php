<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Register</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../navbar.php'; ?>
    <main>
        <h1>Admin Register</h1>
        <form action="admin_register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Register</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include '../db.php';
            $username = $_POST["username"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $email = $_POST["email"];

            $sql = "INSERT INTO admins (username, password, email) VALUES ('$username', '$password', '$email')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['admin_username'] = $username;
                header("Location: admin.php");
                exit();
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