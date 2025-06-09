<?php
session_start();

if (empty($_SESSION['customer_id']) || empty($_SESSION['cart'])) {
    header("Location: index.php");
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $account_name = trim($_POST['account_name']);
    $sort_code = trim($_POST['sort_code']);
    $account_number = trim($_POST['account_number']);

    if (empty($account_name) || empty($sort_code) || empty($account_number)) {
        $errors[] = "All bank details are required.";
    } else {
        $_SESSION['bank_details'] = [
            'account_name' => $account_name,
            'sort_code' => $sort_code,
            'account_number' => $account_number
        ];
        header("Location: confirm_order.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enter Bank Details - FixerUpper</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: url('images/payment.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .payment-container {
            background-color: rgba(255, 255, 255, 0.95);
            max-width: 500px;
            margin: 60px auto;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
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

        button {
            margin-top: 20px;
            background-color: #2ecc71;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #27ae60;
        }

        .error-box {
            background-color: #ffe6e6;
            border: 1px solid #ff4d4d;
            color: #cc0000;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="payment-container">
    <h1>Enter Bank Details</h1>

    <?php foreach ($errors as $error): ?>
        <div class="error-box"><?= htmlspecialchars($error) ?></div>
    <?php endforeach; ?>

    <form method="post" action="payment.php">
        <label>Account Name:</label>
        <input type="text" name="account_name" required>

        <label>Sort Code:</label>
        <input type="text" name="sort_code" required>

        <label>Account Number:</label>
        <input type="text" name="account_number" required>

        <button type="submit">Continue to Confirm Order</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
