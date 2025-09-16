<?php
session_start();
require 'db.php';
include 'includes/header.php';

if(!isset($_SESSION['user_id'])){
  echo "<p>Please <a href='login.php'>login</a> to view your orders.</p>";
  include 'includes/footer.php';
  exit;
}

$stmt=$pdo->prepare("SELECT * FROM orders WHERE user_id=? ORDER BY id DESC");
$stmt->execute([$_SESSION['user_id']]);
$orders=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h3>My Orders</h3>
<?php if($orders): ?>
  <table class="table table-bordered">
    <tr><th>Order ID</th><th>Total</th><th>Status</th><th>Date</th></tr>
    <?php foreach($orders as $o): ?>
      <tr>
        <td><?= $o['id'] ?></td>
        <td>$<?= number_format($o['total'],2) ?></td>
        <td><?= $o['status'] ?></td>
        <td><?= $o['created_at'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php else: ?>
  <p>No orders found.</p>
<?php endif; ?>
<?php include 'includes/footer.php'; ?>
