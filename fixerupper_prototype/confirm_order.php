<?php
require 'db_connect.php';
session_start();

if (empty($_SESSION['customer_id']) || empty($_SESSION['cart']) || empty($_SESSION['bank_details'])) {
    header("Location: index.php");
    exit;
}

$customer_id = $_SESSION['customer_id'];
$cart = $_SESSION['cart'];
$bank_details = $_SESSION['bank_details'];

$stmt = $pdo->prepare("INSERT INTO orders (customer_id) VALUES (?)");
$stmt->execute([$customer_id]);
$order_id = $pdo->lastInsertId();

$stmt_item = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");

foreach ($cart as $item) {
    $stmt_item->execute([
        $order_id,
        $item['id'],
        $item['quantity']
    ]);
}

unset($_SESSION['cart']);
unset($_SESSION['bank_details']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmed</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: url('images/confirm.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .confirmation-box {
            background-color: rgba(255, 255, 255, 0.95);
            max-width: 600px;
            margin: 60px auto;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
        }

        h1, h2 {
            color: #2c3e50;
        }

        ul {
            list-style-type: none;
            padding: 0;
            text-align: left;
        }

        ul li {
            padding: 8px 0;
            font-size: 16px;
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

        button {
            background-color: #2ecc71;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            margin-top: 20px;
            cursor: pointer;
        }

        button:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="confirmation-box">
    <h1>Thank you, <?= htmlspecialchars($_SESSION['customer_name']) ?>!</h1>
    <p>Your order has been successfully placed.</p>
    <p>Your Order Number is: <strong>#<?= $order_id ?></strong></p>

    <h2>Bank Details (for demo purposes only)</h2>
    <ul>
        <li><strong>Account Name:</strong> <?= htmlspecialchars($bank_details['account_name']) ?></li>
        <li><strong>Sort Code:</strong> <?= htmlspecialchars($bank_details['sort_code']) ?></li>
        <li><strong>Account Number:</strong> <?= htmlspecialchars($bank_details['account_number']) ?></li>
    </ul>

    <a href="index.php"><button>Continue Shopping</button></a>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
