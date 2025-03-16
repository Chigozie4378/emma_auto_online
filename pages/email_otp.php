<?php
include "../autoload/loader.php";
session_start();

// If user didn't come from phone_otp or has no email in session:
if (!isset($_SESSION['phone_verified']) || empty($_SESSION['email'])) {
    new Redirect('sign_up');
    exit;
}

$ctr = new AuthController();

// If user clicked “resend_email_otp”
if (isset($_POST['resend_email_otp'])) {
    $ctr->resendEmailOTP();
}

// If user submitted the email OTP
$ctr->verifyEmailOTP();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Email OTP | Emma Auto Multi Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <h3 class="text-center">Verify Email OTP</h3>
        <p class="text-center">We sent an OTP to your email.</p>

        <div class="text-center" style="color: red; font-weight: 400;"><?php echo $ctr->otpErrEmail ?></div>
        <?php if (isset($_SESSION['otp_timeErr_email'])): ?>
            <div class="text-center text-danger">
                <?php 
                    unset($_SESSION['otp_timeErr_email']);
                ?>
            </div>
        <?php endif; ?>

        <form method="post" class="mb-3">
            <div class="mb-3">
                <label class="form-label">Enter the OTP sent to your Email</label>
                <input type="text" class="form-control" name="otp" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Confirm Email OTP</button>
        </form>

        <!-- Resend Email OTP -->
        <form method="post" class="text-center mt-5">
            <button type="submit" name="resend_email_otp" id="resendEmailBtn" class="btn btn-secondary w-60">
                Resend Email OTP
            </button>
        </form>

        <div class="text-center mt-5">
            <hr>
            <a href="home" style="text-decoration: none; color: white;">Back to Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Optional 30s disable
    const resendBtn = document.getElementById('resendEmailBtn');
    if (resendBtn) {
      resendBtn.disabled = true;
      let countdown = 60;
      const timer = setInterval(() => {
        countdown--;
        if (countdown <= 0) {
          clearInterval(timer);
          resendBtn.disabled = false;
          resendBtn.textContent = 'Resend Email OTP';
        } else {
          resendBtn.textContent = 'Resend Email OTP (' + countdown + 's)';
        }
      }, 1000);
    }
    </script>
</body>
</html>
