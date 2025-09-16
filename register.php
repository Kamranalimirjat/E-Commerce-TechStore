<?php
session_start();
require 'db.php';
include 'includes/header.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $stmt = $pdo->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
  try {
    $stmt->execute([$name,$email,$password]);
    $userId = $pdo->lastInsertId();
    $_SESSION['user_id']=$userId;
    $_SESSION['user_name']=$name;

    // redirect back if needed
    if(isset($_SESSION['redirect'])){
      $target=$_SESSION['redirect'];
      unset($_SESSION['redirect']);
      header("Location: $target");
    } else {
      header("Location: index.php");
    }
    exit;
  } catch(PDOException $e){
    echo "<div class='alert alert-danger'>Email already exists!</div>";
  }
}
?>
<h3>Register</h3>
<form method="post">
  <div class="mb-3"><input class="form-control" name="name" placeholder="Full Name" required></div>
  <div class="mb-3"><input class="form-control" name="email" type="email" placeholder="Email" required></div>
  <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password" required></div>
  <button class="btn btn-primary">Register</button>
</form>
<?php include 'includes/footer.php'; ?>
