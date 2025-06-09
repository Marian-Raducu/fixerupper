<?php
require 'db_connect.php';
session_start();

$stmt = $pdo->query("SELECT * FROM products LIMIT 20");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>FixerUpper Store</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: url('images/home.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .content-wrapper {
            background: rgba(255, 255, 255, 0.95); /* Soft white background for content */
            padding: 20px;
            border-radius: 10px;
            max-width: 1200px;
            margin: auto;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }

        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
        }

        form[action="search.php"] {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="content-wrapper">
        <?php if (!empty($_SESSION['customer_name'])): ?>
            <div style="background: #e0f7fa; padding: 10px 20px; margin-bottom: 20px; border-left: 5px solidrgb(38, 0, 121);">
                <strong>Welcome back, <?= htmlspecialchars($_SESSION['customer_name']) ?>!</strong>
            </div>
        <?php endif; ?>

        <h1>Our Products</h1>
        <form method="GET" action="search.php">
            <input type="text" name="q" placeholder="Search for products..." required>
            <button type="submit">Search</button>
        </form>

        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <h2><?= htmlspecialchars($product['name']) ?></h2>
                    <p>£<?= number_format($product['price'], 2) ?></p>
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="number" name="quantity" value="1" min="1">
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <footer class="footer">
  <div class="footer-container">
    <div class="footer-column">
      <h3>Contact Us</h3>
      <ul class="contact-info">
        <li>📍 210 Kimberley Rd, Newcastle</li>
        <li>📞 0116 273 4411</li>
        <li>✉️ info@fixerupper.com</li>
      </ul>
    </div>

    <div class="footer-column">
      <h3>Follow Us</h3>
      <div class="social-icons">
        <a href="https://facebook.com" target="_blank" aria-label="Facebook">
        <img src="images/Facebook.jpg" alt="Facebook" width="50" height="50">
        </a>
        <a href="https://instagram.com" target="_blank" aria-label="Instagram">
        <img src="images/Instagram.jpg" alt="Instagram" width="50" height="50">
        </a>
        <a href="https://youtube.com" target="_blank" aria-label="YouTube">
        <img src="images/YouTube.jpg" alt="YouTube" width="50" height="50">
        </a>
      </div>
    </div>

    <div class="footer-column">
      <h3>Quick Links</h3>
      <ul class="quick-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>
  </div>
</footer>

</body>
</html>
