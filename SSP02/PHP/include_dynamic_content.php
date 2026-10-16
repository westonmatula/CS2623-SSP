
<?php
/*
 * include_dynamic_content.php - CS2623 SSP02
 * CS2623 SSP02 - Week One - Dynamic Content
 */
?>

<!-- Weekly Planner Table -->
<table id="weekly-planner">
    <caption>CS2623 Weekly Planner — Weston Matula</caption>
    <thead>
        <tr>
            <th scope="col">Day of Week</th>
            <th scope="col">Task</th>
            <th scope="col">Time (hrs.)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Loop through the seven days of the week
        for ($counter = 1; $counter < 8; $counter++) {
            // Calculate study hours and format to one decimal place
            $hours = number_format($counter / 2, 1);

            // Output each row
            echo "<tr>";
            echo "<td>" . htmlspecialchars((string) $counter, ENT_QUOTES, "UTF-8") . "</td>";
            echo "<td>Study for CS2623</td>";
            echo "<td>" . htmlspecialchars($hours, ENT_QUOTES, "UTF-8") . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
