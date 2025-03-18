<?php
include "../autoload/loader.php";
$ctr = new OrdersController();
$orders = $ctr->orders();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fc;
            font-family: 'Poppins', sans-serif;
        }
        .orders-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 0 8px rgba(0,0,0,0.05);
        }
        .order-card {
            border: 1px solid #e9ecef;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            text-decoration: none;
            color: inherit;
            transition: box-shadow 0.3s, transform 0.2s;
            display: block;
        }
        .order-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .order-info p {
            margin: 0;
            font-size: 15px;
        }
        .order-info p strong {
            font-weight: 600;
        }
        @media (max-width: 576px) {
            .order-card {
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="orders-container">
        <h2 class="text-center mb-4">My Orders</h2>

        <?php if ($orders->num_rows > 0): ?>
            <?php while ($order = $orders->fetch_assoc()): ?>
                <a href="invoice?oid=<?= urlencode($order['order_id']) ?>" class="order-card">
                    <div class="order-info">
                        <p><strong>Invoice No:</strong> <?= $order['invoice_no'] ?></p>
                        <p><strong>Order Date:</strong> <?= $order['created_at'] ?></p>
                        <p><strong>Total Amount:</strong> #<?= number_format($order['total_amount'], 2) ?></p>
                        <p><strong>Status:</strong> <?= ucfirst($order['status']) ?></p>
                    </div>
                </a>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">You have no orders yet.</p>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="home" class="btn btn-secondary">Go Back to Home</a>
        </div>
    </div>
</body>
</html>
