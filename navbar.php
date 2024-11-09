<?php
session_start();
?>
<nav>
    <div class="nav-left">
        <strong>EMS</strong>
    </div>
    <ul>
        <?php if (isset($_SESSION['admin_username'])): ?>
            <li><a href="/event/admin/admin.php">Home</a></li>
            <li>Welcome, <?php echo $_SESSION['admin_username']; ?></li>
            <li><a href="/event/admin/admin_logout.php">Logout</a></li>
        <?php elseif (isset($_SESSION['username'])): ?>
            <li><a href="/event/index.php">Home</a></li>
            <li>Welcome, <?php echo $_SESSION['username']; ?></li>
            <li><a href="/event/user/logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="/event/index.php">Home</a></li>
            <li><a href="/event/user/register.php">Register</a></li>
            <li><a href="/event/user/login.php">Login</a></li>
            <li><a href="/event/admin/admin_register.php">Admin Register</a></li>
            <li><a href="/event/admin/admin_login.php">Admin Login</a></li>
        <?php endif; ?>
    </ul>
</nav>