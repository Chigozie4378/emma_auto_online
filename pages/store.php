<?php
include "../autoload/loader.php";
$ctr = new ProductsController();
$products = $ctr->productName();
$search_product = $ctr->searchProducts();
$totalProducts = $products->num_rows;
if ($_SERVER['REQUEST_URI'] == "/emma_auto_online/pages/store" && $totalProducts == 0) {
  header("Location: /emma_auto_online/");
  exit;
}
?>

<?php 
    include "../includes/_product_header.php";
    include "../includes/_navbar.php"; 
    include "../includes/_product_content.php";
    include "../includes/_product_footer.php";
    ?>