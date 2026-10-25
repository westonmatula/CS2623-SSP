<?php
declare(strict_types=1);

$description = 'The PHP programing course teaches students how to use PHP to create dynamic web pages and web applications. It covers topics such as variables, data types, control structures, functions, arrays, and object-oriented programming. Students will also learn how to work with databases and use PHP to interact with them. By the end of the course, students will have a solid understanding of PHP and be able to create their own web applications.';
$replaced = str_replace('PHP', 'server-side', $description);
$contains_php = str_contains($description, 'PHP');
$lowercase = strtolower($description);
$uppercase = strtoupper($description);
$character_count = strlen($description);
$price = sprintf('$%.2f',9.9);
$large_number = number_format(1000000);
$short_description = substr($description, 0, 30);

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
        <title>SSP04 Exercise 1 - String Functions</title>
        <link rel="stylesheet" href="../SSP03/main.css">
    </head>
    <body>
<?php require_once __DIR__ . '/../SSP03/PHP/include_header.php'; ?>
<?php require_once __DIR__ . '/../SSP03/PHP/Include_topNav.php'; ?>

<div id="page-wrapper">
    <?php require_once __DIR__ . '/../SSP03/PHP/include_leftNav.php'; ?>

    <main>
        <h2>PHP String Function Demonstrations</h2>

        <table id="weekly-planner" border="1" cellpadding="6" cellspacing="0">
            <tr>
                <th>Function</th>
                <th>Input</th>
                <th>Output</th>
            </tr>
            <tr>
                <td>str_replace()</td>
                <td><?php echo h($description); ?></td>
                <td><?php echo h($replaced); ?></td>
            </tr>
            <tr>
                <td>str_contains()</td>
                <td>Does the description contain PHP?</td>
                <td><?php echo h((string) $contains_php); ?></td>
            </tr>
            <tr>
                <td>strtolower()</td>
                <td><?php echo h($description); ?></td>
                <td><?php echo h($lowercase); ?></td>
            </tr>
            <tr>
                <td>strtoupper()</td>
                <td><?php echo h($description); ?></td>
                <td><?php echo h($uppercase); ?></td>
            </tr>
            <tr>
                <td>strlen()</td>
                <td><?php echo h($description); ?></td>
                <td><?php echo h((string) $character_count); ?></td>
            </tr>
            <tr>
                <td>sprintf()</td>
                <td>9.9</td>
                <td><?php echo h($price); ?></td>
            </tr>
            <tr>
                <td>number_format()</td>
                <td>1000000</td>
                <td><?php echo h($large_number); ?></td>
            </tr>
            <tr>
                <td>substr()</td>
                <td><?php echo h($description); ?></td>
                <td><?php echo h($short_description); ?></td>
            </tr>
        </table>
    </main>
</div>

<?php require_once __DIR__ . '/../SSP03/PHP/include_footer.php'; ?>
</body>
</html>