<?php
include_once "../../autoload/loader.php";
$ctr = new ProductsController();
$product_name = $_POST['product_name'];
$search_models = $ctr->searchModels($product_name);


    while ($row = mysqli_fetch_array($search_models)) { ?>
        <option value="<?php echo $row['model'] ?>">
            <?php echo ($row['model']) ?>
        </option>
    <?php }
    
