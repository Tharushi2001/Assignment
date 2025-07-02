<?php
require_once "../../backend/config/database.php";
require_once "../header.php";

// Fetch customer data with district name
$sql = "SELECT c.id, c.title, c.first_name, c.middle_name, c.last_name, c.contact_no, d.district 
        FROM customer c 
        JOIN district d ON c.district = d.id 
        ORDER BY c.id ";

$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Registered Customers</h2>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Contact No</th>
                    <th>District</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= htmlspecialchars($row['first_name']) ?></td>
                        <td><?= htmlspecialchars($row['middle_name']) ?></td>
                        <td><?= htmlspecialchars($row['last_name']) ?></td>
                        <td><?= htmlspecialchars($row['contact_no']) ?></td>
                        <td><?= htmlspecialchars($row['district']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No customers registered yet.</div>
    <?php endif; ?>
</div>

