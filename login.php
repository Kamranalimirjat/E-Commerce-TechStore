<?php
session_start();
require 'db.php';
include 'includes/header.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt=$pdo->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
  $stmt->execute([$email]);
  $user=$stmt->fetch(PDO::FETCH_ASSOC);

  if($user && password_verify($password,$user['password'])){
    $_SESSION['user_id']=$user['id'];
    $_SESSION['user_name']=$user['name'];

    // redirect back to intended page
    if(isset($_SESSION['redirect'])){
      $target=$_SESSION['redirect'];
      unset($_SESSION['redirect']);
      header("Location: $target");
    } else {
      header("Location: index.php");
    }
    exit;
  } else {
    echo "<div class='alert alert-danger'>Invalid credentials</div>";
  }
}
?>
<h3>Login</h3>
<form method="post">
  <div class="mb-3"><input class="form-control" name="email" type="email" placeholder="Email" required></div>
  <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password" required></div>
  <button class="btn btn-success">Login</button>
</form>
<p class="mt-2">No account? <a href="register.php">Register</a></p>
<?php include 'includes/footer.php'; ?>
