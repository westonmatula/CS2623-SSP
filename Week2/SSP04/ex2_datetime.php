<?php
declare(strict_types=1);

$tz = new DateTimeZone('America/Chicago');
$now = new DateTime('now', $tz);

$today_name = $now->format('l');
$today_date = $now->format('F j, Y');
$today_time = $now->format('g:i:s A');

// Birthdate calculations
$birth_str = '1999-05-14';
$birth_date = DateTime::createFromFormat('!Y-m-d', $birth_str, $tz);

if ($birth_date === false) {
    $age_years = 'Unable to parse birthdate';
    $age_days = 'Unable to calculate elapsed days';
} else {
    $age_interval = $birth_date->diff($now);
    $age_years = (string) $age_interval->y;
    $age_days = (string) $age_interval->days;
}

// Countdown to the end of the semester.
$end_date = new DateTime('2026-12-15 23:59:59', $tz);
$interval = $now->diff($end_date);
$days_left = (string) $interval->days;

if ($now > $end_date) {
    $countdown = 'The selected semester end date has passed.';
} else {
    $countdown = $days_left . ' days remaining';
}

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSP04 Exercise 2 - Date and Time</title>
    <link rel="stylesheet" href="../SSP03/main.css">
</head>
<body>
<?php require_once __DIR__ . '/../SSP03/PHP/include_header.php'; ?>
<?php require_once __DIR__ . '/../SSP03/PHP/Include_topNav.php'; ?>

<div id="page-wrapper">
    <?php require_once __DIR__ . '/../SSP03/PHP/include_leftNav.php'; ?>

    <main>
        <h2>DateTime Demonstrations</h2>

        <table id="weekly-planner" border="1" cellpadding="6" cellspacing="0">
            <tr>
                <th>Requirement</th>
                <th>Result</th>
            </tr>
            <tr>
                <td>Current day</td>
                <td><?php echo h($today_name); ?></td>
            </tr>
            <tr>
                <td>Current date</td>
                <td><?php echo h($today_date); ?></td>
            </tr>
            <tr>
                <td>Current time (America/Chicago)</td>
                <td><?php echo h($today_time); ?></td>
            </tr>
            <tr>
                <td>Birthdate used</td>
                <td><?php echo h($birth_str); ?></td>
            </tr>
            <tr>
                <td>Elapsed years since birthdate</td>
                <td><?php echo h($age_years); ?></td>
            </tr>
            <tr>
                <td>Elapsed days since birthdate</td>
                <td><?php echo h($age_days); ?></td>
            </tr>
            <tr>
                <td>Semester countdown (December 15, 2026)</td>
                <td><?php echo h($countdown); ?></td>
            </tr>
        </table>
    </main>
</div>

<?php require_once __DIR__ . '/../SSP03/PHP/include_footer.php'; ?>
</body>
</html>
