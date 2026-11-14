<?php

$dataDir = __DIR__ . '/data/';
$logFile = $dataDir . 'log.txt';

$message = '';
$fileContent = '';

// Create data directory if it does not exist
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

// Download log
if (isset($_GET['download']) && file_exists($logFile)) {
    header('Content-Type: text/plain; charset=UTF-8');
    header('Content-Disposition: attachment; filename="log.txt"');
    header('Content-Length: ' . filesize($logFile));

    readfile($logFile);
    exit;
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
    if ($action === false || $action === null) {
        $action = '';
    }

    // Clear log
    if ($action === 'clear') {
        file_put_contents($logFile, '');
        chmod($logFile, 0644);
        $message = 'Log cleared successfully.';
    }

    // Save new entry
    elseif ($action === 'save') {

        $entry = filter_input(
            INPUT_POST,
            'entry',
            FILTER_SANITIZE_SPECIAL_CHARS
        );

        if ($entry === false || $entry === null) {
            $entry = '';
        }

        $entry = trim($entry);

        if ($entry !== '') {

            // Apollo-compatible Central Time
            $now = new DateTime(
                'now',
                new DateTimeZone('America/Chicago')
            );

            $timestamp = $now->format('Y-m-d H:i:s');

            $line = $timestamp . ' - ' . $entry . PHP_EOL;

            file_put_contents(
                $logFile,
                $line,
                FILE_APPEND | LOCK_EX
            );

            chmod($logFile, 0644);

            $message = 'Entry saved successfully.';

        } else {
            $message = 'Entry cannot be empty.';
        }
    }
}

// Read log file
if (file_exists($logFile)) {
    $fileContent = file_get_contents($logFile);
}

// File size
$fileSize = file_exists($logFile) ? filesize($logFile) : 0;

// List files in data directory
$files = array_filter(
    scandir($dataDir),
    function ($f) use ($dataDir) {
        return is_file($dataDir . basename($f));
    }
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SSP08 - File I/O</title>
</head>

<body>

<h1>SSP08 - Exercise 16-1</h1>
<h2>File I/O Demo</h2>

<?php if ($message !== ''): ?>
    <p class="message">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </p>
<?php endif; ?>

<div class="section">

    <h2>Add Log Entry</h2>

    <form method="post">
        <input type="hidden" name="action" value="save">

        <label for="entry">New log entry:</label><br><br>

        <input type="text" id="entry" name="entry" maxlength="200">

        <button type="submit">Save Entry</button>
    </form>

</div>

<div class="section">

    <h2>Log Contents</h2>

    <?php if ($fileContent !== ''): ?>

        <pre><?= htmlspecialchars($fileContent, ENT_QUOTES, 'UTF-8') ?></pre>

    <?php else: ?>

        <p>No entries yet.</p>

    <?php endif; ?>

    <p>
        File Size:
        <?= number_format($fileSize) ?> bytes
    </p>

    <p>
        <a href="?download=1">Download Log</a>
    </p>

    <form method="post"
          onsubmit="return confirm('Are you sure you want to clear the log?');">

        <input type="hidden" name="action" value="clear">

        <button type="submit">Clear Log</button>

    </form>

</div>

<div class="section">

    <h2>Files in /data/</h2>

    <ul>
        <?php foreach ($files as $f): ?>
            <li>
                <?= htmlspecialchars(basename($f), ENT_QUOTES, 'UTF-8') ?>
            </li>
        <?php endforeach; ?>
    </ul>

</div>

</body>
</html>
