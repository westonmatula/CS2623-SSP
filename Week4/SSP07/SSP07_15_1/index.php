<?php declare(strict_types=1);

// Base validation exception
class ValidationException extends Exception {
}

// Custom format exception
class FormatException extends ValidationException {
}

$results = [];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {

        $email = trim($_POST['email'] ?? '');
        $url = trim($_POST['url'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $zip = trim($_POST['zip'] ?? '');
        $productCode = trim($_POST['product_code'] ?? '');
        $quantity = trim($_POST['quantity'] ?? '');
        $message = trim($_POST['message'] ?? '');

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException('Invalid email address.');
        }

        // Validate URL
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new ValidationException('Invalid URL.');
        }

        // Validate phone number
        if (!preg_match('/^\d{3}-\d{3}-\d{4}$/', $phone)) {
            throw new FormatException('Phone must use the format 123-456-7890.');
        }

        // Validate ZIP code
        if (!preg_match('/^\d{5}(-\d{4})?$/', $zip)) {
            throw new FormatException('ZIP code must use 12345 or 12345-6789.');
        }

        // Validate product code
        if (!preg_match('/^[A-Z]{2}\d{4}$/', $productCode)) {
            throw new FormatException('Product code must use two uppercase letters followed by four numbers.');
        }

        // Validate integer quantity
        $validQuantity = filter_var($quantity, FILTER_VALIDATE_INT);

        if ($validQuantity === false || $validQuantity < 1) {
            throw new ValidationException('Quantity must be a positive whole number.');
        }

        $results = [
            'Email' => $email,
            'URL' => $url,
            'Phone' => $phone,
            'ZIP Code' => $zip,
            'Product Code' => $productCode,
            'Quantity' => (string)$validQuantity,
            'Message' => $message
        ];

    } catch (FormatException $e) {

        $error = $e->getMessage();

    } catch (ValidationException $e) {

        $error = $e->getMessage();

    } catch (Exception $e) {

        $error = 'An unexpected error occurred.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SSP07 - Validation</title>
</head>
<body>

<h1>Regular Expressions and Exceptions</h1>

<?php if ($error !== ''): ?>
    <p>
        <strong>Error:</strong>
        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
    </p>
<?php endif; ?>

<form method="post">

    <p>
        <label>Email:</label>
        <input type="text" name="email" required>
    </p>

    <p>
        <label>Website URL:</label>
        <input type="text" name="url" required>
    </p>

    <p>
        <label>Phone (123-456-7890):</label>
        <input type="text" name="phone" required>
    </p>

    <p>
        <label>ZIP Code (12345):</label>
        <input type="text" name="zip" required>
    </p>

    <p>
        <label>Product Code (AB1234):</label>
        <input type="text" name="product_code" required>
    </p>

    <p>
        <label>Quantity:</label>
        <input type="number" name="quantity" min="1" required>
    </p>

    <p>
        <label>Message:</label><br>
        <textarea name="message" rows="5" cols="40"></textarea>
    </p>

    <button type="submit">Submit</button>

</form>

<?php if (!empty($results)): ?>

    <h2>Validated Information</h2>

    <?php foreach ($results as $label => $value): ?>
        <p>
            <strong><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>:</strong>
            <?= nl2br(htmlspecialchars($value, ENT_QUOTES, 'UTF-8')) ?>
        </p>
    <?php endforeach; ?>

<?php endif; ?>

</body>
</html>
