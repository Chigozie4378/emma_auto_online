<div class="search-product mt-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4"   onclick="redirectToProduct()">
                <label for="">Product Name</label>
                <select class="form-control chosen" 
                    onchange="selectProduct(this.value)" id="product_name">
                    <option>Select a Product Name </option>
                    <?php

                    while ($row = mysqli_fetch_array($search_product)) { ?>
                        <option value="<?php echo $row['product_name'] ?>">
                            <?php echo ($row['product_name']) ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-12 col-md-4" id="modelDiv"   onclick="redirectToProduct()">
                <label for="">Model</label>
                <select class="form-control chosen">
                    <option selected>Select Model</option>
                </select>
            </div>
            <div class="col-sm-12 col-md-4"  id="brandDiv"   onclick="redirectToProduct()">
                <label for="">Brand</label>
                <select class="form-control chosen">
                    <option selected>Select Brand</option>
                </select>
            </div>
        </div>
    </div>
</div>