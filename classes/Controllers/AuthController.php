<?php
require '../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AuthController extends Controller
{
    // Public properties to store messages
    public $emptyErr = "";
    public $phoneErr = "";
    public $passwordErr = "";
    public $signUpSuccess = "";
    public $otpErrPhone = "";
    public $otpErrEmail = "";
    public $forgetPasswordErr = "";
    public $forgetPasswordSuccess = "";
    public $resetPasswordErr = "";
    public $resetPasswordSuccess = "";
    public $signInErr = "";
    public $signInSuccess = "";
    public $user_existErr = "";

    /*************************************************
     * OLD VALUE / OLD SELECT (sticky form data)
     *************************************************/
    public function oldValue($field)
    {
        if (isset($_POST[$field])) {
            echo htmlspecialchars($_POST[$field]);
        }
    }
    public function oldSelect($field)
    {
        if (isset($_POST[$field])) { ?>
            <option selected><?php echo htmlspecialchars($_POST[$field]); ?></option>
            <?php
        }
    }

    /*************************************************
     * HELPER METHODS: Validate phone, password, etc.
     *************************************************/
    private function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    private function isValidPhone($phone_no)
    {
        // Basic pattern for Nigeria (+234 or 0) or UK (+44 or 0)
        return preg_match('/^(?:\+234|0)[789][01]\d{8}$|^(?:\+44|0)7\d{9}$/', $phone_no);
    }

    private function isStrongPassword($password)
    {
        // At least 8 chars, 1 uppercase, 1 lowercase, 1 digit, 1 special char
        $length = (strlen($password) >= 8);
        $uppercase = preg_match('/[A-Z]/', $password);
        $lowercase = preg_match('/[a-z]/', $password);
        $digit = preg_match('/[0-9]/', $password);
        $special = preg_match('/[^a-zA-Z0-9]/', $password);

        return $length && $uppercase && $lowercase && $digit && $special;
    }

    private function formatPhoneNumber($phone_no, $default_country = 'NG')
    {
        $country_codes = [
            'NG' => '+234', // Nigeria
            'UK' => '+44',
            'US' => '+1'
        ];

        $country_code = $country_codes[$default_country] ?? '+234';
        if (strpos($phone_no, '+') !== 0) {
            $phone_no = $country_code . ltrim($phone_no, "0");
        }
        return $phone_no;
    }

    /*************************************************
     * SIGN UP: Step 1 -> send phone OTP
     *************************************************/
    public function signUp()
    {
        if (empty($_SESSION['token'])) {
            $_SESSION['token'] = bin2hex(random_bytes(32));
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // CSRF
            if (!hash_equals($_SESSION['token'], $_POST['csrf_token'])) {
                die("CSRF token mismatch.");
            }

            // Gather posted data
            $title = $this->test_input($_POST['title']);
            $_SESSION['name'] = $title . " " . $this->test_input($_POST['name']);
            $_SESSION['address'] = $this->test_input($_POST['address']);
            $_SESSION['phone_no'] = $this->formatPhoneNumber($this->test_input($_POST['phone_no']));
            $_SESSION['email'] = !empty($_POST['email']) ? $this->test_input($_POST['email']) : null;
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['remember_me'] = isset($_POST['remember_me']);

            // Basic required fields
            if (
                empty($_SESSION['name']) || empty($title) ||
                empty($_SESSION['phone_no']) || empty($_SESSION['password'])
            ) {
                $this->emptyErr = "All required fields must be filled.";
                return;
            }

            // Validate phone & password
            if (!$this->isValidPhone($_SESSION['phone_no'])) {
                $this->phoneErr = "Invalid phone number format.";
                return;
            }
            if (!$this->isStrongPassword($_SESSION['password'])) {
                $this->passwordErr = "Weak password. Must be at least 8 chars with uppercase, lowercase, digit, and special char.";
                return;
            }
            if ($_SESSION['password'] !== $_POST['confirm_password']) {
                $this->passwordErr = "Passwords do not match.";
                return;
            }

            // Check if user exists
            $email = $_SESSION['email'];
            $phone_no = $_SESSION['phone_no'];
            $user_exist = $this->fetchResult('online_users', where: ["email=$email", "phone_no=$phone_no"], log: ["OR"]);
            if ($user_exist->num_rows > 0) {
                $this->user_existErr = "An account with these details already exists. Try logging in instead.";
                return;
            }

            // All good => send phone OTP
            $this->sendSignUpOTP($_SESSION['phone_no']);
            new Redirect('phone_otp');
            exit;
        }
    }

    /*************************************************
     * SIGN-UP PHONE OTP
     * If user wants to re-send phone code, or finalize
     *************************************************/
    public function verifyPhoneOTP()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['otp'])) {
            $entered_otp = $_POST['otp'];

            if (!isset($_SESSION['phone_otp'])) {
                $this->otpErrPhone = "No Phone OTP found in session.";
                return;
            }
            if ($_SESSION['phone_otp'] != $entered_otp) {
                $this->otpErrPhone = "Invalid phone OTP. Please try again.";
                return;
            }

            // Mark phone as verified
            $_SESSION['phone_verified'] = true;

            // If user has an email, we proceed to email OTP
            if (!empty($_SESSION['email'])) {
                $this->sendEmailVerificationOTP($_SESSION['email'], $_SESSION['name']);
                new Redirect('email_otp');
                exit;
            } else {
                new Redirect('finalize_sign_up');
                exit;
            }
        }
    }

    // Resend phone OTP for sign-up
    public function resendPhoneOTP()
    {
        // If phone not in session, can't resend
        if (!isset($_SESSION['phone_no'])) {
            $this->otpErrPhone = "Cannot resend phone OTP. No phone in session.";
            return;
        }
        // Re-call sendSignUpOTP with same phone
        $this->sendSignUpOTP($_SESSION['phone_no']);
    }

    /*************************************************
     * SIGN-UP EMAIL OTP
     *************************************************/
    public function verifyEmailOTP()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['otp'])) {
            $entered_otp = $_POST['otp'];

            if (!isset($_SESSION['email_otp'])) {
                $this->otpErrEmail = "No Email OTP found in session.";
                return;
            }
            if ($_SESSION['email_otp'] != $entered_otp) {
                $this->otpErrEmail = "Invalid email OTP. Please try again.";
                return;
            }

            $_SESSION['email_verified'] = true;
            new Redirect('finalize_sign_up');
            exit;
        }
    }

    // Resend email OTP for sign-up
    public function resendEmailOTP()
    {
        if (empty($_SESSION['email']) || empty($_SESSION['phone_verified'])) {
            $this->otpErrEmail = "Cannot resend Email OTP. No valid email or session data found.";
            return;
        }
        // Re-call sendEmailVerificationOTP
        $this->sendEmailVerificationOTP($_SESSION['email'], $_SESSION['name']);
    }

    /*************************************************
     * FINALIZE SIGN UP
     *************************************************/
    public function finalizeSignUp()
    {
        if (!isset($_SESSION['phone_no'], $_SESSION['phone_verified'])) {
            echo "Session expired. Please start again.";
            exit;
        }
        if (!empty($_SESSION['email']) && empty($_SESSION['email_verified'])) {
            echo "Email not verified. Please verify or register without email.";
            exit;
        }

        $name = $_SESSION['name'];
        $address = $_SESSION['address'];
        $phone_no = $_SESSION['phone_no'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $remember_me = $_SESSION['remember_me'];

        // Generate user_id
        do {
            $unique_id = uniqid();
            $hash = md5($unique_id);
            $user_id = substr($hash, 0, 30);
            $row = $this->fetchResult("online_users", ["user_id=$user_id"]);
        } while (mysqli_num_rows($row) > 0);

        // Insert
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $this->insert("online_users", $user_id, $name, $address, $phone_no, $email, $hashed_password, null);

        // Congratulatory msg
        $congrats_msg = "Congrats $name! Your Emma Auto Multi Company Services account has been created.";

        if (!empty($email)) {
            $this->sendEmail($email, $name, $congrats_msg);
            $this->sendSMS($phone_no, $congrats_msg);
        } else {
            $this->sendSMS($phone_no, $congrats_msg);
        }

        // Keep user logged in
        $_SESSION['user_id'] = $user_id;
        $_SESSION['phone_no'] = $phone_no;
        $_SESSION['name'] = $name;

        if ($remember_me) {
            setcookie("user_id", $user_id, time() + (86400 * 30), "/", "", false, true);
        }

        // Clear OTP stuff
        unset(
            $_SESSION['phone_otp'],
            $_SESSION['otp_phone'],
            $_SESSION['otp_timeErr'],
            $_SESSION['email_otp'],
            $_SESSION['phone_verified'],
            $_SESSION['email_verified'],
            $_SESSION['otpErrPhone'],
            $_SESSION['otpErrEmail']
        );

        // Clear sign-up data
        unset($_SESSION['address'], $_SESSION['email'], $_SESSION['password'], $_SESSION['remember_me']);

        $this->signUpSuccess = "Registration successful!";
        new Redirect('home');
        exit;
    }

    /*************************************************
     * SIGN IN
     *************************************************/
    public function signIn()
    {
        if (empty($_SESSION['token'])) {
            $_SESSION['token'] = bin2hex(random_bytes(32));
        }
        if (isset($_POST['sign_in'])) {
            if (!hash_equals($_SESSION['token'], $_POST['csrf_token'])) {
                die("CSRF token mismatch.");
            }

            $phone_no = $this->formatPhoneNumber($this->test_input($_POST['phone_no']));
            $password = $this->test_input($_POST['password']);
            $remember_me = isset($_POST['remember_me']);

            $user = $this->fetchResult("online_users", ["phone_no=$phone_no"]);
            if (mysqli_num_rows($user) === 0) {
                $this->signInErr = "Invalid Sign In Details!";
                return;
            }

            $userData = mysqli_fetch_assoc($user);
            if (!password_verify($password, $userData['password'])) {
                $this->signInErr = "Invalid Sign In Details!";
                return;
            }

            $_SESSION['user_id'] = $userData['user_id'];
            $_SESSION['phone_no'] = $userData['phone_no'];
            $_SESSION['name'] = $userData['name'];

            if ($remember_me) {
                setcookie("user_id", $userData['user_id'], time() + (86400 * 30), "/", "", false, true);
            }
            $this->signInSuccess = "Login successful!";
            new Redirect('home');
            exit;
        }
    }

    /*************************************************
     * FORGOT PASSWORD (Send OTP by phone/email)
     *************************************************/
    public function forgotPassword()
    {
        if (empty($_SESSION['token'])) {
            $_SESSION['token'] = bin2hex(random_bytes(32));
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!hash_equals($_SESSION['token'], $_POST['csrf_token'])) {
                die("CSRF token mismatch.");
            }

            $identifier = $this->test_input($_POST['identifier']);
            if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
                $user = $this->fetchResult("online_users", ["email=$identifier"]);
                $is_email = true;
            } else {
                $phone_identifier = $this->formatPhoneNumber($identifier);
                $user = $this->fetchResult("online_users", ["phone_no=$phone_identifier"]);
                $is_email = false;
            }

            if (mysqli_num_rows($user) === 0) {
                $this->forgetPasswordErr = "The provided details do not match any existing account.";
                return;
            }

            $userData = mysqli_fetch_assoc($user);

            // Check 30s limit
            if (isset($_SESSION['reset_otp_time']) && (time() - $_SESSION['reset_otp_time']) < 30) {
                $_SESSION['reset_timeErr'] = "Please wait at least 30 seconds before requesting a new OTP.";
                return;
            }

            // Generate OTP
            $otp = rand(100000, 999999);
            $_SESSION['reset_otp'] = $otp;
            $_SESSION['reset_user_id'] = $userData['user_id'];
            $_SESSION['reset_is_email'] = $is_email;
            $_SESSION['reset_identifier'] = $identifier;
            $_SESSION['reset_otp_time'] = time(); // store timestamp
            $_SESSION['reset_name'] = $userData['name']; // store user name for resend

            if ($is_email) {
                $this->sendEmail($identifier, $userData['name'], "Your Emma Auto Multi Company Services Password Reset OTP: $otp");
            } else {
                $this->sendSMS($phone_identifier, "Your Emma Auto Multi Company Services Password Reset OTP: $otp");
            }

            $this->forgetPasswordSuccess = "A password reset OTP has been sent to your " . ($is_email ? "email" : "phone") . ".";
            new Redirect('reset_password');
        }
    }

    // Resend OTP for forgot password
    public function resendResetOTP()
    {
        if (!isset($_SESSION['reset_identifier'])) {
            $this->resetPasswordErr = "Cannot resend OTP. No phone/email found in session.";
            return;
        }

        // Check 30s limit
        if (isset($_SESSION['reset_otp_time']) && (time() - $_SESSION['reset_otp_time']) < 30) {
            $_SESSION['reset_timeErr'] = "Please wait at least 30 seconds before requesting a new OTP.";
            return;
        }

        $identifier = $_SESSION['reset_identifier'];
        $is_email = $_SESSION['reset_is_email'] ?? false;

        $otp = rand(100000, 999999);
        $_SESSION['reset_otp'] = $otp;
        $_SESSION['reset_otp_time'] = time();  // reset timer

        // We stored the user name in $_SESSION['reset_name']
        $username = $_SESSION['reset_name'] ?? 'User';

        if ($is_email) {
            $this->sendEmail($identifier, $username, "Your Emma Auto Multi Company Services Password Reset OTP: $otp");
        } else {
            $phone_identifier = $this->formatPhoneNumber($identifier);
            $this->sendSMS($phone_identifier, "Your Emma Auto Multi Company Services Password Reset OTP: $otp");
        }

        $this->resetPasswordSuccess = "We have re-sent your OTP. Please check your " . ($is_email ? "email" : "phone") . ".";
    }

    /*************************************************
     * RESET PASSWORD (User enters OTP + new password)
     *************************************************/
    public function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // if user clicked “resend_otp”
            if (isset($_POST['resend_otp'])) {
                $this->resendResetOTP();
                return; // so we show updated message
            }

            // else normal OTP verification
            $entered_otp = $this->test_input($_POST['otp']);
            $new_password = $this->test_input($_POST['new_password']);

            if (!isset($_SESSION['reset_otp'])) {
                $this->resetPasswordErr = "No OTP in session. Please request a new one.";
                return;
            }

            if ($_SESSION['reset_otp'] != $entered_otp) {
                $this->resetPasswordErr = "Invalid OTP. Please try again.";
                return;
            }

            if (!$this->isStrongPassword($new_password)) {
                $this->resetPasswordErr = "Weak password. Must be at least 8 chars with uppercase, lowercase, digit, special char.";
                return;
            }

            $hashed_temp_password = password_hash($new_password, PASSWORD_DEFAULT);
            $user_id = $_SESSION['reset_user_id'];

            $this->updates("online_users", ["password" => $hashed_temp_password], ["user_id=$user_id"]);

            unset(
                $_SESSION['reset_otp'],
                $_SESSION['reset_user_id'],
                $_SESSION['reset_identifier'],
                $_SESSION['reset_is_email'],
                $_SESSION['reset_name'],
                $_SESSION['reset_otp_time']
            );

            // $this->resetPasswordSuccess = "Password reset successful! You can now login.";

            new Redirect('sign_in');
        }
    }

    /*************************************************
     * OTP SENDERS for SIGN-UP
     *************************************************/
    private function sendSignUpOTP($phone_no)
    {
        // 30s limit for signUp phone
        if (isset($_SESSION['otp_time']) && (time() - $_SESSION['otp_time']) < 30) {
            $_SESSION['otp_timeErr'] = "Please wait at least 30 seconds before requesting a new OTP.";
            return;
        }

        $otp = rand(100000, 999999);
        $_SESSION['phone_otp'] = $otp;
        $_SESSION['otp_phone'] = $phone_no;
        $_SESSION['otp_time'] = time();

        $this->sendSMS($phone_no, "Your Emma Auto Multi Company Services Phone OTP: $otp");
    }

    private function sendEmailVerificationOTP($email, $name)
    {
        // 30s limit for signUp email
        if (isset($_SESSION['email_otp_time']) && (time() - $_SESSION['email_otp_time']) < 30) {
            $_SESSION['otp_timeErr_email'] = "Please wait at least 30 seconds before requesting a new Email OTP.";
            return;
        }

        $otp = rand(100000, 999999);
        $_SESSION['email_otp'] = $otp;
        $_SESSION['email_otp_time'] = time();

        $message = "Your Emma Auto Multi Company Services Email OTP: $otp";
        $this->sendEmail($email, $name, $message);
    }

    /*************************************************
     * SEND EMAIL / SMS
     *************************************************/
    private function sendEmail($to_email, $name, $message)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ezesunday4378@gmail.com';
            $mail->Password = 'rliekhguwkwirpam'; // App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('ezesunday4378@gmail.com', 'Emma Auto Multi Company Services');
            $mail->addAddress($to_email, $name);
            $mail->isHTML(true);
            $mail->Subject = 'Emma Auto Multi Company Services';
            $mail->Body = "
                <p>Hello <strong>$name</strong>,</p>
                <p>$message</p>
                <p>Regards,<br><strong>Emma Auto Multi Company Services Team</strong></p>
            ";

            $mail->send();
        } catch (Exception $e) {
            // $this->someErr = "Mail Error: {$mail->ErrorInfo}";
        }
    }

    private function sendSMS($phone_no, $message)
    {
        $account_sid = $_ENV['TWILIO_SID'] ?? $_SERVER['TWILIO_SID'];
        $auth_token = $_ENV['TWILIO_AUTH_TOKEN'] ?? $_SERVER['TWILIO_AUTH_TOKEN'];
        $twilio_number = $_ENV['TWILIO_PHONE_NUMBER'] ?? $_SERVER['TWILIO_PHONE_NUMBER'];


        $url = "https://api.twilio.com/2010-04-01/Accounts/$account_sid/Messages.json";
        $data = [
            "To" => $phone_no,
            "From" => $twilio_number,
            "Body" => $message
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "$account_sid:$auth_token");
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        $_SESSION['auth_token'] = $auth_token;
        $_SESSION['errs'] = $response;
        curl_close($ch);
    }


    // private function sendSMS($phone_no, $message, $type = 'otp')
    // {
    //     $api_key = 'TLyVdXjyvZFkedeAYbbndvauLgwvYeUNMCdMqTedYgKtIALHmPeXKZSYOkGxzV'; // Use your real API Key
    //     $base_url = 'https://v3.api.termii.com'; // ✅ Correct base URL

    //     if ($type === 'otp') {
    //         $curl = curl_init();
    //         $data = array(
    //             "api_key" => "$api_key",
    //             "message_type" => "NUMERIC",
    //             "to" => "$phone_no",
    //             "from" => "Approved Sender ID or Configuration ID",
    //             "channel" => "dnd",
    //             "pin_attempts" => 10,
    //             "pin_time_to_live" => 5,
    //             "pin_length" => 6,
    //             "pin_placeholder" => "< 1234 >",
    //             "message_text" => "Your pin is < 1234 >",
    //             "pin_type" => "NUMERIC"
    //         );

    //         $post_data = json_encode($data);

    //         curl_setopt_array($curl, array(
    //             CURLOPT_URL => "https://BASE_URL/api/sms/otp/send",
    //             CURLOPT_RETURNTRANSFER => true,
    //             CURLOPT_ENCODING => "",
    //             CURLOPT_MAXREDIRS => 10,
    //             CURLOPT_TIMEOUT => 0,
    //             CURLOPT_FOLLOWLOCATION => true,
    //             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //             CURLOPT_CUSTOMREQUEST => "POST",
    //             CURLOPT_POSTFIELDS => $post_data,
    //             CURLOPT_HTTPHEADER => array(
    //                 "Content-Type: application/json"
    //             ),
    //         ));

    //         $response = curl_exec($curl);

    //         curl_close($curl);
    //         $_SESSION['error'] = $response;;

    //     } else {
    //         // ✅ Normal SMS API
    //         $endpoint = "$base_url/sms/send";
    //         $data = [
    //             'api_key' => $api_key,
    //             'to' => $phone_no,
    //             'sms' => $message,
    //             'type' => 'plain',
    //             'channel' => 'generic'
    //         ];
    //     }


    // }


    public function signOut()
    {
        session_destroy();
        new Redirect('home');
    }
}
