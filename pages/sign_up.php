<?php
include "../autoload/loader.php";
$ctr = new AuthController();
$ctr->signUp();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Emma Auto Multi Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="auth-container">
        <h3 class="text-center">Sign Up</h3>
        <div class="text-center" style="color: red; font-weight: 400;"><?php echo $ctr->emptyErr, $ctr->user_existErr; ?>
        </div>
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['token']; ?>">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <select name="title" id="" class="form-control" required>
                    <?php $ctr->oldSelect('title') ?>
                    <option value="">Select your title</option>
                    <option value="MR">MR</option>
                    <option value="MRS">MRS</option>
                    <option value="Alfa">Alfa</option>
                    <option value="ALhaji">ALhaji</option>
                    <option value="ALhaja">ALhaja</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $ctr->oldValue('name') ?>"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Town</label>
                <input type="text" class="form-control" name="address" value="<?php echo $ctr->oldValue('address') ?>"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <div style="color: red; font-weight: 400;"><?php echo $ctr->phoneErr ?></div>
                <input type="text" class="form-control" name="phone_no" value="<?php echo $ctr->oldValue('phone_no') ?>"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email (Optional)</label>
                <input type="email" class="form-control" name="email" value="<?php echo $ctr->oldValue('email') ?>">
            </div>
            <div class="mb-3 password-wrapper">
                <label class="form-label">Password</label>
                <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Must be at least 8 characters, 
              with uppercase, lowercase, 
              a digit, and a special character.">
                </i>
                <div style="color: red; font-weight: 400;"><?php echo $ctr->passwordErr ?></div>
                <input type="password" class="form-control" name="password" id="signup-password"
                    value="<?php echo $ctr->oldValue('password') ?>" required>
                <span class="toggle-password" onclick="togglePassword('signup-password')">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            <div class="mb-3 password-wrapper">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" id="signup-confirm-password"
                    value="<?php echo $ctr->oldValue('confirm_password') ?>" required>
                <span class="toggle-password" onclick="togglePassword('signup-confirm-password')">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="remember_me" id="rememberMeCheck">
                <label class="form-check-label" for="rememberMeCheck">
                    Remember Me
                </label>
            </div>
            <button type="submit" class="btn btn-success w-100">Sign Up</button>
        </form>
        <div class="text-center mt-3">
            <p>Already have an account? <a style="text-decoration: none;" href="sign_in">Sign In</a></p>
        </div>
        <div class="text-center mt-5">
            <hr>
            <a href="home" style="text-decoration: none; color: white;">Back to Home</a>
        </div>
    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>