<!-- Header for Desktop -->
<?php
if ($_SERVER['PHP_SELF'] == '/emma_online/index.php') { ?>
<header class="bg-dark text-white py-3 desktop-header">
    <div class="container d-flex justify-content-between align-items-center">
        
        <a href="./"><img src="./assets/images/logo/logo.jpg" height="50" width="50" alt=""></a>
        <h3>Emma Auto</h3>
        
        <div class="search-container">

            <input type="text" class="form-control" placeholder="Search products...">
            <button class="btn btn-primary">Search</button>
        </div>
        <div>
            <a href="#" class="text-white me-3">Sign In</a>
            <span class="text-white">My Cart: £93.01</span>
        </div>
    </div>
</header>
<?php } else { ?>
    <header class="bg-dark text-white py-3 desktop-header">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- <h1 class="h3">Emma Auto Multi Company</h1> -->
        <a href="../"><img src="../assets/images/logo/logo.jpg" height="50" width="50" alt=""></a>
        <h3>Emma Auto</h3>
        
        <div class="search-container">

            <input type="text" class="form-control" placeholder="Search products...">
            <button class="btn btn-primary">Search</button>
        </div>
        <div>
            <!-- <a href="#" class="text-white me-3">Sign In</a>
            <a href="#" class="text-white me-3">Create Account</a> -->


            <a href="#" class="text-white me-3">Mr Ade</a>
            <?php 
            
            ?>
            <span class="text-white">My Cart: £93.01</span>
        </div>
    </div>
</header>
<?php }
?>
