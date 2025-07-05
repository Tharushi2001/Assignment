<?php
require_once "../../backend/config/database.php";

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM customer WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: ../../frontend/customers/viewcustomers.php");
exit;
