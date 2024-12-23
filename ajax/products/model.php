<?php
include_once "../../autoload/loader.php";
$ctr = new ProductsController();
$product_name = $_POST['product_name'];
$search_models = $ctr->searchModels($product_name);

?>

<select class="form-control" style="height:45px;" name="model" id="model"
    onchange="selectModel(this.value,'<?php echo $product_name ?>')">
    <option> Select Model </option>
    <?php

    while ($row = mysqli_fetch_array($search_models)) { ?>
        <option value="<?php echo $row['model'] ?>">
            <?php echo ($row['model']) ?>
        </option>
    <?php } ?>
</select>