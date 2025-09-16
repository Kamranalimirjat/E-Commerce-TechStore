<?php
session_start();
require 'db.php';

// ✅ PHPMailer imports must be at the top
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'includes/header.php';

if(!isset($_SESSION['user_id'])) {
  $_SESSION['redirect'] = "checkout.php";
  header("Location: login.php");
  exit;
}

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
  echo "<p>Your cart is empty.</p>";
  include 'includes/footer.php';
  exit;
}

if($_SERVER['REQUEST_METHOD']=='POST'){
  $userId = $_SESSION['user_id'];

  // User info
  $stmt=$pdo->prepare("SELECT * FROM users WHERE id=?");
  $stmt->execute([$userId]);
  $user=$stmt->fetch(PDO::FETCH_ASSOC);

  $total=0;
  foreach($_SESSION['cart'] as $id=>$qty){
    $stmt=$pdo->prepare("SELECT * FROM products WHERE id=?");
    $stmt->execute([$id]);
    $p=$stmt->fetch(PDO::FETCH_ASSOC);
    $total += $p['price']*$qty;
  }

  $stmt=$pdo->prepare("INSERT INTO orders (user_id,total) VALUES (?,?)");
  $stmt->execute([$userId,$total]);
  $orderId=$pdo->lastInsertId();

  foreach($_SESSION['cart'] as $id=>$qty){
    $stmt=$pdo->prepare("SELECT * FROM products WHERE id=?");
    $stmt->execute([$id]);
    $p=$stmt->fetch(PDO::FETCH_ASSOC);
    $stmt=$pdo->prepare("INSERT INTO order_items (order_id,product_id,quantity,price) VALUES (?,?,?,?)");
    $stmt->execute([$orderId,$id,$qty,$p['price']]);
  }

  // Clear cart
  $_SESSION['cart']=[];

  // ✅ Send confirmation email
  $mail = new PHPMailer(true);
  try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'yourgmail@gmail.com';   // 👉 apna Gmail
    $mail->Password   = 'your-app-password';     // 👉 Gmail App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('yourgmail@gmail.com', 'TechStore');
    $mail->addAddress($user['email'], $user['name']);

    $mail->isHTML(true);
    $mail->Subject = "Order Confirmation - TechStore (Order #$orderId)";
    $mail->Body    = "
      <h2>Thank you for your order, {$user['name']}!</h2>
      <p>Your order <strong>#$orderId</strong> has been placed successfully.</p>
      <p>Total: <strong>\${$total}</strong></p>
      <p>We will notify you when your order is shipped.</p>
      <br>
      <p>Best Regards,<br>TechStore Team</p>
    ";

    $mail->send();
    echo "<div class='alert alert-success'>Order placed successfully! Confirmation email sent to {$user['email']}.</div>";
  } catch (Exception $e) {
    echo "<div class='alert alert-warning'>Order placed but email could not be sent. Error: {$mail->ErrorInfo}</div>";
  }
}
?>

<h3>Checkout</h3>
<form method="post">
  <p>Logged in as <strong><?= $_SESSION['user_name'] ?></strong></p>
  <button class="btn btn-success">Confirm Order</button>
</form>
<?php include 'includes/footer.php'; ?>
