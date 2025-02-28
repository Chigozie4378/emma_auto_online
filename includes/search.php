<div class="search-product mt-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <label for="">Product Name</label>
                <select class="form-control chosen"
                    onchange="selectProduct(this.value)">
                    <option> Select Product Name ... </option>
                    <?php

                    while ($row = mysqli_fetch_array($search_product)) { ?>
                        <option value="<?php echo $row['product_name'] ?>">
                            <?php echo ($row['product_name']) ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-12 col-md-4">
                <label for="">Model</label>
                <select class="form-control chosen" id="modelDiv" aria-label="Model Select">
                    <option selected>Please select...</option>
                </select>
            </div>
            <div class="col-sm-12 col-md-4">
                <label for="">Product</label>
                <select class="form-control chosen" aria-label="Year Select">
                    <option selected>Please select...</option>
                </select>
            </div>
        </div>
    </div>
</div>