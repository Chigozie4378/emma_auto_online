<?php
include_once "./autoload/loader.php";
$ctr = new ProductsController();
$search_product = $ctr->searchProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/images/logo/logo.jpg" type="image/gif" sizes="20x20">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/navbar.css">
    <link rel="stylesheet" href="./assets/chosen/chosen.css">
    <title>Emma Auto Multi Services Company</title>


</head>

<body>

    <!-- Search Product start -->
    <div class="search-product mt-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4" onclick="redirectToProduct()">
                    <label for="">Product Name</label>
                    <select class="form-control chosen" onchange="selectProduct(this.value)" id="product_name">
                        <option>Select a Product Name </option>
                        <?php

                        while ($row = mysqli_fetch_array($search_product)) { ?>
                            <option value="<?php echo $row['product_name'] ?>">
                                <?php echo ($row['product_name']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-12 col-md-4" id="modelDiv" onclick="redirectToProduct()">
                    <label for="">Model</label>
                    <select class="form-control chosen">
                        <option selected>Select Model</option>
                    </select>
                </div>
                <div class="col-sm-12 col-md-4" id="brandDiv" onclick="redirectToProduct()">
                    <label for="">Brand</label>
                    <select class="form-control chosen">
                        <option selected>Select Brand</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/ajax/search_product.js"></script>

    <script src="./assets/chosen/chosen.js"></script>
    <script>
        $(".chosen").chosen();
    </script>
    <script>
        function selectProduct(value) {
            $(document).ready(function () {
                var product_name = value;

                if (product_name !== "Select a Product Name") {
                    // Show overlay
                    $("#productOverlay").fadeIn();

                    // Append product to the overlay if not already added
                    if ($("#selectedProducts").find(`div[data-product='${product_name}']`).length === 0) {
                        $("#selectedProducts").append(`
                    <div class="d-flex justify-content-between align-items-center my-2" data-product="${product_name}">
                        <span>${product_name}</span>
                        <button class="btn btn-sm btn-outline-danger" onclick="removeProduct('${product_name}')">×</button>
                    </div>
                `);
                    }

                    // Fetch models based on selected product
                    var ajaxUrl = window.location.href.includes("/pages")
                        ? "../ajax/products/model"
                        : "./ajax/products/model";

                    $.ajax({
                        url: ajaxUrl,
                        method: "POST",
                        data: { product_name: product_name },
                        success: function (data) {
                            $("#modelDiv").html(data);
                        }
                    });
                }
            });
        }


        function selectModel(value1, value2) {
            $(document).ready(function () {
                var model = value1;
                var product_name = value2;
                if (model && product_name != "") {
                    var ajaxUrl = window.location.href.includes("/pages")
                        ? "../ajax/products/brand"
                        : "./ajax/products/brand";
                    $.ajax({
                        url: ajaxUrl,
                        method: "POST",
                        data: {
                            model: model,
                            product_name: product_name
                        },
                        success: function (data) {
                            $("#brandDiv").html(data);
                        }
                    });
                } else {
                    $("#brandDiv").css("display", "none");
                }
            });
        }

        //JQuery Ajax for Manufacturer
        function findProduct(value1, value2, value3) {
            $(document).ready(function () {
                var brand = value1;
                var model = value2;
                var product_name = value3;
                if (brand && model && product_name != "") {
                    var ajaxUrl = window.location.href.includes("/pages")
                        ? "../ajax/products/product_results"
                        : "./ajax/products/product_results";
                    $.ajax({
                        url: ajaxUrl,
                        method: "POST",
                        data: {
                            brand: brand,
                            model: model,
                            product_name: product_name
                        },
                        success: function (data) {
                            $("#rPriceQty").html(data);
                        }
                    });
                } else {
                    $("#rPriceQty").css("display", "none");
                }
            });

        }
    </script>
</body>

</html>