<?php declare(strict_types=1);

// Create an array of fruits
$fruits = ['Apple', 'Banana', 'Orange', 'Grapes', 'Kiwi', 'Strawberry'];

// Sort the fruits alphabetically
$sortedFruits = $fruits;
sort($sortedFruits);

// Use array_map with an arrow function
$uppercaseFruits = array_map(
    fn($fruit) => strtoupper($fruit),
    $fruits
);

// Remove fruits with fewer than 6 characters
$filteredFruits = array_filter(
    $fruits,
    fn($fruit) => strlen($fruit) >= 6
);

// Product catalog
$catalog = [
    ['name' => 'Apple', 'price' => 1.50],
    ['name' => 'Banana', 'price' => 2.00],
    ['name' => 'Orange', 'price' => 2.50],
    ['name' => 'Strawberry', 'price' => 4.50]
];

$search = '';
$searchResult = '';
$searchSubmitted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $search = trim($_POST['search'] ?? '');
    $searchSubmitted = true;

    if ($search === '') {
        $searchResult = 'Please enter a fruit name.';

    } elseif (!preg_match('/^[a-zA-Z]+$/', $search)) {
        $searchResult = 'Search must contain letters only.';

    } elseif (in_array(ucfirst(strtolower($search)), $fruits, true)) {
        $searchResult = 'Fruit found in the array!';

    } else {
        $searchResult = 'Fruit was not found.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SSP07 - Arrays</title>
</head>
<body>

<h1>PHP Arrays Exercise</h1>

<h2>Original Fruit Array</h2>

<ul>
    <?php foreach ($fruits as $fruit): ?>
        <li><?= htmlspecialchars($fruit, ENT_QUOTES, 'UTF-8') ?></li>
    <?php endforeach; ?>
</ul>

<p>Total fruits: <?= count($fruits) ?></p>

<h2>Sorted Fruits</h2>

<ul>
    <?php foreach ($sortedFruits as $fruit): ?>
        <li><?= htmlspecialchars($fruit, ENT_QUOTES, 'UTF-8') ?></li>
    <?php endforeach; ?>
</ul>

<h2>Uppercase Fruits Using array_map()</h2>

<ul>
    <?php foreach ($uppercaseFruits as $fruit): ?>
        <li><?= htmlspecialchars($fruit, ENT_QUOTES, 'UTF-8') ?></li>
    <?php endforeach; ?>
</ul>

<h2>Fruits With At Least 6 Characters</h2>

<ul>
    <?php foreach ($filteredFruits as $fruit): ?>
        <li><?= htmlspecialchars($fruit, ENT_QUOTES, 'UTF-8') ?></li>
    <?php endforeach; ?>
</ul>

<h2>Product Catalog</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Product</th>
        <th>Price</th>
    </tr>

    <?php foreach ($catalog as $product): ?>
        <tr>
            <td><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></td>
            <td>$<?= number_format($product['price'], 2) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Search for a Fruit</h2>

<form method="post">
    <label for="search">Fruit name:</label>

    <input
        type="text"
        name="search"
        id="search"
        value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>"
    >

    <button type="submit">Search</button>
</form>

<?php if ($searchSubmitted): ?>
    <p><?= htmlspecialchars($searchResult, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

</body>
</html>
