<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ERP System</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
        crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-blue">
    <div class="container">
      <a class="navbar-brand" href="#">ERP</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav mx-5">
            <li class="nav-item mx-2">
            <a class="nav-link" href="/Assignment/frontend/home/dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link" href="/Assignment/frontend/customers/registration.php">Customer Registration</a>
          </li>
          <li class="nav-item mx-2">
  <a class="nav-link" href="/Assignment/frontend/customers/viewcustomers.php">View Customers</a>
</li>

          <li class="nav-item mx-2">
            <a class="nav-link" href="/Assignment/frontend/items/itemform.php">Item Registration</a>
          </li>

         <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
     data-bs-toggle="dropdown" aria-expanded="false">
    Reports
  </a>
  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
    <li><a class="dropdown-item" href="/Assignment/frontend/reports/invoice_report.php">Invoice Report</a></li>
    <li><a class="dropdown-item" href="/Assignment/frontend/reports/invoice_item_report.php">Invoice Item Report</a></li>
    <li><a class="dropdown-item" href="/Assignment/frontend/reports/item_report.php">Item Report</a></li>
  </ul>
</li>
        </ul>
      </div>
    </div>
  </nav>

<!-- Bootstrap JS (Bundle includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>



