<?php declare(strict_types=1);

require 'auth.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
</head>
<body>

<h1>My Profile</h1>

<p>
    Username:
    <?= htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8') ?>
</p>

<p>You are successfully logged in.</p>

<a href="dashboard.php">Back to Dashboard</a>

<br><br>

<a href="logout.php">Log Out</a>

</body>
</html>
