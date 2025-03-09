<?php
include_once "../../autoload/loader.php";
$ctr = new ProductsController();
$product_name = $_POST['product_name'];
$search_models = $ctr->searchModels($product_name);
echo '<option value="">Select a Model</option>';
// Return just <option> tags:
while ($row = mysqli_fetch_array($search_models)) {
    
    echo '<option value="' . htmlspecialchars($row['model']) . '">';
    echo htmlspecialchars($row['model']);
    echo '</option>';
}
?>

    <script>
        $(".chosen").chosen();
    </script>