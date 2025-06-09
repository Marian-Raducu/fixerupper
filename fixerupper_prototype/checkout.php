<?php
session_start();

if (empty($_SESSION['cart'])) {
    header("Location: index.php");
    exit;
}

if (empty($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit;
}

// Redirect to payment.php before confirm_order.php
header("Location: payment.php");
exit;
