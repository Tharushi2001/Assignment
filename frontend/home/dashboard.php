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

<!-- Banner Image Section with Gradient Overlay and Welcome Text -->
<section class="banner-section mb-4 position-relative w-100" style="height: 300px; overflow: hidden;">
  <!-- Banner Image -->
  <img src="../assets/images/dash.jpg" alt="Dashboard Banner" class="w-100 h-100" style="object-fit: cover;" />

  <!-- Gradient Overlay -->
  <div class="position-absolute top-0 start-0 w-100 h-100" 
       style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.9)); z-index: 1;">
  </div>

  <!-- Welcome Text -->
  <div class="position-absolute top-50 start-50 translate-middle text-white text-center" style="z-index: 2;">
    <h1 class="display-6 fw-bold">Hi Admin!</h1>
    <h4><b>Welcome to our ERP SYSTEM</b></h4>
  </div>
</section>



<div class="container mt-5 ">



  <h2 class="text-center mb-4">ERP Dashboard</h2>



  <!-- Summary Cards -->
  <div class="row text-white mb-4">
    <div class="col-md-4">
      <div class="card bg-dark">
        <div class="card-body text-center">
          <h5>Total Customers</h5>
          <h2 ><?= $totalCustomers ?></h2>
           <img src="../assets/images/customers.png" alt="Dashboard Banner" class="icon-img " />
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-dark">
        <div class="card-body text-center">
          <h5>Total Items</h5>
          <h2><?= $totalItems ?></h2>
          <img src="../assets/images/img-2.png" alt="Dashboard Banner" class=" icon-img" />
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-dark">
        <div class="card-body text-center">
          <h5>Total Invoices</h5>
          <h2><?= $totalInvoices ?></h2>
           <img src="../assets/images/item.png" alt="Dashboard Banner" class=" icon-img" />
        </div>
      </div>
    </div>
  </div>

 
