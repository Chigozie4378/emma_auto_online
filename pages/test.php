<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motorcycle Accessories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles to remove borders around accordion items */
        .accordion-item {
            border: none;
        }

        .accordion-button {
            border: none;
            background-color: transparent;
            padding-left: 0;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-button:not(.collapsed) {
            color: #000;
            background-color: transparent;
            font-weight: bold;
        }

        .accordion-body {
            padding-left: 1.5rem;
            /* Indent for subcategory items */
            border: none;
        }

        /* Full-screen sidebar styling for mobile */
        .mobile-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #333;
            color: white;
            display: none;
            /* Hidden by default */
            z-index: 1050;
            /* Above other content */
            flex-direction: column;
            align-items: flex-start;
            padding: 20px;
        }

        .mobile-sidebar a {
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            margin: 10px 0;
            width: 100%;
            display: block;
        }

        .btn-close {
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar for medium to large screens -->
            <nav class="col-md-2 col-lg-2 d-none d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <h5 class="mt-3 px-3">Shop By</h5>
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

            <!-- Mobile navigation bar for small screens -->
            <div class="mobile-nav d-flex d-md-none bg-dark p-2">
                <button class="btn btn-outline-light" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i> Menu
                </button>
                <input type="text" class="form-control search-input" placeholder="Search products...">
                <button class="btn btn-outline-light">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <!-- Full-screen mobile sidebar -->
            <div id="mobileSidebar" class="mobile-sidebar">
                <button onclick="toggleSidebar()"
                    class="btn-close btn-close-white position-absolute top-0 end-0 m-3"></button>

                <h5>Shop By</h5>
                <!-- General Parts Category in mobile sidebar -->
                <div>
                    <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseGeneralPartsMobile"
                        aria-expanded="false">General Parts</a>
                    <div id="collapseGeneralPartsMobile" class="collapse">
                        <a href="#" class="ms-3">Brakes</a>
                        <a href="#" class="ms-3">Suspension</a>
                        <a href="#" class="ms-3">Lights</a>
                    </div>
                </div>
                <!-- General Parts Category in mobile sidebar -->
                <div>
                    <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseNewCategoryMobile"
                        aria-expanded="false">New Category</a>
                    <div id="collapseNewCategoryMobile" class="collapse">
                        <a href="#" class="ms-3">Subcategory 1</a>
                        <a href="#" class="ms-3">Subcategory 2</a>
                        <a href="#" class="ms-3">Subcategory 3</a>
                    </div>
                </div>
                <!-- Repeat for more categories as needed -->

                <h5>Brand</h5>
                <div>
                    <a href="#">Motorex</a>
                    <a href="#">Motul</a>
                </div>
            </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("mobileSidebar");
            sidebar.style.display = sidebar.style.display === "flex" ? "none" : "flex";
        }
    </script>
</body>

</html>