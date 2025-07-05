<?php
require_once "../../backend/config/database.php";
require_once "../header.php";

$sql = "
SELECT 
    i.item_name,
    c.category AS item_category,
    sc.sub_category AS item_subcategory,
    i.quantity
FROM item i
JOIN item_category c ON i.item_category = c.id
JOIN item_subcategory sc ON i.item_subcategory = sc.id
GROUP BY i.item_name, c.category, sc.sub_category, i.quantity
ORDER BY i.item_name ASC
";

$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Item Summary Report</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Available Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['item_name']) ?></td>
                        <td><?= htmlspecialchars($row['item_category']) ?></td>
                        <td><?= htmlspecialchars($row['item_subcategory']) ?></td>
                        <td><?= htmlspecialchars($row['quantity']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No items found.</div>
    <?php endif; ?>
</div>
