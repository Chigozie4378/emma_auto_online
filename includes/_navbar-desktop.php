<!-- Navbar for Desktop -->
<nav class="bg-dark text-white py-2 desktop-nav">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo Section -->
            <div class="col-md-2">
                <h3>Emma Auto</h3>
            </div>
            
            <!-- Search Section -->
            <div class="col-md-8">
                <div class="row gx-2">
                    <div class="col-md-4">
                        <select class="form-control chosen" name="productname" onchange="selectProduct(this.value)" id="productname">
                            <option value="">Please Select Item</option>
                            <?php
                            $select = $ctr->searchProducts();
                            while ($row = mysqli_fetch_array($select)) { ?>
                                <option value="<?php echo $row['name'] ?>">
                                    <?php echo $row['product_name'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4" id="modelDiv">
                        <select class="form-control" style="height:45px;">
                            <option value="">Select Model</option>
                        </select>
                    </div>
                    <div class="col-md-4" id="brandDiv">
                        <select class="form-control" style="height:45px;">
                            <option value="">Select Brand</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Cart Section -->
            <div class="col-md-2 text-end">
                <span class="text-white">My Cart: £93.01</span>
            </div>
        </div>
    </div>
</nav>
