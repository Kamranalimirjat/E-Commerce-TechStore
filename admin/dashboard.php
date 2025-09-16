<?php
session_start();
require '../db.php';
if(!isset($_SESSION['admin'])){ header("Location: login.php"); exit; }

$msg=$pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$products=$pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    body {
      background: #f4f6f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .dashboard-header {
      background: #0da5fdff;
      color: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      margin-bottom: 30px;
    }
    .stat-card {
      background: #fff;
      border-radius: 15px;
      padding: 25px;
      text-align: center;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
      transition: all 0.3s ease-in-out;
    }
    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }
    .stat-card h4 {
      font-size: 2rem;
      color: #0d6efd;
      margin-bottom: 10px;
    }
    .dashboard-links a {
      margin-right: 10px;
    }
  </style>
</head>
<body class="container py-4">

  <!-- Header -->
  <div class="dashboard-header text-center">
    <h2>Admin Dashboard</h2>
    <p class="mb-0">Welcome, Admin! Manage your store efficiently.</p>
  </div>

  <!-- Stats Section -->
  <div class="row mb-4">
    <div class="col-md-6 mb-3">
      <div class="stat-card">
        <h4><?= $msg ?></h4>
        <p>Total Orders</p>
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="stat-card">
        <h4><?= $products ?></h4>
        <p>Total Products</p>
      </div>
    </div>
  </div>

  <!-- Links Section -->
  <div class="dashboard-links text-center">
    <a href="products.php" class="btn btn-primary btn-lg">📦 Manage Products</a>
    <a href="orders.php" class="btn btn-success btn-lg">🛒 Manage Orders</a>
    <a href="logout.php" class="btn btn-danger btn-lg">🚪 Logout</a>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
