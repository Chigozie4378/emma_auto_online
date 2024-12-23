<!-- Mobile Navigation -->
<div class="sticky-top">
    <div class="mobile-nav d-flex d-md-none">
        <button class="btn btn-outline-light mb-2" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="h3 text-white">Emma Auto</h1>
        <a href="#" class="text-danger"><i class="fas fa-lock"></i> Sign In</a>

        <div class="cart-badge">
            <a href="#" class="text-white">
                <i class="fas fa-shopping-cart"></i>
                <span class="badge">1</span>
            </a>
        </div>
    </div>
    <div class="mobile-nav d-flex d-md-none bg-dark p-2 flex-column gap-2">

        <input type="text" class="form-control search-input mb-2" placeholder="Search Product ...">
        <input type="text" class="form-control search-input mb-2" placeholder="Search Model ...">
        <input type="text" class="form-control search-input" placeholder="Search Brand ...">
    </div>

    <!-- Full-Screen Sidebar with Dropdowns for Mobile -->
    <!-- Mobile Sidebar Updated with Dynamic Arrows -->
    <div id="mobileSidebar" class="mobile-sidebar">
        <button onclick="toggleSidebar()" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"></button>
        <h5>Menu</h5>
        <!-- Example Category with Dynamic Arrow -->
        <!-- <div>
        <a href="#" class="category-toggle" data-bs-toggle="collapse" data-bs-target="#collapseGeneralPartsMobile" aria-expanded="false">
            General Parts <i class="fas fa-chevron-down arrow"></i>
        </a>
        <div id="collapseGeneralPartsMobile" class="collapse">
            <a href="#" class="ms-3">Brakes</a>
            <a href="#" class="ms-3">Suspension</a>
            <a href="#" class="ms-3">Lights</a>
        </div>
    </div> -->
        <!-- Additional categories should be similarly structured -->
        <!-- Accessories Category -->
        <div>
            <a href="#">
                Home
            </a>
            <a href="#">
                About
            </a>
            <a href="#">
                Services
            </a>
            <a href="#">
                Gallery
            </a>
            <a href="#">
                Contacts
            </a>
        </div>

    </div>
</div>