<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobex Navbar Clone</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .collapse .list-unstyled a,
        .dropdown-menu .dropdown-item,
        .navbar-nav .nav-link {
            text-decoration: none !important;
        }

        body {
            font-family: 'Poppins', Arial, sans-serif;
        }

        /* Desktop Navigation */
        .top-bar {
            background-color: #003366;
            color: white;
            font-size: 14px;
            padding: 8px 0;
        }

        .top-bar a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
        }

        .top-bar a:hover {
            text-decoration: underline;
        }

        .main-nav {
            background-color: #003366;
            padding: 10px 0;
        }

        .search-bar {
            max-width: 600px;
            width: 100%;
        }

        .search-bar input {
            border: none;
            padding: 10px;
        }

        .search-bar select {
            border: none;
            padding: 10px;
        }

        .search-bar button {
            background-color: #375bf7;
            color: white;
            border: none;
            padding: 10px 15px;
        }

        /* Search Results Box */
        .search-results {
            display: none;
            position: absolute;
            background: white;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .search-results a {
            display: block;
            padding: 8px 12px;
            color: black;
            text-decoration: none;
            border-bottom: 1px solid #eee;
        }

        .search-results a:hover {
            background-color: #f8f9fa;
        }

        .search-container {
            position: relative;
        }

        /* Mobile Search Results */
        .mobile-search-container {
            position: relative;
        }

        .cart-section i {
            font-size: 20px;
            margin-right: 10px;
            color: white;
        }

        .navbar .nav-link {
            color: black;
            font-weight: 600;
        }

        /* Make all navbar icons white */
        .navbar i,
        .main-nav i,
        .cart-section i,
        .top-bar i {
            color: white !important;
        }

        /* Make the navbar toggler icon white */
        .navbar-toggler {
            border-color: white !important;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E") !important;
        }



        .navbar {
            background: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav .nav-link {
            font-weight: 600;
            color: #333;
            padding: 10px 15px;
            transition: all 0.3s ease-in-out;
        }

        .navbar-nav .nav-link:hover {
            color: #375bf7;
        }

        .navbar-nav .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
            animation: fadeIn 0.3s ease-in-out;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            transition: all 0.3s ease-in-out;
        }

        .dropdown-item:hover {
            background-color: #375bf7;
            ;
            color: white;
        }

        /* Active link styles for mobile and desktop */
        .navbar-nav .nav-link.active,
        .collapse .list-unstyled a.active {
            border-bottom: 4px solid #375bf7 !important;
            color: #375bf7 !important;
        }

        @media (min-width: 992px) {
            .main-nav .search-container {
                width: 50%;
            }
        }

        /* Mobile Navigation */
        @media (max-width: 991px) {
            .top-bar {
                display: none;
            }


            .navbar-nav .nav-link {
                padding: 10px;
                text-decoration: none !important;
                /* Remove default underline */
            }

            /* Add a thick blue underline for active menu item */
            .navbar-nav .nav-link.active,
            .navbar-nav .nav-link:focus {
                border-bottom: 4px solid #375bf7 !important;
                color: #375bf7 !important;
            }

            /* Ensure dropdown items also get highlighted */
            .dropdown-menu .dropdown-item.active {
                border-bottom: 4px solid #375bf7 !important;
                color: #375bf7 !important;
            }

            .collapse .list-unstyled a {
                text-decoration: none !important;
            }

            .dropdown-menu .dropdown-item {
                text-decoration: none !important;
            }
        }


        /* Keyframes for smooth dropdown animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <!-- Desktop Top Bar -->
    <div class="top-bar d-none d-lg-block">
        <div class="container d-flex justify-content-between">
            <div>
                <i class="fas fa-phone-alt"></i> Call us between 8 AM - 8 PM / <strong>+234111122223</strong>

                <a href="#">Click to discover <strong>Locations</strong></a>
            </div>
            <div>

                <a href="#"><i class="fas fa-user"></i> Login</a>
            </div>
        </div>
    </div>

    <!-- Desktop Main Navigation -->
    <nav class="main-nav d-none d-lg-block">
        <div class="container d-flex align-items-center">
            <!-- Logo -->
            <a href="#"><img src="https://via.placeholder.com/120x40?text=MOBEX" alt="Logo"></a>

            <!-- Centered and Wider Search Bar -->
            <div class="flex-grow-1 d-flex justify-content-center">
                <div class="search-container">
                    <div class="search-bar d-flex align-items-center bg-white rounded overflow-hidden border">
                        <button class="btn btn-outline-secondary px-3" type="button"><i
                                class="fas fa-filter"></i></button>
                        <input type="text" class="form-control border-0 search-input" placeholder="Search products..."
                            id="desktopSearch">
                        <button class="btn btn-primary px-3" type="button"><i class="fas fa-search"></i></button>
                    </div>
                    <div class="search-results" id="desktopResults"></div>
                </div>
            </div>

            <!-- Cart and Wishlist -->
            <div class="cart-section d-flex align-items-center text-white">
                <i class="fas fa-exchange-alt"></i>
                <i class="fas fa-heart"></i>
                <i class="fas fa-shopping-cart"></i> Cart (0 items)
            </div>
        </div>
    </nav>


    <!-- Desktop Bottom Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm d-none d-lg-block">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100 d-flex justify-content-between">
                    <li class="nav-item flex-grow-1 text-center"><a class="nav-link active" href="./test">Home</a></li>
                    <li class="nav-item flex-grow-1 text-center"><a class="nav-link" href="#">About</a></li>

                    <!-- Shop by Brand - Horizontal Dropdown -->
                    <li class="nav-item dropdown flex-grow-1 text-center">
                        <a class="nav-link dropdown-toggle" href="#" id="brandDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Shop by Brand</a>
                        <ul class="dropdown-menu w-100" aria-labelledby="brandDropdown">
                            <div class="d-flex flex-wrap">
                                <li><a class="dropdown-item" href="#">Brand 1</a></li>
                                <li><a class="dropdown-item" href="#">Brand 2</a></li>
                                <li><a class="dropdown-item" href="#">Brand 3</a></li>
                                <li><a class="dropdown-item" href="#">Brand 4</a></li>
                            </div>
                        </ul>
                    </li>

                    <!-- Shop by Model - Horizontal Dropdown -->
                    <li class="nav-item dropdown flex-grow-1 text-center">
                        <a class="nav-link dropdown-toggle" href="#" id="modelDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Shop by Model</a>
                        <ul class="dropdown-menu w-100" aria-labelledby="modelDropdown">
                            <div class="d-flex flex-wrap">
                                <li><a class="dropdown-item" href="#">Model 1</a></li>
                                <li><a class="dropdown-item" href="#">Model 2</a></li>
                                <li><a class="dropdown-item" href="#">Model 3</a></li>
                                <li><a class="dropdown-item" href="#">Model 4</a></li>
                            </div>
                        </ul>
                    </li>

                    <li class="nav-item flex-grow-1 text-center"><a class="nav-link" href="#">Shop</a></li>
                    <li class="nav-item flex-grow-1 text-center"><a class="nav-link" href="#">Contacts</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile Navigation with Normal Dropdown -->
    <nav class="main-nav d-lg-none">
        <div class="container d-flex align-items-center justify-content-between">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="#"><img src="https://via.placeholder.com/120x40?text=Logo" alt="Logo"></a>
            <a href="#" class="text-dark position-relative">
                <i class="fas fa-shopping-cart"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">5</span>
            </a>
        </div>
    </nav>

    <!-- Collapsible Mobile Menu -->
    <div class="collapse" id="mobileNavbar">
        <div class="bg-white p-3">
            <ul class="list-unstyled">
                <li><a href="./test" class="text-dark d-block py-2 active">Home</a></li>
                <li><a href="#" class="text-dark d-block py-2">About</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle text-dark d-block py-2" data-bs-toggle="dropdown" href="#">Shop by
                        Brand</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Brand 1</a></li>
                        <li><a class="dropdown-item" href="#">Brand 2</a></li>
                        <li><a class="dropdown-item" href="#">Brand 3</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle text-dark d-block py-2" data-bs-toggle="dropdown" href="#">Shop by
                        Model</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Model 1</a></li>
                        <li><a class="dropdown-item" href="#">Model 2</a></li>
                        <li><a class="dropdown-item" href="#">Model 3</a></li>
                    </ul>
                </li>
                <li><a href="#" class="text-dark d-block py-2">Shop</a></li>
                <li><a href="#" class="text-dark d-block py-2">Contacts</a></li>
            </ul>
        </div>
    </div>


    <!-- Mobile Search Bar -->
    <div class="d-lg-none bg-white border-bottom p-2">
        <div class="container">
            <div class="mobile-search-container">
                <div class="input-group">
                    <button class="btn btn-primary" type="button"><i class="fas fa-filter"></i></button>
                    <input type="text" class="form-control search-input" placeholder="Search products..."
                        id="mobileSearch">
                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
                <div class="search-results" id="mobileResults"></div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".collapse .list-unstyled a, .dropdown-menu .dropdown-item, .navbar-nav .nav-link")
                .forEach(el => el.style.textDecoration = "none");
        });

    </script>
    <script>
        
        document.addEventListener("DOMContentLoaded", function () {
            function showSearchResults(inputId, resultsId) {
                const input = document.getElementById(inputId);
                const resultsBox = document.getElementById(resultsId);

                input.addEventListener("input", function () {
                    let query = this.value.trim();
                    if (query.length === 0) {
                        resultsBox.style.display = "none";
                        return;
                    }

                    // Fetch search results from PHP
                    fetch(`./ajax/products/fetch_search.php?query=${query}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.length > 0) {
                                resultsBox.innerHTML = data.map(item => `<a href="#">${item}</a>`).join("");
                                resultsBox.style.display = "block";
                            } else {
                                resultsBox.style.display = "none";
                            }
                        })
                        .catch(error => console.error("Error fetching search results:", error));
                });

                // Hide results when clicking outside
                document.addEventListener("click", function (event) {
                    if (!input.contains(event.target) && !resultsBox.contains(event.target)) {
                        resultsBox.style.display = "none";
                    }
                });
            }

            showSearchResults("desktopSearch", "desktopResults");
            showSearchResults("mobileSearch", "mobileResults");
        });

    </script>


</body>

</html>