* Opens the weekly planner table and dispays its caption and headings.
* @param string $caption The title displayed above the table.
* @return void
*/
function fn_tableOpen(string $caption): void
{
    echo '<table border="1" cellpadding="5" cellspacing="0">';

    echo '<tr style="background-color: #1B2A6B; color: #FFFFFF;">';
    echo '<th colspan="3">';
    echo htmlspecialchars($caption, ENT_QUOTES, 'UTF-8');
    echo '</th>';
    echo '</tr>';

    echo '<tr style="background-color: #006B7D; color: #FFFFFF;">';
    echo '<th>Day</th>';
    echo '<th>Details</th>';
    echo '<th>Time</th>';
    echo '</tr>';
}

//**
* Closes the weekly planner table.
* @return void
*/
function fn_tableClose(): void
{
    echo '</table>';
}