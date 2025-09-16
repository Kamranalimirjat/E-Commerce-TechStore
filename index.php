<?php require 'db.php'; ?>
<?php include 'includes/header.php'; ?>

<div class="p-5 mb-4 bg-dark text-white rounded hero">
  <h1 class="display-5 fw-bold">Welcome to TechStore</h1>
  <p class="lead">Best Computer Accessories & Gadgets Online</p>
  <a href="products.php" class="btn btn-primary btn-lg">Shop Now</a>
</div>

<h3 class="mb-4">Featured Accessories</h3>
<div class="row">
  <?php
  $products = $pdo->query("SELECT * FROM products LIMIT 4")->fetchAll(PDO::FETCH_ASSOC);
  foreach($products as $p): ?>
    <div class="col-md-3 mb-4">
      <div class="card h-100 shadow-sm">
        <img src="assets/uploads/<?= $p['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($p['name']) ?>">
        <div class="card-body text-center">
          <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
          <p class="text-muted">$<?= number_format($p['price'],2) ?></p>
          <a href="product.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-primary">View</a>
          <a href="cart.php?action=add&id=<?= $p['id'] ?>" class="btn btn-sm btn-success">Add to Cart</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>
