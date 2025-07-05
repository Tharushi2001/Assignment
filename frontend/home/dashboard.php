<?php
require_once "../../backend/config/database.php";
require_once "../header.php";
// Fetch counts
$totalCustomers = $conn->query("SELECT COUNT(*) as count FROM customer")->fetch_assoc()['count'];
$totalItems = $conn->query("SELECT COUNT(*) as count FROM item")->fetch_assoc()['count'];
$totalInvoices = $conn->query("SELECT COUNT(DISTINCT invoice_no) as count FROM invoice")->fetch_assoc()['count'];

// Fetch recent customers
$recentCustomers = $conn->query("SELECT id, first_name, last_name, contact_no FROM customer ORDER BY id DESC LIMIT 5");
?>

<!-- Inside the body (AFTER header.php) -->
<div class="container mt-5 ">
  <h2 class="text-center mb-4">ERP Dashboard</h2>

  <!-- Summary Cards -->
  <div class="row text-white mb-4">
    <div class="col-md-4">
      <div class="card bg-primary">
        <div class="card-body">
          <h5>Total Customers</h5>
          <p class="fs-4"><?= $totalCustomers ?></p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-success">
        <div class="card-body">
          <h5>Total Items</h5>
          <p class="fs-4"><?= $totalItems ?></p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-warning">
        <div class="card-body">
          <h5>Total Invoices</h5>
          <p class="fs-4"><?= $totalInvoices ?></p>
        </div>
      </div>
    </div>
  </div>

 
