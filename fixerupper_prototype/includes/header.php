<nav>
    <a href="index.php">Home</a> |
    <a href="cart.php">Cart</a> |
    <a href="about.php">About</a> |
    <a href="contact.php">Contact</a> |
    <?php if (!empty($_SESSION['customer_id'])): ?>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a> |
        <a href="register.php">Register</a>
    <?php endif; ?>
</nav>
<hr>
