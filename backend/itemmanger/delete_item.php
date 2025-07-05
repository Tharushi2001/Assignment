<?php
require_once "../../backend/config/database.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid ID");
}

// Delete the item
$stmt = $conn->prepare("DELETE FROM item WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: /Assignment/frontend/items/viewitems.php");
exit;
