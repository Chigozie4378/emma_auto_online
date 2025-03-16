<?php
include "../autoload/loader.php";
$ctr = new AuthController();
if (!isset($_SESSION['reset_otp'])){
    new Redirect('home');
}
// If user clicked "resend_otp"
if (isset($_POST['resend_otp'])) {
    $ctr->resendResetOTP();
}

// If user submitted new password & OTP
$ctr->resetPassword();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password | Emma Auto Multi Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="auth-container">
        <h3 class="text-center">Reset Password</h3>
        <p class="text-center">Enter the OTP sent to your phone or email.</p>

        <!-- Show error/success -->
        <div class="text-center" style="color: red; font-weight: 400;"><?php echo $ctr->resetPasswordErr ?></div>
        <div class="text-center text-success" style="font-weight: 400;"><?php echo $ctr->resetPasswordSuccess ?></div>

        <?php if (isset($_SESSION['reset_timeErr'])): ?>
            <div class="text-center text-danger">
                <?php 
                  unset($_SESSION['reset_timeErr']);
                ?>
            </div>
        <?php endif ?>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Enter OTP</label>
                <input type="text" class="form-control" name="otp" required>
            </div>
            <div class="mb-3 password-wrapper">
                <label class="form-label">New Password</label>
                <input type="password" class="form-control" name="new_password" id="reset-new-password" value="<?php echo $ctr->oldValue('new_password') ?>" required>
                <span class="toggle-password" onclick="togglePassword('reset-new-password')">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            <button type="submit" class="btn btn-primary w-100">Reset Password</button>
        </form>

        <!-- Resend OTP -->
        <form method="post" class="mt-5 text-center">
            <button type="submit" name="resend_otp" id="resendResetBtn" class="btn btn-secondary w-60">
                Resend OTP
            </button>
        </form>

        <div class="text-center mt-5">
            <hr>
            <a href="home" style="text-decoration: none; color: white;">Back to Home</a>
        </div>
    </div>

    <script src="script.js"></script>
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

    // OPTIONAL: 30s disable on “Resend OTP”
    const resendResetBtn = document.getElementById('resendResetBtn');
    if (resendResetBtn) {
      resendResetBtn.disabled = true;
      let countdown = 60;
      const timer = setInterval(() => {
        countdown--;
        if (countdown <= 0) {
          clearInterval(timer);
          resendResetBtn.disabled = false;
          resendResetBtn.textContent = 'Resend OTP';
        } else {
          resendResetBtn.textContent = 'Resend OTP (' + countdown + 's)';
        }
      }, 1000);
    }
    </script>
</body>
</html>
