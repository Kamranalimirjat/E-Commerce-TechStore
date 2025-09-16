<?php  
session_start();
require '../db.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
  $username=$_POST['username'];
  $password=$_POST['password'];

  if($username=='admin' && $password=='admin123'){ 
    $_SESSION['admin']=true;
    header("Location: dashboard.php");
    exit;
  } else {
    $error="Invalid login credentials";
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, #0d6efd, #6c63ff);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .login-card {
      background: #fff;
      padding: 40px 30px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }
    .login-card h3 {
      margin-bottom: 25px;
      color: #0d6efd;
    }
    .form-control:focus {
      box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    .btn-primary {
      width: 100%;
      padding: 10px;
      font-size: 1.1rem;
      border-radius: 10px;
    }
    .go-site {
      margin-top: 15px;
      display: block;
      font-size: 0.95rem;
    }
  </style>
</head>
<body>

<div class="login-card">
  <h3>🔑 Admin Login</h3>
  <?php if(isset($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  <form method="post">
    <div class="mb-3">
      <input class="form-control" name="username" placeholder="Username" required>
    </div>
    <div class="mb-3">
      <input class="form-control" type="password" name="password" placeholder="Password" required>
    </div>
    <button class="btn btn-primary" type="submit">Login</button>
  </form>

  <!-- ✅ Added Link -->
  <a href="../index.php" class="go-site text-decoration-none text-primary">
    🌐 Go to Website
  </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
