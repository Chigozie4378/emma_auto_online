

<?php
include_once "../../autoload/loader.php";
$ctr = new ProductsController();
$product_name = $_POST['product_name'];
$model = $_POST['model'];
$search_brands = $ctr->searchBrands($product_name,$model);
echo '<option value="">Select Brand</option>';
// Return just <option> tags:
while ($row = mysqli_fetch_array($search_brands)) {
   
    echo '<option value="' . htmlspecialchars($row['manufacturer']) . '">';
    echo htmlspecialchars($row['manufacturer']);
    echo '</option>';
}
?>

<script>
        $(".chosen").chosen();
    </script>