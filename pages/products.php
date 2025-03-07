<?php
include_once "../autoload/loader.php";
$ctr = new ProductsController();
$search_product = $ctr->searchProducts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emma Auto Multi Services Company</title>
    <link rel="icon" href="../assets/images/logo/logo.jpg" type="image/gif" sizes="20x20">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/chosen/chosen.css">
</head>

<body>
    <!-- Navigation start -->
    <?php include_once "../includes/_navbar.php"; ?>
    <!-- Navigation End -->
    <div class="container">
        <!-- Search Product start -->
        <?php
        include "../includes/search.php";
        ?>
        <!-- Start Product End -->

        <div class="row py-3">
            <!-- Sidebar for medium to large screens -->
            <nav class="col-md-2 col-lg-2 d-none d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <h5 class="bg-primary text-center p-2 text-white">Catgories</h5>
                    <div class="accordion" id="categoryAccordion">
                        <!-- General Parts Category -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingGeneralParts">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseGeneralParts" aria-expanded="false"
                                    aria-controls="collapseGeneralParts">
                                    General Parts
                                </button>
                            </h2>
                            <div id="collapseGeneralParts" class="accordion-collapse collapse"
                                aria-labelledby="headingGeneralParts" data-bs-parent="#categoryAccordion">
                                <div class="accordion-body">
                                    <ul class="nav flex-column">
                                        <li class="nav-item"><a class="nav-link" href="#">Brakes</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Suspension</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Lights</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- New Category (Example) -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingNewCategory">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseNewCategory" aria-expanded="false"
                                    aria-controls="collapseNewCategory">
                                    New Category
                                </button>
                            </h2>
                            <div id="collapseNewCategory" class="accordion-collapse collapse"
                                aria-labelledby="headingNewCategory" data-bs-parent="#categoryAccordion">
                                <div class="accordion-body">
                                    <ul class="nav flex-column">
                                        <li class="nav-item"><a class="nav-link" href="#">Subcategory 1</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Subcategory 2</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Subcategory 3</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Repeat for more categories as needed -->
                    </div>
                    <h5 class="mt-3 px-3">Brand</h5>
                    <ul class="nav flex-column px-3">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Motorex</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Motul</a>
                        </li>
                        <!-- Add more brands here as needed -->
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
                <h1 class="mt-4">MOTORCYCLE ACCESSORIES</h1>
                <p>Motorcycle accessories are additions for your bike, your garage, or yourself by helping to make bike
                    maintenance easier...</p>
                <!-- Product grid and other content goes here -->
                <!-- Filter buttons -->
                <div class="mb-3">
                    <button class="btn btn-outline-secondary">Gifts</button>
                    <button class="btn btn-outline-secondary">Security</button>
                    <button class="btn btn-outline-secondary">Backpacks & Luggage</button>
                    <!-- Add more buttons as needed -->
                </div>

                <!-- Product grid -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="image1.jpg" class="card-img-top" alt="Product 1">
                            <div class="card-body">
                                <h5 class="card-title">25.8MM (DUCATI) REAR PADDOCK STAND PIN</h5>
                                <p class="card-text">£28.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="image2.jpg" class="card-img-top" alt="Product 2">
                            <div class="card-body">
                                <h5 class="card-title">27.4MM (TRIUMPH) REAR PADDOCK STAND PIN</h5>
                                <p class="card-text">£28.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="image3.jpg" class="card-img-top" alt="Product 3">
                            <div class="card-body">
                                <h5 class="card-title">31.0MM REAR PADDOCK STAND PIN</h5>
                                <p class="card-text text-danger">£21.16 <del>£28.00</del></p>
                            </div>
                        </div>
                    </div>
                    <!-- Add more product cards as needed -->
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                    </ul>
                </nav>
            </main>
        </div>

    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
    <script src="../assets/chosen/chosen.js"></script>
    <script>
        $(".chosen").chosen();
    </script>
    <?php include_once "../tools/search_product.php"?>

</body>

</html>