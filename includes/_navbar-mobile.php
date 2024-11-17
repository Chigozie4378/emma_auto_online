<!-- Mobile Navigation -->
<div class="mobile-nav d-flex d-md-none">
    <a href="#" class="text-danger"><i class="fas fa-lock"></i> Sign In</a>
    <h1 class="h3 text-white">Emma Auto</h1>
    <div class="cart-badge">
        <a href="#" class="text-white">
            <i class="fas fa-shopping-cart"></i>
            <span class="badge">1</span>
        </a>
    </div>
</div>
<div class="mobile-nav d-flex d-md-none bg-dark p-2">
    <button class="btn btn-outline-light" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    <input type="text" class="form-control search-input" placeholder="Search products...">
    <button class="btn btn-outline-light">
        <i class="fas fa-search"></i>
    </button>
</div>

<!-- Full-Screen Sidebar with Dropdowns for Mobile -->
<!-- Mobile Sidebar Updated with Dynamic Arrows -->
<div id="mobileSidebar" class="mobile-sidebar">
    <button onclick="toggleSidebar()" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"></button>
    <h5>Shop By</h5>
    <!-- Example Category with Dynamic Arrow -->
    <div>
        <a href="#" class="category-toggle" data-bs-toggle="collapse" data-bs-target="#collapseGeneralPartsMobile" aria-expanded="false">
            General Parts <i class="fas fa-chevron-down arrow"></i>
        </a>
        <div id="collapseGeneralPartsMobile" class="collapse">
            <a href="#" class="ms-3">Brakes</a>
            <a href="#" class="ms-3">Suspension</a>
            <a href="#" class="ms-3">Lights</a>
        </div>
    </div>
    <!-- Additional categories should be similarly structured -->
    <!-- Accessories Category -->
    <div>
        <a href="#" class="category-toggle" data-bs-toggle="collapse" data-bs-target="#collapseAccessoriesMobile" aria-expanded="false">
            Accessories <i class="fas fa-chevron-down arrow"></i>
        </a>
        <div id="collapseAccessoriesMobile" class="collapse">
            <a href="#" class="ms-3">Helmets</a>
            <a href="#" class="ms-3">Gloves</a>
            <a href="#" class="ms-3">Jackets</a>
        </div>
    </div>
    <!-- Maintenance Category -->
    <div>
        <a href="#" class="category-toggle" data-bs-toggle="collapse" data-bs-target="#collapseMaintenanceMobile" aria-expanded="false">
            Maintenance <i class="fas fa-chevron-down arrow"></i>
        </a>
        <div id="collapseMaintenanceMobile" class="collapse">
            <a href="#" class="ms-3">Oil</a>
            <a href="#" class="ms-3">Filters</a>
            <a href="#" class="ms-3">Cleaning Supplies</a>
        </div>
    </div>
    <!-- Wheels & Tyres Category -->
    <div>
        <a href="#" class="category-toggle" data-bs-toggle="collapse" data-bs-target="#collapseWheelsTyresMobile" aria-expanded="false">
            Wheels & Tyres <i class="fas fa-chevron-down arrow"></i>
        </a>
        <div id="collapseWheelsTyresMobile" class="collapse">
            <a href="#" class="ms-3">Tyres</a>
            <a href="#" class="ms-3">Rims</a>
            <a href="#" class="ms-3">Wheel Covers</a>
        </div>
    </div>
</div>
