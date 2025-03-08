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
    <style>
        .carousel-inner {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .carousel-inner img {
            object-fit: contain;
            width: 100%;
            height: auto;
            /* Ensures images scale with width */
            max-height: 500px;
            /* Limit maximum height, adjust as needed */
        }

        @media (max-width: 768px) {
            .carousel-inner img {
                max-height: 300px;
                /* Adjust the height for smaller screens */
            }
        }

        @media (max-width: 480px) {
            .carousel-inner img {
                max-height: 250px;
                /* Adjust the height for extra small screens */
            }
        }

        /* Full-width overlay styling */
        .overlay {
    position: fixed;
    top: calc(100px + 2rem); /* Increase margin */
    left: 0;
    width: 100%;
    height: calc(100vh - (100px + 2rem)); /* Adjust remaining height */
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(5px);
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    display: none;
    padding: 20px;
    overflow-y: auto;
}


        /* Center content inside the overlay */
        .overlay-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
        }
    </style>

</head>

<body>
    <!-- Navigation start -->
    <?php include_once "./includes/_navbar.php"; ?>
    <!-- Navigation End -->

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
    <!-- Start Product End -->

    <!-- Full-Width Overlay Below Search Container -->
    <div id="productOverlay" class="overlay mt-5">
        <div class="overlay-content">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Selected Products</h5>
                <button class="btn btn-danger btn-sm" onclick="closeOverlay()">Close</button>
            </div>
            <hr>
            <div id="selectedProducts"></div>
        </div>
    </div>



    <!-- Slider Start -->
    <div id="demo" class="carousel slide mt-4" data-bs-ride="carousel" style="background-color: rgb(90, 138, 192);">
        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
        </div>

        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./assets/images/products/5 DOTS LIGHT STEADY.JPG" alt="Los Angeles" class="d-block w-100">
                <div class="carousel-caption">
                    <h3>Los Angeles</h3>
                    <p>We had such a great time in LA!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./assets/images/products/4 DOTS WHITE LIGHT.JPG" alt="Chicago" class="d-block w-100">
                <div class="carousel-caption">
                    <h3>Chicago</h3>
                    <p>Thank you, Chicago!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./assets/images/products/4MINUTES GUM.JPG" alt="New York" class="d-block w-100">
                <div class="carousel-caption">
                    <h3>New York</h3>
                    <p>We love the Big Apple!</p>
                </div>
            </div>
        </div>

        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="container mt-4">
        <h3 class="text-center">About Us</h3>
        <div class="row">
            <div class="col-sm-12 col-md-4 py-1">
                <img src="./assets/images/about/office.png" style="height: 300px; width:100%" alt="">
            </div>
            <div class="col-sm-12 col-md-8 py-1">
                <p>We are the distributor for Chanlin, Shiroro, Unigo, Jeely, Jieng, Endurance, Tako, Donaten, Sinosat,
                    and Sunrain Motorcycle spare parts of all brands of Motorcycles and Tricycle parts all Genuine
                    parts, such as Honda, Bajaj, TVS, Hero and all brands of Motorcycles Engine and Tricycles.</p>
            </div>
        </div>

    </div>
    <!-- Slider End -->


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
                        ? "../ajax/products/model.php"
                        : "./ajax/products/model.php";

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

        // Function to close overlay
        function closeOverlay() {
            $("#productOverlay").fadeOut();
            $("#selectedProducts").html(""); // Clear selected products
        }

        // Function to remove individual product from the list
        function removeProduct(productName) {
            $(`div[data-product='${productName}']`).remove();

            // Hide overlay if empty
            if ($("#selectedProducts").children().length === 0) {
                closeOverlay();
            }
        }


        // Function to close the overlay
        function closeOverlay() {
            $("#productOverlay").hide();
            $("#selectedProducts").html(""); // Clear selections
        }

        // Function to remove a selected product from the list
        function removeProduct(productName) {
            $(`div[data-product='${productName}']`).remove();

            // Hide overlay if no products are left
            if ($("#selectedProducts").children().length === 0) {
                $("#productOverlay").hide();
            }
        } function selectModel(value1, value2) {
            $(document).ready(function () {
                var model = value1;
                var product_name = value2;
                if (model && product_name != "") {
                    var ajaxUrl = window.location.href.includes("/pages")
                        ? "../ajax/products/brand.php"
                        : "./ajax/products/brand.php";
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
                        ? "../ajax/products/product_results.php"
                        : "./ajax/products/product_results.php";
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