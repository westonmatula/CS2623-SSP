<?php declare(strict_types=1);

// Require login
require '../SSP06_21_2/auth.php';

// Clear shopping cart
unset($_SESSION['cart']);

// Redirect to shopping cart page
header('Location: index.php');
exit;
