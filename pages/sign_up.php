<?php
session_start();
include "../autoload/loader.php";
new CSRF();

$ctr = new AuthController();
$ctr->signUp();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emma Auto Multi Company</title>
    <link rel="icon" href="../assets/images/logo/logo.jpg" type="image/gif" sizes="20x20">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/nav-desktop.css">
    <link rel="stylesheet" href="../assets/css/nav-mobile.css">
    <link rel="stylesheet" href="../assets/css/slider.css">
    <link rel="stylesheet" href="../assets/css/category-destop.css">
</head>

<body>
    <!-- header -->
    <?php
    include '../includes/header.php';
    ?>
    <div class="container">
        <div class="offset-md-3 col-md-6 col-sm-12">
            <h1 class="text-center">Sign Up</h1>
            <div class="p-4" style="background-color: #c9cfd8; border-radius: 10px;">
                <form action="" method="post">
                    <!-- CSRF Token -->
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div class="form-group pb-3">
                        <label for="title">Title</label>
                         <div class="text-danger fw-bold"><?php echo $ctr->titleErr;?></div>
                        <select class="form-control" name="title" id="title" required>
                            <?php Form::oldSelect('title');?>
                            <option value="">Select an Option</option>
                            <option value="MR">MR</option>
                            <option value="MRS">MRS</option>
                        </select>
                       
                    </div>
                    <div class="form-group pb-3">
                        <label for="name">Name</label>
                        <div class="text-danger fw-bold"><?php echo $ctr->nameErr;?></div>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name" value="<?php Form::oldValue('name');?>">
                    </div>
                    <div class="form-group pb-3">
                        <label for="phone_number">Phone Number</label>
                        <div class="text-danger fw-bold"><?php echo $ctr->phone_numberErr;?></div>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                            placeholder="Enter Your Phone Number"  value="<?php Form::oldValue('phone_number');?>">
                    </div>
                    <div class="form-group pb-3">
                        <label for="password">Password</label>
                        <div class="text-danger fw-bold"><?php echo $ctr->passwordErr;?></div>
                        <div class="text-danger fw-bold"><?php echo $ctr->passwordLenErr;?></div>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter Your password"  value="<?php Form::oldValue('password');?>">
                    </div>
                    <div class="form-group pb-3">
                        <label for="password">Confrim Password</label>
                        <div class="text-danger fw-bold"><?php echo $ctr->confirm_passwordErr;?></div>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                            placeholder="Enter Your Confrim password"  value="<?php Form::oldValue('confirm_password');?>">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="sign_up" value="Sign Up">
                        <!-- <a href="sign_in" class="float-end text-dark">Sign In</a> -->
                        <span class="float-end text-dark">Already have an account? <a href="sign_in">Sign In</a></span>
                    </div>
                </form>
            </div>

        </div>

    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/nav-mobile.js"></script>

</body>

</html>