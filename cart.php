<?php
session_start();
require 'db.php';
include 'includes/header.php';

if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

// Add item
if(isset($_GET['action']) && $_GET['action']=='add' && isset($_GET['id'])){
  $id = (int)$_GET['id'];
  if(isset($_SESSION['cart'][$id])){
    $_SESSION['cart'][$id]++;
  } else {
    $_SESSION['cart'][$id]=1;
  }
  header("Location: cart.php");
  exit;
}

// Update quantity
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['update_cart'])){
  foreach($_POST['qty'] as $id=>$qty){
    if($qty <= 0){
      unset($_SESSION['cart'][$id]);
    } else {
      $_SESSION['cart'][$id] = (int)$qty;
    }
  }
  header("Location: cart.php");
  exit;
}

// Remove item
if(isset($_GET['action']) && $_GET['action']=='remove' && isset($_GET['id'])){
  $id = (int)$_GET['id'];
  unset($_SESSION['cart'][$id]);
  header("Location: cart.php");
  exit;
}

$total = 0;
?>
<h3 class="mb-4">🛒 Shopping Cart</h3>
<?php if($_SESSION['cart']): ?>
<form method="post">
<table class="table table-bordered align-middle text-center">
  <tr class="table-dark">
    <th>Image</th>
    <th>Product</th>
    <th>Qty</th>
    <th>Price</th>
    <th>Total</th>
    <th></th>
  </tr>
  <?php
  foreach($_SESSION['cart'] as $id=>$qty):
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
    $stmt->execute([$id]);
    $p = $stmt->fetch(PDO::FETCH_ASSOC);
    $lineTotal = $p['price'] * $qty;
    $total += $lineTotal;
  ?>
  <tr>
    <td><img src="assets/uploads/<?= $p['image'] ?>" width="60" class="rounded"></td>
    <td><?= htmlspecialchars($p['name']) ?></td>
    <td><input type="number" name="qty[<?= $id ?>]" value="<?= $qty ?>" min="1" class="form-control w-50 mx-auto"></td>
    <td>$<?= number_format($p['price'],2) ?></td>
    <td>$<?= number_format($lineTotal,2) ?></td>
    <td><a href="cart.php?action=remove&id=<?= $id ?>" class="btn btn-sm btn-danger">Remove</a></td>
  </tr>
  <?php endforeach; ?>
  <tr class="table-secondary">
    <td colspan="4" class="text-end"><strong>Grand Total</strong></td>
    <td colspan="2"><strong>$<?= number_format($total,2) ?></strong></td>
  </tr>
</table>
<div class="d-flex justify-content-between">
  <a href="products.php" class="btn btn-outline-secondary">← Continue Shopping</a>
  <div>
    <button type="submit" name="update_cart" class="btn btn-warning">Update Cart</button>
    <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
  </div>
</div>
</form>
<?php else: ?>
<div class="alert alert-info">Your cart is empty. <a href="products.php">Shop Now</a></div>
<?php endif; ?>
<?php include 'includes/footer.php'; ?>
