<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$action = $_GET['action'] ?? '';

if ($action === 'clear') {
    unset($_SESSION['cart']);
    header('Location: session_cart.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = $_POST['product'] ?? '';
    if ($product) {
        $_SESSION['cart'][] = $product;
    }
    header('Location: session_cart.php'); // Refresh to show updates
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Shop</title></head>
<body>
    <form method="post">
        Add Product: <input type="text" name="product">
        <button type="submit">Add to Cart</button>
    </form>
    <h2>Cart Items:</h2>
    <ul>
        <?php foreach ($_SESSION['cart'] ?? [] as $item): ?>
            <li><?php echo htmlspecialchars($item); ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="session_cart.php?action=clear">Clear Cart</a>
</body>
</html>
