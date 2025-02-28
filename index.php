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

    <link rel="stylesheet" href="./assets/chosen/chosen.css">
    <title>Emma Auto Investment</title>
    <style>
        /* Underline the active nav item */
        .nav-link.active {
            border-bottom: 3px solid #fff;
            /* White underline */
            font-weight: bold;
            /* Optional: Make it bold */
        }

        /* Optional: Add smooth transition */
        .nav-link {
            transition: border-bottom 0.3s ease-in-out;
        }

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
    </style>

</head>

<body>
    <!-- Navigation start -->
    <?php include_once "./includes/_navbar.php"; ?>
    <!-- Navigation End -->

    <!-- Search Product start -->
    <?php
    include_once "./includes/search.php";
    ?>
    <!-- Start Product End -->

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
    <?php include_once "./tools/search_product.php"?>
</body>

</html>