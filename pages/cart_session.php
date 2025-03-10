<?php
session_start();
include "../autoload/loader.php";
$ctr = new ProductsController();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $productId = $_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    if ($action === 'add') {
        // Fetch product details (mock data or database query)
        $results = $ctr->fetchProduct($product_id);
        foreach ($results as $result){

        }
        $product = [
            'id' => $result['product_id'],
            'name' => $result['product_name'],
            'model' => $result['model'],,
            'brand' => $result['brand'],,
            'image' => $result['image_path'],
            'price' => $result['image_path'],
            'quantity' => $quantity
        ];

        $_SESSION['cart'][$productId] = $product;
    }

    if ($action === 'update' && isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] = $quantity;
    }

    if ($action === 'remove') {
        unset($_SESSION['cart'][$productId]);
    }

    echo json_encode(['success' => true, 'cart' => $_SESSION['cart']]);
}
?>
