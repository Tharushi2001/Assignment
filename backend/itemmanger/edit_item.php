<?php
require_once "../../backend/config/database.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid ID");
}

// Fetch existing item
$stmt = $conn->prepare("SELECT * FROM item WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();

if (!$item) {
    die("Item not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_code = $_POST['item_code'];
    $item_name = $_POST['item_name'];
    $item_category = $_POST['item_category'];
    $item_subcategory = $_POST['item_subcategory'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    $update = $conn->prepare("UPDATE item SET item_code=?, item_name=?, item_category=?, item_subcategory=?, quantity=?, unit_price=? WHERE id=?");
    $update->bind_param("ssiidii", $item_code, $item_name, $item_category, $item_subcategory, $quantity, $unit_price, $id);
    $update->execute();

    header("Location: /Assignment/frontend/items/viewitems.php");
    exit;
}

// Fetch categories and subcategories for dropdowns
$cat_result = $conn->query("SELECT id, category FROM item_category");
$subcat_result = $conn->query("SELECT id, sub_category FROM item_subcategory");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="edit-wrapper">
    
    <h2 class="text-center">Edit Item</h2>
   
    <form method="POST" style="max-width:600px;">
        <div class="mb-3">
            <label for="item_code" class="form-label">Item Code</label>
            <input type="text" name="item_code" id="item_code" class="form-control" value="<?= htmlspecialchars($item['item_code']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="item_name" class="form-label">Item Name</label>
            <input type="text" name="item_name" id="item_name" class="form-control" value="<?= htmlspecialchars($item['item_name']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="item_category" class="form-label">Category</label>
            <select name="item_category" id="item_category" class="form-select" required>
                <option value="">Select Category</option>
                <?php while ($cat = $cat_result->fetch_assoc()): ?>
                    <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $item['item_category']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['category']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="item_subcategory" class="form-label">Sub Category</label>
            <select name="item_subcategory" id="item_subcategory" class="form-select" required>
                <option value="">Select Subcategory</option>
                <?php while ($subcat = $subcat_result->fetch_assoc()): ?>
                    <option value="<?= $subcat['id'] ?>" <?= ($subcat['id'] == $item['item_subcategory']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($subcat['sub_category']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="<?= htmlspecialchars($item['quantity']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="unit_price" class="form-label">Unit Price</label>
            <input type="number" step="0.01" name="unit_price" id="unit_price" class="form-control" value="<?= htmlspecialchars($item['unit_price']) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Item</button>
        <a href="/Assignment/frontend/items/viewitems.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>



</body>

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
    width:600px;

    max-width: 800px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    
  }

  .form-buttons a {
    height: 38px;
  }


</style>
</html>
