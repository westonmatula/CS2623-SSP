<?php

// FizzBuzz function
function fn_fizzbuzz($n)
{
    if ($n % 15 === 0) {
        return 'FizzBuzz';
    } elseif ($n % 3 === 0) {
        return 'Fizz';
    } elseif ($n % 5 === 0) {
        return 'Buzz';
    } else {
        return (string)$n;
    }
}

// Day of week function
function fn_dayOfWeek($dow)
{
    if ($dow === 0) {
        return 'Sunday';
    } elseif ($dow === 1) {
        return 'Monday';
    } elseif ($dow === 2) {
        return 'Tuesday';
    } elseif ($dow === 3) {
        return 'Wednesday';
    } elseif ($dow === 4) {
        return 'Thursday';
    } elseif ($dow === 5) {
        return 'Friday';
    } else {
        return 'Saturday';
    }
}

// Grade function using switch
function fn_gradeLabel($score)
{
    switch (true) {
        case $score >= 90:
            return 'A';
        case $score >= 80:
            return 'B';
        case $score >= 70:
            return 'C';
        case $score >= 60:
            return 'D';
        default:
            return 'F';
    }
}

// Form values
$start = filter_input(INPUT_POST, 'start', FILTER_VALIDATE_INT);
if ($start === false || $start === null) {
    $start = 1;
} else {
    $start = (int)$start;
}

$end = filter_input(INPUT_POST, 'end', FILTER_VALIDATE_INT);
if ($end === false || $end === null) {
    $end = 20;
} else {
    $end = (int)$end;
}

$score = filter_input(INPUT_POST, 'score', FILTER_VALIDATE_INT);
if ($score === false || $score === null) {
    $score = -1;
} else {
    $score = (int)$score;
}

$repeatWord = filter_input(INPUT_POST, 'repeat_word', FILTER_SANITIZE_SPECIAL_CHARS);
if ($repeatWord === false || $repeatWord === null) {
    $repeatWord = '';
}
$repeatWord = trim($repeatWord);

$repeatCount = filter_input(INPUT_POST, 'repeat_count', FILTER_VALIDATE_INT);
if ($repeatCount === false || $repeatCount === null) {
    $repeatCount = 0;
} else {
    $repeatCount = (int)$repeatCount;
}

// Validation
if ($start < 1) $start = 1;
if ($start > 100) $start = 100;
if ($end < 1) $end = 1;
if ($end > 100) $end = 100;

if ($score < 0 || $score > 100) {
    $score = -1;
}

if ($repeatCount < 0) $repeatCount = 0;
if ($repeatCount > 20) $repeatCount = 20;

$hasError = $end < $start;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SSP08 - Control Structures</title>
</head>
<body>

<h1>SSP08 - Exercise 03-1</h1>
<h2>Control Structures Demo</h2>

<form method="post">
    <label>
        Start:
        <input type="number" name="start" min="1" max="100"
               value="<?= (int)$start ?>">
    </label>

    <label>
        End:
        <input type="number" name="end" min="1" max="100"
               value="<?= (int)$end ?>">
    </label>

    <label>
        Score (0-100):
        <input type="number" name="score" min="0" max="100"
               value="<?= $score >= 0 ? (int)$score : '' ?>">
    </label>

    <label>
        Repeat word:
        <input type="text" name="repeat_word"
               value="<?= htmlspecialchars($repeatWord, ENT_QUOTES, 'UTF-8') ?>">
    </label>

    <label>
        Repeat count (maximum 20):
        <input type="number" name="repeat_count" min="0" max="20"
               value="<?= (int)$repeatCount ?>">
    </label>

    <button type="submit">Run</button>
</form>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>

    <?php if ($hasError): ?>

        <p class="error">Error: Start must be less than or equal to End.</p>

    <?php else: ?>

        <div class="results">

            <h2>FizzBuzz (for loop)</h2>
            <ul>
                <?php for ($i = $start; $i <= $end; $i++): ?>
                    <li><?= htmlspecialchars(fn_fizzbuzz($i), ENT_QUOTES, 'UTF-8') ?></li>
                <?php endfor; ?>
            </ul>

            <h2>Day Names (while loop)</h2>
            <ul>
                <?php
                $d = 0;
                while ($d <= 6):
                ?>
                    <li><?= htmlspecialchars(fn_dayOfWeek($d), ENT_QUOTES, 'UTF-8') ?></li>
                    <?php $d++; ?>
                <?php endwhile; ?>
            </ul>

            <h2>Grade Lookup (switch)</h2>

            <?php if ($score >= 0): ?>
                <p>
                    Score <?= (int)$score ?>:
                    Grade <strong><?= htmlspecialchars(fn_gradeLabel($score), ENT_QUOTES, 'UTF-8') ?></strong>
                </p>
            <?php else: ?>
                <p>No valid score entered.</p>
            <?php endif; ?>

            <h2>Multiplication Table (do-while)</h2>

            <table>
                <?php
                $row = 1;
                do {
                ?>
                    <tr>
                        <?php
                        $col = 1;
                        do {
                        ?>
                            <td><?= (int)$row * (int)$col ?></td>
                            <?php $col++; ?>
                        <?php } while ($col <= 5); ?>
                    </tr>
                    <?php $row++; ?>
                <?php } while ($row <= 5); ?>
            </table>

            <h2>Count Down (do-while)</h2>
            <ul>
                <?php
                $count = $end;
                do {
                ?>
                    <li><?= (int)$count ?></li>
                    <?php $count--; ?>
                <?php } while ($count >= $start); ?>
            </ul>

            <h2>Repeat Word (while loop)</h2>

            <?php if ($repeatWord !== '' && $repeatCount > 0): ?>
                <ul>
                    <?php
                    $repeat = 0;
                    while ($repeat < $repeatCount):
                    ?>
                        <li><?= htmlspecialchars($repeatWord, ENT_QUOTES, 'UTF-8') ?></li>
                        <?php $repeat++; ?>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>Enter a word and a repeat count to display results.</p>
            <?php endif; ?>

        </div>

    <?php endif; ?>

<?php endif; ?>

</body>
</html>
