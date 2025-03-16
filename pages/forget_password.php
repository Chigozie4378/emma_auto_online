<?php
include "../autoload/loader.php";
$ctr = new AuthController();
$ctr->forgotPassword();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password | Emma Auto Multi Company</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/auth.css">
</head>

<body>
  <div class="auth-container">
    <h3 class="text-center">Forgot Password</h3>
    <div class="text-center" style="color: red; font-weight: 400;"><?php echo $ctr->forgetPasswordErr ?></div>
    <form method="post">
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['token']; ?>">
      <div class="mb-3">
        <label class="form-label">Enter Phone Number or Email</label>
        <input type="text" class="form-control" name="identifier" required>
      </div>
      <button type="submit" class="btn btn-warning w-100">Send OTP</button>
    </form>
    <div class="text-center mt-5">
      <hr>
      <a href="home" style="text-decoration: none; color: white;">Back to Home</a>
    </div>
  </div>
</body>

</html>