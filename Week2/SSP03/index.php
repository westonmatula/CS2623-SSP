<?php
declare(strict_types=1);

require_once __DIR__ . '/PHP/functions_ssp03.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Planner</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<?php
require_once __DIR__ . '/PHP/include_header.php';
require_once __DIR__ . '/PHP/Include_topNav.php';
?>

<div id="page-wrapper">
    <?php require_once __DIR__ . '/PHP/include_leftNav.php'; ?>

    <main>
        <?php
        $tz = new DateTimeZone('America/Chicago');
        $now = new DateTime('now', $tz);
        $current_day = (int) $now->format('N');

        fn_tableOpen('Weekly Planner');

        for ($day_number = 1; $day_number <= 7; $day_number++) {
            $day = fn_dayOfWeek($day_number);
            $details = fn_dayDetails($day_number);
            $time = fn_dayTime($day_number);

            if ($day_number === $current_day) {
                fn_tableRowCurrent($day, $details, $time);
            } else {
                fn_tableRow($day, $details, $time);
            }
        }

        fn_tableClose();
        ?>
    </main>
</div>

<?php require_once __DIR__ . '/PHP/include_footer.php'; ?>
</body>
</html>
