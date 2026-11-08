<?php declare(strict_types=1);

// Require login before accessing the shopping cart
require '../SSP06_21_2/auth.php';

// Product catalog
$products = [
    1 => ['id' => 1, 'name' => 'Fender Stratocaster', 'price' => 499.99],
    2 => ['id' => 2, 'name' => 'Gibson Les Paul', 'price' => 799.99],
    3 => ['id' => 3, 'name' => 'Martin D-28 Acoustic', 'price' => 1299.99],
    4 => ['id' => 4, 'name' => 'Ibanez RG550', 'price' => 299.99]
];

// Initialize shopping cart
$_SESSION['cart'] ??= [];

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $action = $_POST['action'] ?? '';

    if ($id !== null && $id !== false && isset($products[$id])) {

        if ($action === 'add') {

            // Add one item to cart
            $_SESSION['cart'][$id] =
                ($_SESSION['cart'][$id] ?? 0) + 1;

        } elseif ($action === 'remove') {

            // Remove one item from cart
            if (isset($_SESSION['cart'][$id])) {

                $_SESSION['cart'][$id]--;

                if ($_SESSION['cart'][$id] <= 0) {
                    unset($_SESSION['cart'][$id]);
                }
            }
        }
    }

    // Redirect after POST
    header('Location: index.php');
    exit;
}

// Calculate cart totals
$total = 0.0;
$itemCount = 0;

foreach ($_SESSION['cart'] as $pid => $qty) {

    if (isset($products[$pid])) {

        $total += $products[$pid]['price'] * $qty;
        $itemCount += $qty;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Catalog</title>
</head>
<body>

<h1>Guitar Shop</h1>

<h2>
    Cart (<?= $itemCount ?> items)
</h2>

<p>
    Logged in as:
    <?= htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8') ?>
</p>

<a href="../SSP06_21_2/dashboard.php">Dashboard</a> |
<a href="../SSP06_21_2/logout.php">Log Out</a>

<hr>

<h2>Product Catalog</h2>

<?php foreach ($products as $p): ?>

    <div>

        <h3>
            <?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?>
        </h3>

        <p>
            Price: $<?= number_format($p['price'], 2) ?>
        </p>

        <form method="post">

            <input
                type="hidden"
                name="product_id"
                value="<?= (int)$p['id'] ?>"
            >

            <input type="hidden" name="action" value="add">

            <button type="submit">Add to Cart</button>

        </form>

    </div>

    <hr>

<?php endforeach; ?>


<h2>Your Shopping Cart</h2>

<?php if (empty($_SESSION['cart'])): ?>

    <p>Your cart is empty.</p>

<?php else: ?>

    <table border="1" cellpadding="8">

        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
        </tr>

        <?php foreach ($_SESSION['cart'] as $pid => $qty): ?>

            <?php if (isset($products[$pid])): ?>

                <tr>

                    <td>
                        <?= htmlspecialchars(
                            $products[$pid]['name'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </td>

                    <td><?= (int)$qty ?></td>

                    <td>
                        $<?= number_format(
                            $products[$pid]['price'] * $qty,
                            2
                        ) ?>
                    </td>

                    <td>

                        <form method="post">

                            <input
                                type="hidden"
                                name="product_id"
                                value="<?= (int)$pid ?>"
                            >

                            <input
                                type="hidden"
                                name="action"
                                value="remove"
                            >

                            <button type="submit">Remove One</button>

                        </form>

                    </td>

                </tr>

            <?php endif; ?>

        <?php endforeach; ?>

        <tr>
            <td colspan="2"><strong>Grand Total</strong></td>

            <td colspan="2">
                <strong>$<?= number_format($total, 2) ?></strong>
            </td>
        </tr>

    </table>

<?php endif; ?>

<br>

<a href="cart_clear.php">Clear Cart</a>

</body>
</html>
