<?php
require_once "../../backend/config/database.php";
require_once "../header.php";

// Fetch item categories
$cat_query = "SELECT id, category FROM item_category ORDER BY category ASC";
$cat_result = $conn->query($cat_query);

// Fetch item subcategories
$subcat_query = "SELECT id, sub_category FROM item_subcategory ORDER BY sub_category ASC";
$subcat_result = $conn->query($subcat_query);
?>

<div class="banner-img">
  <form action="../../backend/customcontroller/submit_item.php" method="post">
    <div class="container">
      <h2 class="mt-3 text-center text-white">Items Registration</h2>
      <div class="outer-box">

        <label for="itemcode"><b>Item Code</b></label>
        <input type="text" name="itemcode" class="form-input" required>

        <label for="itemname"><b>Item Name</b></label>
        <input type="text" name="itemname" class="form-input" required>

        <label for="itemcategory"><b>Item Category</b></label>
        <select name="itemcategory" class="form-input" required>
          <option value="">-- Select Category --</option>
          <?php while ($cat = $cat_result->fetch_assoc()): ?>
            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['category']) ?></option>
          <?php endwhile; ?>
        </select>

        <label for="itemsub"><b>Item Sub Category</b></label>
        <select name="itemsub" class="form-input" required>
          <option value="">-- Select Sub Category --</option>
          <?php while ($sub = $subcat_result->fetch_assoc()): ?>
            <option value="<?= $sub['id'] ?>"><?= htmlspecialchars($sub['sub_category']) ?></option>
          <?php endwhile; ?>
        </select>

        <label for="quantity"><b>Quantity</b></label>
        <input type="number" name="quantity" class="form-input" required min="1">

        <label for="unitpp"><b>Unit Price</b></label>
        <input type="text" name="unitpp" class="form-input" required pattern="^\d+(\.\d{1,2})?$" title="Enter a valid price (e.g., 100.00)">

        
           
           <div class="form-buttons d-flex justify-content-between gap-2">
  <input type="submit" value="Register" class="form-submit btn-sm">
  <a href="viewitems.php" class="btn btn-secondary btn-sm w-50">View</a>
</div>

      </div>
    </div>
  </form>
</div>
