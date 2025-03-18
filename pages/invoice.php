<?php
include "../autoload/loader.php";
$ctr = new OrdersController();
$orders = $ctr->invoice();
$order_details = $ctr->invoiceDetails();
$order = $orders->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #<?= $order['invoice_no'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fc;
            font-family: 'Poppins', sans-serif;
        }
        .invoice-card {
            background-color: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            margin: 40px auto;
            max-width: 700px;
        }
        .item-card {
            border-bottom: 1px solid #efefef;
            padding: 15px 0;
        }
        .item-title {
            font-weight: 600;
            font-size: 16px;
        }
        .item-line {
            display: flex;
            justify-content: space-between;
            color: #6c757d;
            font-size: 16px;
            margin-top: 4px;
        }
        .total-box {
            border-top: 2px solid #dee2e6;
            padding-top: 20px;
            margin-top: 20px;
        }
        .total-box h4 {
            font-weight: bold;
        }
        .btn-print, .btn-orders {
            margin-top: 20px;
        }
        @media print {
            .btn-print, .btn-orders { display: none; }
        }
    </style>
</head>
<body>
    <div class="invoice-card">
        <h2 class="text-center mb-4">Invoice</h2>
        <div class="mb-3">
        <p><strong>Name:</strong> <?= $order['name'] ?></p>
            <p><strong>Invoice Number:</strong> <?= $order['invoice_no'] ?></p>
            <p><strong>Order Date:</strong> <?= $order['created_at'] ?></p>
        </div>
        
        <?php foreach ($order_details as $item): ?>
            <div class="item-card">
                <div class="item-title"><?= $item['quantity'] ?> × <?= htmlspecialchars($item['product_name'])?> &nbsp;&nbsp; <?= htmlspecialchars($item['model'])?>&nbsp;&nbsp; <?=htmlspecialchars($item['manufacturer']) ?></div>
                <div class="item-line">
                    <span>Unit Price: #<?= number_format($item['price'], 2) ?></span>
                    <span>Amount: #<?= number_format($item['quantity'] * $item['price'], 2) ?></span>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="total-box text-end">
            <h4>Total Amount: #<?= number_format($order['total_amount'], 2) ?></h4>
        </div>
        
        <div class="d-flex justify-content-end gap-2">
        <a href="orders" class="btn btn-secondary btn-orders">Orders</a>
            <button class="btn btn-primary btn-print" onclick="window.print()">Print Invoice</button>
            
        </div>
    </div>
</body>
</html>
