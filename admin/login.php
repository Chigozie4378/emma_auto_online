<?php
include "../autoload/loader.php";
new CSRF();
$ctr = new AuthController();
$ctr->adminsignIn();
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
    
</head>

<body>
    <div class="container">
        <div class="offset-md-3 col-md-6 col-sm-12 p-2">
            <h1 class="text-center">Sign In</h1>
            <div class="p-4 " style="background-color: #c9cfd8; border-radius: 10px;">
                
                <div class="text-danger fw-bold"><?php echo $ctr->signInErr;?></div>
                <form action="" method="post">
                    <!-- CSRF Token -->
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div class="form-group pb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Enter Your Username" value="<?php Form::oldValue('username');?>">
                    </div>
                    <div class="form-group pb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter Your password" value="<?php Form::oldValue('password');?>">
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-primary" name="sign_in" value="Sign In">
                     </div>
                </form>
            </div>

        </div>

    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    

</body>

</html>