<?php
session_start();
require '../db.php';
if(!isset($_SESSION['admin'])){ header("Location: login.php"); exit; }

$orders=$pdo->query("SELECT * FROM orders ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Orders</title>
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
    .table th {
      background: #0d6efd;
      color: #fff;
    }
    .table-hover tbody tr:hover {
      background: #f1f5ff;
    }
    .badge {
      font-size: 0.9rem;
      padding: 6px 12px;
      border-radius: 8px;
    }
  </style>
</head>
<body class="container py-4">

  <!-- Header -->
  <div class="page-header">
    <h2>🛒 All Orders</h2>
    <p class="mb-0">View and manage customer orders</p>
  </div>

  <!-- Orders Table -->
  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table table-hover table-bordered mb-0">
        <thead>
          <tr>
            <th style="width: 60px;">ID</th>
            <th>User</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($orders as $o): ?>
          <tr>
            <td><?= $o['id'] ?></td>
            <td><?= $o['user_id'] ?></td>
            <td>$<?= number_format($o['total'], 2) ?></td>
            <td>
              <?php 
                $statusClass = 'secondary';
                if($o['status'] == 'Pending') $statusClass = 'warning';
                if($o['status'] == 'Completed') $statusClass = 'success';
                if($o['status'] == 'Cancelled') $statusClass = 'danger';
              ?>
              <span class="badge bg-<?= $statusClass ?>">
                <?= htmlspecialchars($o['status']) ?>
              </span>
            </td>
            <td><?= date("M d, Y H:i", strtotime($o['created_at'])) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
