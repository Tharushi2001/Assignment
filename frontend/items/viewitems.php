<?php
require_once "../../backend/config/database.php";
require_once "../header.php";

// Fetch items with category and subcategory names
$sql = "SELECT i.id, i.item_code, i.item_name, i.quantity, i.unit_price, 
               c.category, s.sub_category 
        FROM item i
        JOIN item_category c ON i.item_category = c.id
        JOIN item_subcategory s ON i.item_subcategory = s.id
        ORDER BY i.id";

$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Registered Items</h2>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['item_code']) ?></td>
                        <td><?= htmlspecialchars($row['item_name']) ?></td>
                        <td><?= htmlspecialchars($row['category']) ?></td>
                        <td><?= htmlspecialchars($row['sub_category']) ?></td>
                        <td><?= htmlspecialchars($row['quantity']) ?></td>
                        <td><?= number_format($row['unit_price'], 2) ?></td>
                         <td>
                               <a href="/Assignment/backend/itemmanger/edit_item.php?id=<?= $row['id'] ?>" class="btn-sm btn-primary me-1" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                       <a href="/Assignment/backend/itemmanger/delete_item.php?id=<?= $row['id'] ?>" class="btn-sm btn-danger" title="Delete"
                   onclick="return confirm('Are you sure you want to delete this customer?');">
                    <i class="fas fa-trash-alt"></i>
                </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No items registered yet.</div>
    <?php endif; ?>
</div>
