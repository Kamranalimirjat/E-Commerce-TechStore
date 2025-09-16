<?php 
session_start();
require '../db.php';
if(!isset($_SESSION['admin'])){ header("Location: login.php"); exit; }

if($_SERVER['REQUEST_METHOD']=='POST'){
  $name=$_POST['name'];
  $price=$_POST['price'];
  $cat=$_POST['category'];
  $desc=$_POST['description'];
  $img=$_FILES['image']['name'];
  if($img){
    move_uploaded_file($_FILES['image']['tmp_name'],"../assets/uploads/".$img);
  }
  $stmt=$pdo->prepare("INSERT INTO products (name,price,category,description,image,stock) VALUES (?,?,?,?,?,10)");
  $stmt->execute([$name,$price,$cat,$desc,$img]);
}

$products=$pdo->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Products</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f4f6f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .page-header {
      background: #0d6efd;
      color: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      margin-bottom: 30px;
      text-align: center;
    }
    .form-card {
      background: #fff;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
      margin-bottom: 30px;
    }
    .table th {
      background: #0d6efd;
      color: #fff;
    }
    .table-hover tbody tr:hover {
      background: #f1f5ff;
    }
  </style>
</head>
<body class="container py-4">

  <!-- Header -->
  <div class="page-header">
    <h2>📦 Manage Products</h2>
    <p class="mb-0">Add, view, and delete products from your store.</p>
  </div>

  <!-- Add Product Form -->
  <div class="form-card">
    <h4 class="mb-3">➕ Add New Product</h4>
    <form method="post" enctype="multipart/form-data">
      <div class="row g-3">
        <div class="col-md-6">
          <input class="form-control" name="name" placeholder="Product Name" required>
        </div>
        <div class="col-md-3">
          <input type="number" step="0.01" class="form-control" name="price" placeholder="Price ($)" required>
        </div>
        <div class="col-md-3">
          <input class="form-control" name="category" placeholder="Category" required>
        </div>
      </div>
      <div class="row g-3 mt-2">
        <div class="col-md-8">
          <textarea class="form-control" name="description" placeholder="Description"></textarea>
        </div>
        <div class="col-md-4">
          <input class="form-control" type="file" name="image">
        </div>
      </div>
      <div class="mt-3 text-end">
        <button class="btn btn-success btn-lg">✅ Add Product</button>
      </div>
    </form>
  </div>

  <!-- Product List -->
  <div class="card shadow-sm">
    <div class="card-header bg-light">
      <h5 class="mb-0">📋 Product List</h5>
    </div>
    <div class="card-body p-0">
      <table class="table table-hover table-bordered mb-0">
        <thead>
          <tr>
            <th style="width: 50px;">ID</th>
            <th>Name</th>
            <th style="width: 100px;">Price</th>
            <th style="width: 150px;">Category</th>
            <th style="width: 100px;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($products as $p): ?>
          <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td>$<?= $p['price'] ?></td>
            <td><?= $p['category'] ?></td>
            <td>
              <a href="delete.php?id=<?= $p['id'] ?>" 
                 class="btn btn-sm btn-danger"
                 onclick="return confirm('Are you sure you want to delete this product?')">
                 🗑 Delete
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
