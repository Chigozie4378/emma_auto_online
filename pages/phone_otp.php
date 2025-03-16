<?php
include "../autoload/loader.php";
session_start();

// If session variables are missing, user didn't come from sign_up
if (!isset($_SESSION['phone_no'])) {
    new Redirect('sign_up');
    exit;
}

$ctr = new AuthController();

// If user clicked the "resend_otp" button for phone
if (isset($_POST['resend_otp'])) {
    $ctr->resendPhoneOTP();
}

// If user submitted the phone OTP
$ctr->verifyPhoneOTP();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Phone OTP | Emma Auto Multi Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <h3 class="text-center">Verify Phone OTP</h3>
        <p class="text-center">An OTP was sent to your phone.</p>

        <div class="text-center" style="color: red; font-weight: 400;"><?php echo $ctr->otpErrPhone;?></div>
        <?php if (isset($_SESSION['otp_timeErr'])): ?>
            <div class="text-center text-danger">
                <?php 
                  unset($_SESSION['otp_timeErr']); 
                ?>
            </div>
        <?php endif; ?>

        <form method="post" class="mb-3">
            <div class="mb-3">
                <label class="form-label">Enter Phone OTP</label>
                <input type="text" class="form-control" name="otp" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Confirm Phone OTP</button>
        </form>

        <!-- Resend phone OTP -->
        <form method="post" class="text-center mt-5">
            <button type="submit" name="resend_otp" id="resendPhoneBtn" class="btn btn-secondary w-60">
                Resend Phone OTP
            </button>
        </form>

        <div class="text-center mt-5">
            <hr>
            <a href="home" style="text-decoration: none; color: white;">Back to Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // OPTIONAL: 30s disable
    const resendBtn = document.getElementById('resendPhoneBtn');
    if (resendBtn) {
      resendBtn.disabled = true;
      let countdown = 60;
      const timer = setInterval(() => {
        countdown--;
        if (countdown <= 0) {
          clearInterval(timer);
          resendBtn.disabled = false;
          resendBtn.textContent = 'Resend Phone OTP';
        } else {
          resendBtn.textContent = 'Resend Phone OTP (' + countdown + 's)';
        }
      }, 1000);
    }
    </script>
</body>
</html>
