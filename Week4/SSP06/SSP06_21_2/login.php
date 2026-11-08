<?php declare(strict_types=1);

session_start();

// Simulated user store
$users = [
    'admin' => password_hash('secret123', PASSWORD_DEFAULT),
    'jsmith' => password_hash('php4life!', PASSWORD_DEFAULT)
];

$error = '';
$username = $_COOKIE['remember_user'] ?? '';

if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = filter_input(
        INPUT_POST,
        'username',
        FILTER_SANITIZE_SPECIAL_CHARS
    ) ?? '';

    $password = filter_input(
        INPUT_POST,
        'password',
        FILTER_DEFAULT
    ) ?? '';

    $remember = isset($_POST['remember']);

    if ($_SESSION['attempts'] >= 3) {
        $error = 'Account locked after 3 failed attempts.';

    } elseif (
        isset($users[$username]) &&
        password_verify($password, $users[$username])
    ) {

        session_regenerate_id(true);

        $_SESSION['user'] = $username;
        $_SESSION['login_at'] = time();
        $_SESSION['attempts'] = 0;

        if ($remember) {
            setcookie(
                'remember_user',
                $username,
                [
                    'expires' => time() + (86400 * 30),
                    'path' => '/',
                    'httponly' => true,
                    'samesite' => 'Lax'
                ]
            );
        } else {
            setcookie('remember_user', '', time() - 3600, '/');
        }

        header('Location: dashboard.php');
        exit;

    } else {
        $_SESSION['attempts']++;
        $error = 'Invalid username or password. Attempts: '
            . $_SESSION['attempts'] . ' of 3.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h1>Login</h1>

<?php if ($error): ?>
    <p>
        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
    </p>
<?php endif; ?>

<form method="post">

    <label>
        Username:
        <input
            type="text"
            name="username"
            value="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>"
            autocomplete="username"
            required
        >
    </label>

    <br><br>

    <label>
        Password:
        <input
            type="password"
            name="password"
            autocomplete="current-password"
            required
        >
    </label>

    <br><br>

    <label>
        <input type="checkbox" name="remember">
        Remember me
    </label>

    <br><br>

    <button type="submit">Log in</button>

</form>

</body>
</html>
