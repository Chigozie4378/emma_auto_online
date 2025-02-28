<?php
include_once "../../autoload/loader.php";
$ctr = new ProductsController();
$product_name = $_POST['product_name'];
$model = $_POST['model'];
$search_brands = $ctr->searchBrands($product_name,$model);


?>
<label for="">Brand</label>
<select class="form-control chosen" style="height:45px;" name="brand" id="brand"
    onchange="productResults(this.value,'<?php echo $product_name ?>','<?php echo $model ?>')">
    <option> Select Brand </option>
    <?php

    while ($row = mysqli_fetch_array($search_brands)) { ?>
        <option value="<?php echo $row['manufacturer'] ?>">
            <?php echo ($row['manufacturer']) ?>
        </option>
    <?php } ?>
</select>

<script>
        $(".chosen").chosen();
    </script>