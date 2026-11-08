<?php declare(strict_types=1);

require 'auth.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

<h1>Welcome, <?= htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8') ?>!</h1>

<p>You have successfully logged in.</p>

<p>
    Logged in at:
    <?= date('g:i A', $_SESSION['login_at']) ?>
</p>

<h2>Navigation</h2>

<ul>
    <li><a href="profile.php">My Profile</a></li>
    <li><a href="../SSP06_23_1/index.php">Shopping Cart</a></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>

</body>
</html>
