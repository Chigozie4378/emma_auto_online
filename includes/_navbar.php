<?php
function isActive($page)
{
    return (strpos($_SERVER['REQUEST_URI'], $page) !== false) ? 'active' : '';
}
?>


<?php
include_once "../autoload/loader.php";
$ctr = new ProductsController();
$unit = new UnitsController();
$search_product = $ctr->searchProducts();
?>
<?php
$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
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
            if (isset($_SESSION['user_id'])) {
                echo '
    <div class="dropdown">
        <a href="#" class="dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user"></i> ' . $_SESSION["name"] . '
        </a>
        <ul class="dropdown-menu" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="account">Account</a></li>
            <li><a class="dropdown-item" href="orders">Orders</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="sign_out">Sign Out</a></li>
        </ul>
    </div>';
            } else {
                echo '
    <a href="sign_in"><i class="fas fa-sign-in"></i> Sign In</a>
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
        <a href="home"><img style="object-fit: contain; height: 40px; width: 40px;" class="rounded"
                src="../assets/images/logo/logo.jpg" alt="Emma Auto"></a>

        <!-- Centered and Wider Search Bar -->
        <div class="flex-grow-1 d-flex justify-content-center">
            <div class="search-container">
                <div class="search-bar d-flex align-items-center bg-white rounded overflow-hidden border">
                    <button id="desktopFilterButton" class="btn btn-outline-secondary px-3" type="button"><i
                            class="fas fa-filter"></i></button>
                    <input type="text" class="form-control border-0 search-input" placeholder="Search products..."
                        id="desktopSearch">
                    <button class="btn btn-primary px-3" type="button" id="desktopSearchButton"><i
                            class="fas fa-search"></i></button>
                </div>

                <div class="search-results" id="desktopResults"></div>
            </div>
        </div>

        <!-- Cart and Wishlist -->
        <?php if ($_SERVER['REQUEST_URI'] !== '/emma_auto_online/pages/cart'): ?>
            <div class="cart-section d-flex align-items-center text-white">
                <i class="fas fa-exchange-alt"></i>
                <i class="fas fa-heart"></i>
                <a href="cart">
                    <i class="fas fa-shopping-cart"></i> Cart (<span class="cart-count"><?= $cartCount ?></span> items)
                </a>
            </div>
        <?php endif; ?>

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
                            <?php
                            $brands = $unit->showAllManufacturer();
                            foreach ($brands as $brand) {
                                echo '<li><a class="dropdown-item" href="p_menu?pmenu=' . htmlspecialchars($brand["name"]) . '">' . htmlspecialchars($brand["name"]) . '</a></li>';
                            }
                            ?>
                        </div>
                    </ul>
                </li>

                <!-- Shop by Model - Horizontal Dropdown -->
                <li class="nav-item dropdown flex-grow-1 text-center">
                    <a class="nav-link dropdown-toggle" href="#" id="modelDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">Shop by Model</a>
                    <ul class="dropdown-menu w-100" aria-labelledby="modelDropdown">
                        <div class="d-flex flex-wrap">
                            <?php
                            $models = $unit->showAllModel();
                            foreach ($models as $model) {
                                echo '<li><a class="dropdown-item" href="p_menu?pmenu=' . htmlspecialchars($model["name"]) . '">' . htmlspecialchars($model["name"]) . '</a></li>';
                            }
                            ?>
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

        <a href="home"><img style="object-fit: contain; height: 40px; width: 40px;" class="rounded"
                src="../assets/images/logo/logo.jpg" alt="Emma Auto"></a>

        <!-- User Icon with Dropdown for Logged-in Users -->
        <div class="dropdown">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a style="text-decoration: none; color: white;" href="#" class="dropdown-toggle" id="mobileUserDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i> <?php echo "  " . $_SESSION['name'] ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="mobileUserDropdown">
                    <li><a class="dropdown-item" href="account">Account</a></li>
                    <li><a class="dropdown-item" href="orders">Orders</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-danger" href="sign_out">Sign Out</a></li>
                </ul>
            <?php else: ?>
                <i class="fa fa-sign-in"></i><a style="text-decoration: none; color: white;" href="sign_in"> Sign In</a>
            <?php endif; ?>
        </div>

        <?php if ($_SERVER['REQUEST_URI'] === '/emma_auto_online/pages/cart'): ?>
            <a href="javascript:history.back()" style="text-decoration: none;" class="text-light">
                <i class="fas fa-arrow-left"></i> Go Back
            </a>
        <?php else: ?>
            <a href="cart" class="text-dark position-relative">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="mobile-cart-count"><?= $cartCount ?></span>
            </a>
        <?php endif; ?>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
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
                <ul class="dropdown-menu w-100 p-3">
                    <div class="row">
                        <?php
                        foreach ($brands as $brand) {
                            echo '<div class="col-4"><a class="dropdown-item" href="p_menu?pmenu=' . htmlspecialchars($brand["name"]) . '">' . htmlspecialchars($brand["name"]) . '</a></div>';
                        }
                        ?>
                    </div>
                </ul>

            </li>
            <li class="dropdown">
                <a class="dropdown-toggle text-dark d-block py-2" data-bs-toggle="dropdown" href="#">Shop by
                    Model</a>
                    <ul class="dropdown-menu w-100 p-3">
                    <div class="row">
                        <?php
                        foreach ($models as $model) {
                            echo '<div class="col-4"><a class="dropdown-item" href="p_menu?pmenu=' . htmlspecialchars($model["name"]) . '">' . htmlspecialchars($model["name"]) . '</a></div>';
                        }
                        ?>
                    </div>
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
                <button id="mobileFilterButton" class="btn btn-primary" type="button"><i
                        class="fas fa-filter"></i></button>
                <input type="text" class="form-control search-input" placeholder="Search products..." id="mobileSearch">
                <button class="btn btn-primary" type="button" id="mobileSearchButton"><i
                        class="fas fa-search"></i></button>
            </div>

            <div class="search-results" id="mobileResults"></div>
        </div>
    </div>
</div>

<!-- Floating Cart Icon for Mobile -->
<?php if ($_SERVER['REQUEST_URI'] !== '/emma_auto_online/pages/cart'): ?>
    <div class="floating-cart d-lg-none">
        <a href="cart">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count badge rounded-pill bg-danger" id="mobile-cart-count"><?= $cartCount ?></span>
        </a>
    </div>
<?php endif; ?>



<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Product Dropdown -->
                <div class="mb-3">
                    <label for="productSelect" class="form-label">Product Name</label>
                    <select id="productSelect" class="form-control chosen">
                        <option value="">Select a Product Name</option>
                        <?php
                        // Populate options from your query (adjust as needed)
                        while ($row = mysqli_fetch_array($search_product)) { ?>
                            <option value="<?php echo $row['product_name']; ?>">
                                <?php echo $row['product_name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <!-- Model Dropdown -->
                <div class="mb-3">
                    <label for="modelSelect" class="form-label">Model</label>
                    <select id="modelSelect" class="form-control chosen">
                        <option value="">Select a Model</option>
                    </select>
                </div>
                <!-- Manufacturer/Brand Dropdown -->
                <div class="mb-3">
                    <label for="brandSelect" class="form-label">Brand</label>
                    <select id="brandSelect" class="form-control chosen">
                        <option value="">Select a Brand</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="filterSearchBtn" class="btn btn-primary">Search</button>
            </div>
        </div>
    </div>
</div>