<?php
include "../autoload/loader.php";
$ctr = new OrdersController();
$order_details = $ctr->invoice();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #<?= $invoice_number ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Invoice</h2>
        <p><strong>Invoice Number:</strong> <?= $invoice_number ?></p>
        <p><strong>Order Date:</strong> <?= $order['created_at'] ?></p>
        <p><strong>Total Amount:</strong> #<?= number_format($order['total_amount'], 2) ?></p>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_details as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>#<?= number_format($item['price'], 2) ?></td>
                        <td>#<?= number_format($item['quantity'] * $item['price'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <button class="btn btn-primary" onclick="window.print()">Print Invoice</button>
        <a href="orders" class="btn btn-secondary">View My Orders</a>
    </div>
</body>
</html>
