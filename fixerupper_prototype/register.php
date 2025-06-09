<?php
require 'db_connect.php';
session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($full_name) || empty($email) || empty($password)) {
        $errors[] = 'All fields are required.';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM customers WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $errors[] = 'Email already registered.';
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO customers (full_name, email, password_hash) VALUES (?, ?, ?)");
            $stmt->execute([$full_name, $email, $hashed_password]);

            $_SESSION['customer_id'] = $pdo->lastInsertId();
            $_SESSION['customer_name'] = $full_name;

            header("Location: confirm_order.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - FixerUpper</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: url('images/register.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .register-container {
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

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #2980b9;
            text-decoration: none;
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="register-container">
    <h1>Create an Account</h1>

    <?php foreach ($errors as $error): ?>
        <div class="error-box"><?= htmlspecialchars($error) ?></div>
    <?php endforeach; ?>

    <form method="post" action="register.php">
        <label>Full Name:</label>
        <input type="text" name="full_name" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Register</button>
    </form>

    <div class="login-link">
        Already have an account? <a href="login.php">Login here</a>.
    </div>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
