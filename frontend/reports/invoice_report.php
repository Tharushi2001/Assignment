<?php
require_once "../../backend/config/database.php";
require_once "../header.php";

// Get date range from GET parameters
$start_date = $_GET['start_date'] ?? '';
$end_date = $_GET['end_date'] ?? '';

$condition = "";
if ($start_date && $end_date) {
    $condition = "WHERE i.date BETWEEN '$start_date' AND '$end_date'";
}

// Fetch invoice data
$sql = "
SELECT 
    i.invoice_no,
    i.date,
    CONCAT(c.first_name, ' ', c.last_name) AS customer_name,
    d.district,
    i.item_count,
    i.amount
FROM invoice i
JOIN customer c ON i.customer = c.id
JOIN district d ON c.district = d.id
$condition
ORDER BY i.date ASC
";

$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2 class="text-center">Invoice Report</h2>

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
        <table class="table table-bordered table-striped">    <!-- Display the invoice records in a table -->
            <thead class="table-dark">
                <tr>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>District</th>
                    <th>Item Count</th>
                    <th>Invoice Amount (LKR)</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>      <!-- Loop through each record and display its data -->
                    <tr>
                        <td><?= htmlspecialchars($row['invoice_no']) ?></td>
                        <td><?= htmlspecialchars($row['date']) ?></td>
                        <td><?= htmlspecialchars($row['customer_name']) ?></td>
                        <td><?= htmlspecialchars($row['district']) ?></td>
                        <td><?= htmlspecialchars($row['item_count']) ?></td>
                        <td><?= number_format($row['amount'], 2) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No invoices found for selected date range.</div>
    <?php endif; ?>
</div>
