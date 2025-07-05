<?php
require_once "../../backend/config/database.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid ID");
}

// Fetch customer data
$stmt = $conn->prepare("SELECT * FROM customer WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $contact_no = $_POST['contact_no'];
    $district = $_POST['district'];

    $update = $conn->prepare("UPDATE customer SET title=?, first_name=?, middle_name=?, last_name=?, contact_no=?, district=? WHERE id=?");
    $update->bind_param("ssssssi", $title, $first_name, $middle_name, $last_name, $contact_no, $district, $id);
    $update->execute();

    header("Location: ../../frontend/customers/viewcustomers.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Customer</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<div class="edit-wrapper mt-5 bg-blue " >
  <h2 class="mb-4 text-center">Edit Customer</h2>
  <form method="POST" class="mx-auto" style="max-width: 600px;">
    
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <select name="title" id="title" class="form-select" required>
        <option value="">-- Select Title --</option>
        <?php
        $titles = ['Mr', 'Mrs', 'Miss', 'Dr'];
        foreach ($titles as $t) {
            $selected = ($customer['title'] === $t) ? 'selected' : '';
            echo "<option value=\"$t\" $selected>$t</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="first_name" class="form-label">First Name</label>
      <input type="text" name="first_name" id="first_name" class="form-control" value="<?= htmlspecialchars($customer['first_name']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="middle_name" class="form-label">Middle Name</label>
      <input type="text" name="middle_name" id="middle_name" class="form-control" value="<?= htmlspecialchars($customer['middle_name']) ?>">
    </div>

    <div class="mb-3">
      <label for="last_name" class="form-label">Last Name</label>
      <input type="text" name="last_name" id="last_name" class="form-control" value="<?= htmlspecialchars($customer['last_name']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="contact_no" class="form-label">Contact No</label>
      <input type="text" name="contact_no" id="contact_no" class="form-control" value="<?= htmlspecialchars($customer['contact_no']) ?>" required pattern="\d{10}" title="Enter a valid 10-digit phone number">
    </div>

    <div class="mb-3">
      <label for="district" class="form-label">District (ID)</label>
      <input type="number" name="district" id="district" class="form-control" value="<?= htmlspecialchars($customer['district']) ?>" required>
    </div>

               <div class="form-buttons d-flex justify-content-between gap-2">

    <button type="submit" class="btn btn-primary w-100">Update</button>
<a href="/Assignment/frontend/customers/viewcustomers.php" class="btn btn-secondary btn-sm w-50">View</a>



</div>
  </form>
</div>

<style>
  body {
    background-color: #0E2148;
    min-height: 100vh;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .edit-wrapper {
    background-color: #ffffff;
    padding: 30px;
    width: 100%;
    max-width: 800px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
  }

  .form-buttons a {
    height: 38px;
  }


</style>


</body>
</html>
