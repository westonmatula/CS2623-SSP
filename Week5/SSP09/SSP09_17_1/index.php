<?php

// Timezone for Apollo
$tz = new DateTimeZone('America/Chicago');

// Form values
$inputText = filter_input(
    INPUT_POST,
    'text',
    FILTER_SANITIZE_SPECIAL_CHARS
);
if ($inputText === false || $inputText === null) {
    $inputText = '';
}

$inputNum = filter_input(
    INPUT_POST,
    'amount',
    FILTER_VALIDATE_FLOAT
);

if ($inputNum === false || $inputNum === null) {
    $inputNum = 0.0;
}

$searchFor = filter_input(
    INPUT_POST,
    'search',
    FILTER_SANITIZE_SPECIAL_CHARS
);
if ($searchFor === false || $searchFor === null) {
    $searchFor = '';
}

// String operations
$lower = strtolower($inputText);
$upper = strtoupper($inputText);
$trimmed = trim($inputText);
$length = strlen($trimmed);

// Search operations
$searchLower = strtolower($searchFor);
$trimmedLower = strtolower($trimmed);

$contains = $searchFor !== ''
    ? (stripos($trimmedLower, $searchLower) !== false)
    : null;

$startsWith = $searchFor !== ''
    ? (stripos($trimmedLower, $searchLower) === 0)
    : null;

$endsWith = $searchFor !== ''
    ? (substr($trimmedLower, -strlen($searchLower)) === $searchLower)
    : null;

// Replace vowels with *
$vowelReplacement = str_replace(
    array('a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'),
    '*',
    $inputText
);

// First 10 characters
$firstTen = substr($inputText, 0, 10);

// Word count with empty string handling
if ($trimmed === '') {
    $wordCount = 0;
} else {
    $wordCount = count(preg_split('/\s+/', $trimmed));
}

// Number operations
$formatted = number_format((float)$inputNum, 2);
$currency = '$' . $formatted;

$randNum = rand(1, 100);

$rounded = round((float)$inputNum, 0);
$ceiling = (int)ceil((float)$inputNum);

// sprintf padded number
$paddedAmount = sprintf('%10.2f', (float)$inputNum);

// Date operations
$now = new DateTime('now', $tz);

$formattedDate = $now->format('l, F j, Y');
$formattedTime = $now->format('g:i:s A T');

$tomorrow = (new DateTime('tomorrow', $tz))->format('Y-m-d');

// Days until Christmas
$christmas = new DateTime('December 25', $tz);
$daysUntilXmas = $now->diff($christmas)->days;

// Days since January 1
$yearStart = new DateTime($now->format('Y') . '-01-01', $tz);

$dateDifference = date_diff($yearStart, $now);
$daysSinceNewYear = $dateDifference->days;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SSP09 - Strings, Numbers & Dates</title>

</head>

<body>

<h1>SSP09 - Exercise 17-1</h1>
<h2>String, Number & Date Functions</h2>

<div class="section">

    <h2>Input Form</h2>

    <form method="post">

        <label>
            Enter text:<br>
            <input type="text" name="text" size="40"
                   value="<?= htmlspecialchars($inputText, ENT_QUOTES, 'UTF-8') ?>">
        </label>

        <label>
            Search within text:<br>
            <input type="text" name="search" size="20"
                   value="<?= htmlspecialchars($searchFor, ENT_QUOTES, 'UTF-8') ?>">
        </label>

        <label>
            Dollar amount:<br>
            <input type="number" step="0.01" name="amount"
                   value="<?= htmlspecialchars((string)$inputNum, ENT_QUOTES, 'UTF-8') ?>">
        </label>

        <button type="submit">Analyze</button>

    </form>

</div>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>

<div class="section">

    <h2>String Results</h2>

    <ul>
        <li>
            Original:
            <?= htmlspecialchars($inputText, ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            Lowercase:
            <?= htmlspecialchars($lower, ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            Uppercase:
            <?= htmlspecialchars($upper, ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            Trimmed:
            <?= htmlspecialchars($trimmed, ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            Length:
            <?= (int)$length ?> characters
        </li>

        <li>
            Vowels replaced:
            <?= htmlspecialchars($vowelReplacement, ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            First 10 characters:
            <?= htmlspecialchars($firstTen, ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            Word count:
            <?= (int)$wordCount ?>
        </li>

        <?php if ($contains !== null): ?>

            <li>
                Contains search text:
                <?= $contains ? 'Yes' : 'No' ?>
            </li>

            <li>
                Starts with search text:
                <?= $startsWith ? 'Yes' : 'No' ?>
            </li>

            <li>
                Ends with search text:
                <?= $endsWith ? 'Yes' : 'No' ?>
            </li>

        <?php endif; ?>

    </ul>

</div>

<div class="section">

    <h2>Number Results</h2>

    <ul>
        <li>
            Formatted currency:
            <?= htmlspecialchars($currency, ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            Rounded:
            <?= htmlspecialchars(number_format((float)$rounded, 0), ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            Ceiling:
            <?= (int)$ceiling ?>
        </li>

        <li>
            Random number (1-100):
            <?= (int)$randNum ?>
        </li>

        <li>
            Padded amount:
            <?= htmlspecialchars($paddedAmount, ENT_QUOTES, 'UTF-8') ?>
        </li>
    </ul>

</div>

<?php endif; ?>

<div class="section">

    <h2>Date & Time (US Central)</h2>

    <ul>
        <li>
            Today:
            <?= htmlspecialchars($formattedDate, ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            Time:
            <?= htmlspecialchars($formattedTime, ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            Tomorrow:
            <?= htmlspecialchars($tomorrow, ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li>
            Days until Christmas:
            <?= (int)$daysUntilXmas ?>
        </li>

        <li>
            Days since January 1:
            <?= (int)$daysSinceNewYear ?>
        </li>
    </ul>

</div>

</body>
</html>
