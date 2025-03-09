<?php
function isActive($page)
{
    return (strpos($_SERVER['REQUEST_URI'], $page) !== false) ? 'active' : '';
}
?>

<!-- Desktop Top Bar -->
<div class="top-bar d-none d-lg-block">
    <div class="container d-flex justify-content-between">
        <div>
            <i class="fas fa-phone-alt"></i> Call us between 8 AM - 8 PM / <strong>+234111122223</strong>

            <a href="#">Click to discover <strong>Locations</strong></a>
        </div>
        <div>
            <?php
            $sign_in = true;
            if ($sign_in) {
                echo '
                            <a href="#"><i class="fas fa-user"></i> User</a>
                        ';
            } else {
                echo '
                        <a  href="#"><i class="fas fa-sign-out"></i> Sign In</a>
                    ';
            }
            ?>
        </div>
    </div>
</div>

<!-- Desktop Main Navigation -->
<nav class="main-nav d-none d-lg-block sticky-top">
    <div class="container d-flex align-items-center">
        <!-- Logo -->
        <a href="#"><img src="https://via.placeholder.com/120x40?text=MOBEX" alt="Logo"></a>

        <!-- Centered and Wider Search Bar -->
        <div class="flex-grow-1 d-flex justify-content-center">
            <div class="search-container">
                <div class="search-bar d-flex align-items-center bg-white rounded overflow-hidden border">
                    <button class="btn btn-outline-secondary px-3" type="button"><i class="fas fa-filter"></i></button>
                    <input type="text" class="form-control border-0 search-input" placeholder="Search products..."
                        id="desktopSearch">
                    <button class="btn btn-primary px-3" type="button" id="desktopSearchButton"><i
                            class="fas fa-search"></i></button>
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
                <li class="nav-item flex-grow-1 text-center"><a class="nav-link  <?= isActive('home') ?>"
                        href="./home">Home</a></li>
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
<div class="d-lg-none bg-white border-bottom p-2  sticky-top">
    <div class="container">
        <div class="mobile-search-container">
            <div class="input-group">
                <button class="btn btn-primary" type="button"><i class="fas fa-filter"></i></button>
                <input type="text" class="form-control search-input" placeholder="Search products..." id="mobileSearch">
                <button class="btn btn-primary" type="button" id="mobileSearchButton"><i
                        class="fas fa-search"></i></button>
            </div>

            <div class="search-results" id="mobileResults"></div>
        </div>
    </div>
</div>
<!-- Floating Cart Icon for Mobile -->
<div class="floating-cart d-lg-none">
    <a href="cart.php">
        <i class="fas fa-shopping-cart"></i>
        <span class="badge rounded-pill bg-danger">5</span>
    </a>
</div>