<div class="navigation">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid px-5"> <!-- Added padding to the container -->
            <!-- Brand on the left -->
            <a class="navbar-brand" href="#">
            <img src="<?php echo ($_SERVER['REQUEST_URI'] == '/emma_auto_online/' ? './assets/images/logo/logo.jpg' : '../assets/images/logo/logo.jpg'); ?>" class="rounded" height="50" width="50" alt="">
            </a>

            <!-- Navbar Toggler for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content with Padding on Desktop -->
            <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
                <!-- Centered Navigation Links -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>

                <!-- Account Section -->
                <ul class="navbar-nav">
                    <?php
                    $sign_in = true;
                    if ($sign_in) {
                        echo '
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">MR Ade</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Sign Out</a></li>
                        </ul>
                    </li>';
                    } else {
                        echo '<li class="nav-item">
                        <a class="nav-link" href="#">Sign In</a>
                    </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</div>