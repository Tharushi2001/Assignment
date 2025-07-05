<?php
require_once "../config/database.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $item_code = trim($_POST['itemcode']);
    $item_name = trim($_POST['itemname']);
    $item_category = intval($_POST['itemcategory']);
    $item_subcategory = intval($_POST['itemsub']);
    $quantity = intval($_POST['quantity']);
    $unit_price = floatval($_POST['unitpp']);

   
    if (empty($item_code) || empty($item_name) || !$item_category || !$item_subcategory || $quantity < 1 || $unit_price <= 0) {
        die("Invalid input data.");
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO item (item_code, item_category, item_subcategory, item_name, quantity, unit_price) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siisid", $item_code, $item_category, $item_subcategory, $item_name, $quantity, $unit_price);

if ($stmt->execute()) {
    echo "<script>
        alert('Item submitted successfully!');
        window.location.href = '../../frontend/items/viewitems.php';
    </script>";
} else {
    echo "Error: " . $stmt->error;
}


    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
