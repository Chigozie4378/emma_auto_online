<?php
session_start();
include "../autoload/loader.php";
$ctr = new OrdersController();
$orders = $ctr->orders();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>My Orders</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Invoice Number</th>
                    <th>Total Amount</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['invoice_number']) ?></td>
                        <td>#<?= number_format($order['total_amount'], 2) ?></td>
                        <td><?= $order['created_at'] ?></td>
                        <td><a href="invoice?oid=<?= $order['oid'] ?>" class="btn btn-info">View Invoice</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
