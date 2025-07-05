<?php
require_once "../../backend/config/database.php";
require_once "../header.php";

// Handle date filters
$start_date = $_GET['start_date'] ?? '';
$end_date = $_GET['end_date'] ?? '';

$condition = "";
if ($start_date && $end_date) {
    $condition = "WHERE inv.date BETWEEN '$start_date' AND '$end_date'";
}

// Query
$sql = "
SELECT 
    inv.invoice_no,
    inv.date,
    CONCAT(c.first_name, ' ', c.last_name) AS customer_name,
    it.item_code,
    it.item_name,
    cat.category AS item_category,
    im.unit_price
FROM invoice_master im
JOIN invoice inv ON im.invoice_no = inv.invoice_no
JOIN customer c ON inv.customer = c.id
JOIN item it ON im.item_id = it.id
JOIN item_category cat ON it.item_category = cat.id
$condition
ORDER BY inv.date ASC, inv.invoice_no
";


// Execute the query
$result = $conn->query($sql); 

?>

<div class="container mt-5">
    <h2 class="text-center">Invoice Item Report</h2>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-5">
            <label>Start Date:</label>
            <input type="date" name="start_date" class="form-control" required value="<?= htmlspecialchars($start_date) ?>">
        </div>
        <div class="col-md-5">
            <label>End Date:</label>
            <input type="date" name="end_date" class="form-control" required value="<?= htmlspecialchars($end_date) ?>">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <?php if ($result && $result->num_rows > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Invoice No</th>     <!-- Column Names -->
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Item Category</th>
                    <th>Unit Price (LKR)</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>    <!-- Loop through each record and display it -->
                    <tr>
                        <td><?= htmlspecialchars($row['invoice_no']) ?></td>
                        <td><?= htmlspecialchars($row['date']) ?></td>
                        <td><?= htmlspecialchars($row['customer_name']) ?></td>
                        <td><?= htmlspecialchars($row['item_code']) ?></td>
                        <td><?= htmlspecialchars($row['item_name']) ?></td>
                        <td><?= htmlspecialchars($row['item_category']) ?></td>
                        <td><?= number_format($row['unit_price'], 2) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No records found for selected date range.</div>
    <?php endif; ?>
</div>
