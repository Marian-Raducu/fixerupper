<?php
require 'db_connect.php';
session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $errors[] = "Please enter both email and password.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM customers WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['customer_id'] = $user['id'];
            $_SESSION['customer_name'] = $user['full_name'];
            header("Location: confirm_order.php");
            exit;
        } else {
            $errors[] = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - FixerUpper</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: url('images/login.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.95);
            max-width: 400px;
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

        .register-link {
            text-align: center;
            margin-top: 15px;
        }

        .register-link a {
            color: #2980b9;
            text-decoration: none;
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="login-container">
    <h1>Login</h1>

    <?php foreach ($errors as $error): ?>
        <div class="error-box"><?= htmlspecialchars($error) ?></div>
    <?php endforeach; ?>

    <form method="post" action="login.php">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <div class="register-link">
        Don't have an account? <a href="register.php">Register here</a>.
    </div>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
