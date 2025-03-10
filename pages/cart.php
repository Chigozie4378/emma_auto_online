<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$totalItems = count($cart);
$totalQuantity = array_sum(array_column($cart, 'quantity'));
$totalAmount = array_sum(array_map(function ($item) {
    return $item['quantity'] * $item['price'];
}, $cart));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .cart-container {
            max-width: 900px;
            margin: auto;
        }
        .cart-item {
            display: flex;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            background: #fff;
            align-items: center;
        }
        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
        .cart-details {
            flex-grow: 1;
            padding-left: 15px;
        }
        .cart-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
        .qty-input {
            width: 60px;
            text-align: center;
        }
        .cart-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .empty-cart {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-4 cart-container">
    <div class="cart-summary">
        <h2 class="text-center">Shopping Cart</h2>
        <div>
            <span class="badge bg-primary">Items: <span id="total-items"><?= $totalItems ?></span></span>
            <span class="badge bg-success">Qty: <span id="total-qty"><?= $totalQuantity ?></span></span>
        </div>
    </div>

    <div id="cart-body">
        <?php if ($totalItems > 0): ?>
            <?php foreach ($cart as $item): ?>
                <div class="cart-item">
                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="Product">
                    <div class="cart-details">
                        <h5><?= htmlspecialchars($item['name']) ?></h5>
                        <p>Model: <?= htmlspecialchars($item['model']) ?> | Brand: <?= htmlspecialchars($item['brand']) ?></p>
                        <p>Unit Price: <span class="unit-price">$<?= $item['price'] ?></span></p>
                        <div class="cart-actions">
                            <input type="number" class="form-control qty-input" value="<?= $item['quantity'] ?>" min="1" 
                            onchange="updateCart(<?= $item['id'] ?>, this.value)">
                            <span class="bold amount">$<?= $item['quantity'] * $item['price'] ?></span>
                            <button class="btn btn-danger btn-sm" onclick="removeFromCart(<?= $item['id'] ?>)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-cart">
                <img src="../assets/images/empty-cart.gif" alt="Empty Cart" width="200">
                <h5>You don't have any items in your cart. Let's start shopping!</h5>
            </div>
        <?php endif; ?>
    </div>

    <div class="text-end mt-3">
        <h4 class="bold">Total Amount: <span id="total-amount">$<?= $totalAmount ?></span></h4>
    </div>
</div>

<script>
    function updateCart(productId, quantity) {
        fetch('cart_session.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=update&product_id=${productId}&quantity=${quantity}`
        }).then(response => response.json())
          .then(() => location.reload());
    }

    function removeFromCart(productId) {
        fetch('cart_session.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=remove&product_id=${productId}`
        }).then(response => response.json())
          .then(() => location.reload());
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
