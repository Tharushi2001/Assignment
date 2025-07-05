<?php
require_once "../../backend/config/database.php";

// Get the customer ID from the URL query parameter 
$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM customer WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Redirect to the customer view page after deletion
header("Location: ../../frontend/customers/viewcustomers.php");
exit;
