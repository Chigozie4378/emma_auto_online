<?php
include "./autoload/loader.php";
$ctr = new ProductsController();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emma Auto Multi Company</title>
    <link rel="icon" href="./assets/images/logo/logo.jpg" type="image/gif" sizes="20x20">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/nav-desktop.css">
    <link rel="stylesheet" href="./assets/css/nav-mobile.css">
    <link rel="stylesheet" href="./assets/css/slider.css">
    <link rel="stylesheet" href="./assets/chosen/chosen.css">
    

<body>
    <!-- header -->
     <?php 
       include './includes/_header.php';
       include './includes/_navbar-desktop.php';
       include './includes/_navbar-mobile.php';
     include './includes/search.php';
     ?>


    

    <!-- Promotions Section -->
    <section class="container my-5">
        <div class="row">
            <div class="col-sm-12 col-md-4 pb-1">
                <div class="card text-white bg-dark">
                    <img src="batters/" class="card-img-top" alt="Battery">
                    <div class="card-body">
                        <h5 class="card-title">Find Your New Motorcycle Battery</h5>
                        <p class="card-text">Gel, AGM, or VRLA. Find yours with the motorcycle parts finder.</p>
                        <a href="#" class="btn btn-danger">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4  pb-1">
                <div class="card text-white bg-dark">
                    <img src="racs/" class="card-img-top" alt="Race Dept">
                    <div class="card-body">
                        <h5 class="card-title">Check Out MPW Race Dept!</h5>
                        <p class="card-text">If you're getting ready to race, we have products for you!</p>
                        <a href="#" class="btn btn-danger">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="card text-white bg-dark">
                    <img src="cafe-races/" class="card-img-top" alt="Cafe Racer">
                    <div class="card-body">
                        <h5 class="card-title">Building a Cafe Racer Motorcycle?</h5>
                        <p class="card-text">Custom motorcycle fuel tanks, handlebars and headlights.</p>
                        <a href="#" class="btn btn-danger">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="container my-5">
        <h4>Excellent</h4>
        <p>Based on 7,889 reviews</p>
        <div class="row">
            <div class="col-md-4">
                <div class="border p-3">
                    <p><strong>Another quick delivery</strong></p>
                    <p>Another quick delivery. Brilliant service yet again - Steve Morgan</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="border p-3">
                    <p><strong>Had everything I wanted</strong></p>
                    <p>Had everything I wanted. Quickly delivered and well packaged. - Sarah Lovelady</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="border p-3">
                    <p><strong>Fast delivery and the correct part</strong></p>
                    <p>Fast delivery and the correct part at a reasonable price. - Wayne Du Feu</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Carousel Container -->
    <div class="container my-5">
        <div id="imageCarousel" class="carousel slide" data-bs-interval="2000" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <!-- Each column will hold a single image -->
                        <div class="col-lg-2 col-md-4 col-12">
                            <img src="image1.jpg" class="d-block w-100" alt="Image 1">
                        </div>
                        <div class="col-lg-2 col-md-4 col-12">
                            <img src="image2.jpg" class="d-block w-100" alt="Image 2">
                        </div>
                        <div class="col-lg-2 col-md-4 col-12">
                            <img src="image3.jpg" class="d-block w-100" alt="Image 3">
                        </div>
                        <div class="col-lg-2 col-md-4 col-12">
                            <img src="image4.jpg" class="d-block w-100" alt="Image 4">
                        </div>
                        <div class="col-lg-2 col-md-4 col-12">
                            <img src="image5.jpg" class="d-block w-100" alt="Image 5">
                        </div>
                        <div class="col-lg-2 col-md-4 col-12">
                            <img src="image6.jpg" class="d-block w-100" alt="Image 6">
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-lg-2 col-md-4 col-12">
                            <img src="image7.jpg" class="d-block w-100" alt="Image 7">
                        </div>
                        <div class="col-lg-2 col-md-4 col-12">
                            <img src="image8.jpg" class="d-block w-100" alt="Image 8">
                        </div>
                        <div class="col-lg-2 col-md-4 col-12">
                            <img src="image9.jpg" class="d-block w-100" alt="Image 9">
                        </div>
                        <div class="col-lg-2 col-md-4 col-12">
                            <img src="image10.jpg" class="d-block w-100" alt="Image 10">
                        </div>
                        <div class="col-lg-2 col-md-4 col-12">
                            <img src="image11.jpg" class="d-block w-100" alt="Image 11">
                        </div>
                        <div class="col-lg-2 col-md-4 col-12">
                            <img src="image12.jpg" class="d-block w-100" alt="Image 12">
                        </div>
                    </div>
                </div>

            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/nav-mobile.js"></script>
    <script src="./assets/js/slider.js"></script>
    <script src="./assets/chosen/chosen.js"></script>
    <script>
  $(".chosen").chosen();
</script>

</body>

</html>