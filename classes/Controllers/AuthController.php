<?php
class AuthController extends Controller
{
    public $signInErr = "";
    public $nameErr = "";
    public function signIn()
    {
        if (isset($_POST['sign_in'])) {
            // Check CSRF token
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die("CSRF token validation failed.");
            }

            // Proceed with form handling if CSRF check passes
            $phone_number = filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            // Fetch user data from the database based on the provided phone number
            $result = $this->fetchWhereAnd('online_customer', "phone_number= $phone_number");
            $user = mysqli_fetch_array($result);

            if ($user && password_verify($password, $user['password'])) {
                // Password is correct, user is authenticated
                // You may now start a session, set session variables, redirect, etc.
                echo "Login successful!";
                new Redirect($_SERVER['HTTP_REFERER']);

                // Optional: Regenerate CSRF token after successful login for added security
                unset($_SESSION['csrf_token']);
            } else {
                // Invalid phone number or password
                $this->signInErr = "Invalid credentials.";
            }
        }
    }

    public function signUp()
    {
        if (isset($_POST['sign_up'])) {
            // Check CSRF token
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die("CSRF token validation failed.");
            }
            unset($_SESSION['csrf_token']); // Optional: Invalidate token after use

            // Generate and validate unique UUID for customer_id
            do {
                $customer_id = bin2hex(random_bytes(16)); // Generates a 32-character unique ID
                $result = $this->fetchWhereAnd('online_customer', "customer_id = '$customer_id'");
            } while ($result); // Keep generating until a unique ID is found

            if (empty(Form::test_input(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS)))) {
                $this->titleErr = "Title is required";
            } else {
                $title = Form::test_input(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            }

            if (empty(Form::test_input(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS)))) {
                $this->nameErr = "Name is required";
            } else {
                $name = Form::test_input(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $customer_name = $title . " " . $name;
                if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                    $this->nameErr = "Only letters and white space allowed";
                }
            }

            if (empty(Form::test_input(filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS)))) {
                $this->addressErr = "Address is required";
            } else {
                $address = Form::test_input(filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            }

            if (empty(Form::test_input(filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_NUMBER_INT)))) {
                $this->phone_numberErr = "Phone Number is required";
            } else {
                $phone_number = Form::test_input(filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_NUMBER_INT));

                // Check if phone number already exists in the database
                $result = $this->fetchWhereAnd('online_customer', "phone_number = '$phone_number'");
                if ($result) { // Assuming fetchWhereAnd returns data if a record exists
                    $this->phone_numberErr = "Phone number is already registered";
                }
            }

            if (empty($_POST['password'])) {
                $this->passwordErr = "Password is required";
            } elseif (empty($_POST['confirm_password'])) {
                $this->confirm_passwordErr = "Confirm Password is required";
            } else {
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];
                if (strlen($password) < 8) {
                    $this->passwordLenErr = "Password must be at least 8 characters long";
                } elseif ($password !== $confirm_password) {
                    $this->confirm_passwordErr = "Passwords do not match";
                } elseif (empty($this->phone_numberErr)) { // Proceed only if phone number validation passed
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);
                    // Store user data in the database
                    $this->insert('online_customer', $customer_id, $customer_name, $address, $phone_number, $password, '0' );
                    // Example: $this->insert('online_customer', ['title' => $title, 'name' => $name, 'phone_number' => $phone_number, 'password' => $password_hash]);
                    echo "Registration successful!";
                    header("Location: {$_SERVER['HTTP_REFERER']}");
                    exit;
                }
            }
        }

    }


}