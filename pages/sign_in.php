<?php
include "../autoload/loader.php";
$ctr = new AuthController();
$ctr->signIn();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In | Emma Auto Multi Company</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/auth.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="auth-container">
    <h3 class="text-center">Sign In</h3>
    <div style="color: red; font-weight: 400; text-align: center;"><?php echo $ctr->signInErr ?></div>
    <form method="post">
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['token']; ?>">
      <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <input type="text" class="form-control" name="phone_no" required
          value="<?php echo $ctr->oldValue('phone_no') ?>">
      </div>
      <div class="mb-3 password-wrapper">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="signin-password" required
          value="<?php echo $ctr->oldValue('password') ?>">
        <span class="toggle-password" onclick="togglePassword('signin-password')">
          <i class="fas fa-eye"></i>
        </span>
      </div>
      <div class="d-flex justify-content-between mb-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="remember_me" id="rememberMeSignIn">
          <label class="form-check-label" for="rememberMeSignIn">Remember Me</label>
        </div>
        <a href="forget_password">Forgot Password?</a>
      </div>
      <button type="submit" name="sign_in" class="btn btn-primary w-100">Sign In</button>
    </form>
    <div class="text-center mt-3">
      <p>Don't have an account? <a style="text-decoration: none;" href="sign_up">Sign Up</a></p>
    </div>
    <div class="text-center mt-5">
      <hr>
      <a href="home" style="text-decoration: none; color: white;">Back to Home</a>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function togglePassword(fieldId) {
      const field = document.getElementById(fieldId);
      const icon = field.nextElementSibling.querySelector('i');

      if (field.type === "password") {
        field.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        field.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    }

  </script>
</body>

</html>