<?php
require 'db.php';
include 'includes/header.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$product) {
  echo "<p>Product not found.</p>";
  include 'includes/footer.php';
  exit;
}
?>
<div class="row">
  <div class="col-md-5">
    <img src="assets/uploads/<?= $product['image'] ?>" class="img-fluid rounded shadow-sm" alt="<?= htmlspecialchars($product['name']) ?>">
  </div>
  <div class="col-md-7">
    <h2><?= htmlspecialchars($product['name']) ?></h2>
    <p class="text-muted">$<?= number_format($product['price'],2) ?></p>
    <p><?= htmlspecialchars($product['description']) ?></p>
    <a href="cart.php?action=add&id=<?= $product['id'] ?>" class="btn btn-success">Add to Cart</a>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
