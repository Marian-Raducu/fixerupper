<?php
session_start();
$cart = $_SESSION['cart'] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        foreach ($_POST['quantities'] as $id => $qty) {
            $_SESSION['cart'][$id]['quantity'] = max(1, (int)$qty);
        }
    } elseif (isset($_POST['remove'])) {
        $remove_id = $_POST['remove'];
        unset($_SESSION['cart'][$remove_id]);
    }
    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: url('images/cart.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .cart-wrapper {
            background-color: rgba(255, 255, 255, 0.95);
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            border-radius: 10px;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .cart-table th, .cart-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: center;
        }

        .cart-table img {
            width: 80px;
            height: auto;
            border-radius: 5px;
        }
        footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: transparent;
    text-align: bottom ;
    padding: 10px 0;
    border-top: 1px none #ddd;
    font-size: 14px;
}

        .actions button {
            padding: 6px 12px;
            margin: 2px;
            border: none;
            cursor: pointer;
            background-color: #3498db;
            color: white;
            border-radius: 4px;
        }

        .actions button:hover {
            background-color: #2980b9;
        }

        .total {
            text-align: right;
            margin-top: 20px;
        }

        .checkout-btn {
            background-color: #2ecc71;
        }
    </style>
    <script>
        function updateSubtotal(id, price) {
            const qty = document.getElementById('qty-' + id).value;
            const subtotal = (qty * price).toFixed(2);
            document.getElementById('subtotal-' + id).innerText = '£' + subtotal;
            updateTotal();
        }

        function updateTotal() {
            let total = 0;
            document.querySelectorAll('[data-subtotal]').forEach(el => {
                total += parseFloat(el.innerText.replace('£', '')) || 0;
            });
            document.getElementById('total').innerText = '£' + total.toFixed(2);
        }

        window.onload = updateTotal;
    </script>
</head>
<body>
<?php include 'includes/header.php'; ?>

<div class="cart-wrapper">
    <h1>Your Shopping Cart</h1>

    <?php if (empty($cart)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <form method="POST">
            <table class="cart-table">
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($cart as $item): 
                    $subtotal = $item['price'] * $item['quantity'];
                ?>
                <tr>
                    <td>
                        <img src="images/<?= htmlspecialchars($item['image'] ?? 'placeholder.jpg') ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                    </td>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td>£<?= number_format($item['price'], 2) ?></td>
                    <td>
                        <input type="number" name="quantities[<?= $item['id'] ?>]" value="<?= $item['quantity'] ?>" min="1" 
                               id="qty-<?= $item['id'] ?>" onchange="updateSubtotal(<?= $item['id'] ?>, <?= $item['price'] ?>)">
                    </td>
                    <td data-subtotal id="subtotal-<?= $item['id'] ?>">£<?= number_format($subtotal, 2) ?></td>
                    <td class="actions">
                        <button type="submit" name="remove" value="<?= $item['id'] ?>">Remove</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>

            <div class="total">
                <strong>Total: <span id="total">£0.00</span></strong>
            </div>

            <div class="actions" style="text-align: right;">
                <button type="submit" name="update">Update Cart</button>
                <a href="checkout.php"><button type="button" class="checkout-btn">Proceed to Checkout</button></a>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
