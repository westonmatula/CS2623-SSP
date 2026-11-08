<?php declare(strict_types=1);

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: ../SSP06_21_2/login.php');
    exit;
}
