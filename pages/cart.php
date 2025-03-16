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
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/chosen/chosen.css">
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
    <?php include "../includes/_navbar.php"; ?>
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
                    <div class="cart-item" id="cart-item-<?php echo $item['id']; ?>">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="Product">
                        <div class="cart-details">
                            <h5><?php echo htmlspecialchars($item['name']); ?></h5>
                            <p> <?php echo htmlspecialchars($item['model']); ?> |
                                <?php echo htmlspecialchars($item['brand']); ?>
                            </p>
                            <p>Unit Price: <span style="font-weight: bold;"
                                    class="unit-price">#<?php echo $item['price']; ?></span></p>
                            <div class="cart-actions">
                                <input type="number" style="font-weight: bold;" class="form-control qty-input"
                                    value="<?php echo $item['quantity']; ?>" min="1"
                                    onchange="updateCart('<?php echo $item['id']; ?>', this.value)">
                                <span style="font-weight: bold;"
                                    class="bold amount">#<?php echo $item['quantity'] * $item['price']; ?></span>
                                <button class="btn btn-danger btn-sm" onclick="removeFromCart('<?php echo $item['id']; ?>')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-cart">
                    <img src="../assets/images/cart/cart.jpg" alt="Empty Cart" height="250" style="object-fit: contain;"
                        width="200">
                    <h5>You don't have any items in your cart. <a href="home"
                            style="list-style-type:none; text-decoration: none;"> Let's start shopping!</a></h5>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-end my-3">
            <h4 style="font-weight: bold;" class="bold">Total Amount: <span
                    id="total-amount">#<?= $totalAmount ?></span></h4>
            <?php if ($totalAmount > 0): ?>
                <button class="btn btn-success mt-3" onclick="proceedToCheckout()">Proceed to Checkout</button>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/chosen/chosen.js"></script>
    <script src="../assets/js/navbar.js"></script>

    <script>
        function updateCart(productId, quantity) {
            fetch('../tools/cart_session', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=update&product_id=${productId}&quantity=${quantity}`
            }).then(response => response.json())
                .then(() => location.reload());
        }


        function removeFromCart(productId) {
            fetch('../tools/cart_session', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=remove&product_id=${productId}`
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let cartItem = document.getElementById(`cart-item-${productId}`);
                        if (cartItem) {
                            cartItem.remove();
                        }

                        updateCartCount();
                        updateCartSummary(); // ✅ Update summary immediately after removing item

                        // If no items are left, update the UI correctly
                        let cartBody = document.getElementById("cart-body");
                        if (document.querySelectorAll(".cart-item").length === 0) {
                            cartBody.innerHTML = `
                    <div class="empty-cart">
                        <img src="../assets/images/cart/cart.jpg" alt="Empty Cart" width="200">
                        <h5>You don't have any items in your cart. <a href="home" style="list-style-type:none; text-decoration: none;">Let's start shopping!</a></h5>
                    </div>
                `;
                        }
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }





        function updateCartCount() {
            fetch('..tools/cart_session', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=count'
            })
                .then(response => response.json())
                .then(data => {
                    let cartCountElement = document.getElementById("cart-count");
                    let mobileCartCountElement = document.getElementById("mobile-cart-count");

                    // Update cart count only if the elements exist
                    if (cartCountElement) {
                        cartCountElement.innerText = data.cart_count;
                    }
                    if (mobileCartCountElement) {
                        mobileCartCountElement.innerText = data.cart_count;
                    }
                })
                .catch(error => console.error("Error updating cart count:", error));
        }

        function updateTotalAmount() {
            let total = 0;
            let cartItems = document.querySelectorAll('.cart-item');

            cartItems.forEach(item => {
                let amountText = item.querySelector('.amount').innerText.replace('$', '');
                total += parseFloat(amountText) || 0;
            });

            let totalAmountElement = document.getElementById('total-amount');
            if (totalAmountElement) {
                totalAmountElement.innerText = `$${total.toFixed(2)}`;
            }
        }

        function updateCartSummary() {
            let totalItems = 0;
            let totalQuantity = 0;
            let totalAmount = 0;

            let cartItems = document.querySelectorAll('.cart-item');

            if (cartItems.length === 0) {
                // If cart is empty, reset all counters
                document.getElementById('total-items').innerText = 0;
                document.getElementById('total-qty').innerText = 0;
                document.getElementById('total-amount').innerText = "#0.00"; // Ensure this is reset
                return;
            }

            cartItems.forEach(item => {
                let quantityInput = item.querySelector('.qty-input');
                let amountText = item.querySelector('.amount').innerText.replace('#', ''); // Remove currency symbol

                let quantity = parseInt(quantityInput.value) || 0;
                let amount = parseFloat(amountText) || 0;

                totalQuantity += quantity;
                totalAmount += amount;
                totalItems++;
            });

            // Update total items, quantity, and total amount in UI
            document.getElementById('total-items').innerText = totalItems;
            document.getElementById('total-qty').innerText = totalQuantity;
            document.getElementById('total-amount').innerText = `#${totalAmount.toFixed(2)}`;
        }

        function proceedToCheckout() {
            fetch('../tools/status', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=check_login'
            })
                .then(response => response.json())
                .then(data => {
                    if (data.logged_in) {
                        window.location.href = 'checkout'; // Redirect to order processing
                    } else {
                        alert("You need to sign in before checking out.");
                        window.location.href = 'sign_in'; // Redirect to login page
                    }
                })
                .catch(error => console.error("Error:", error));
        }



    </script>
</body>

</html>