<?php
require 'db_connect.php';
session_start();

$search_query = trim($_GET['q'] ?? '');

if ($search_query === '') {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE :name_query OR description LIKE :desc_query");
$stmt->execute([
    'name_query' => "%$search_query%",
    'desc_query' => "%$search_query%"
]);
$results = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<h1>Search Results for "<?= htmlspecialchars($search_query) ?>"</h1>

<?php if (count($results) > 0): ?>
    <div class="product-grid">
        <?php foreach ($results as $product): ?>
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
<?php else: ?>
    <p>No products found matching your search.</p>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
</body>
</html>
