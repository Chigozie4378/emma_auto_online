<?php
session_start();
include "../autoload/loader.php";

header('Content-Type: application/json');

// Ensure session cart is initialized
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$action = $_POST['action'] ?? '';
$productId = $_POST['product_id'] ?? '';
$quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;

// Handle fetching cart count
if ($action === 'count') {
    echo json_encode(['cart_count' => count($_SESSION['cart'])]);
    exit;
}

// Handle adding item to cart
if ($action === 'add' && $productId && $quantity > 0) {
    $ctr = new ProductsController();
    $result = $ctr->fetchProduct($productId);

    if (!$result) {
        echo json_encode(['success' => false, 'message' => 'Product not found.']);
        exit;
    }

    foreach ($result as $item) {
        $_SESSION['cart'][$productId] = [
            'id' => $item['product_id'],
            'name' => $item['product_name'],
            'model' => $item['model'],
            'brand' => $item['brand'],
            'image' => $item['image_path'],
            'price' => $item['price'],
            'quantity' => $quantity
        ];
    }

    echo json_encode(['success' => true, 'cart_count' => count($_SESSION['cart'])]);
    exit;
}

// Handle updating item quantity
if ($action === 'update' && isset($_SESSION['cart'][$productId])) {
    $_SESSION['cart'][$productId]['quantity'] = $quantity;
    echo json_encode(['success' => true, 'message' => 'Cart updated successfully']);
    exit;
}

// Handle removing item from cart
if ($action === 'remove') {
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);

        // Recalculate total amount after deletion
        $totalAmount = array_sum(array_map(function ($item) {
            return $item['quantity'] * $item['price'];
        }, $_SESSION['cart']));

        echo json_encode([
            'success' => true,
            'cart_count' => count($_SESSION['cart']),
            'total_amount' => $totalAmount, // Return updated total
            'message' => 'Item removed from cart.'
        ]);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Product not found in cart.']);
        exit;
    }
}

// Return full cart details (for debugging)
if ($action === 'get_cart') {
    echo json_encode(['success' => true, 'cart' => $_SESSION['cart']]);
    exit;
}

// Default response if action is not recognized
echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit;
?>