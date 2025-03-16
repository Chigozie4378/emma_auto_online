<?php
class AuthController1 extends Controller
{
    public $signInErr = "";
    public $phone_numberErr = "";
    public $phone_no_existErr = "";
    public $titleErr = "";
    public $nameErr = "";
    public $addressErr = "";
    public $passwordErr = "";
    public $confirm_passwordErr = "";
    public $passwordLenErr = "";
    public $signup_success = "";
    public function signIn()
    {
        if (isset($_POST['sign_in'])) {
            // // Check CSRF token
            // if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            //     die("CSRF token validation failed.");
            // }

            // // Proceed with form handling if CSRF check passes
            $phone_no = Form::test_input(filter_input(INPUT_POST, 'phone_no', FILTER_SANITIZE_STRING));
            $password = Form::test_input(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
            

            // Fetch user data from the database based on the provided phone number
            $phone_no_exist = $this->fetchResult('online_customer', where:["phone_no= $phone_no"]);
            
            if (mysqli_num_rows($phone_no_exist) >0){

                $user = mysqli_fetch_array($phone_no_exist);
                
                if ($user && password_verify($password, $user['password'])) {

                    $this->updates(
                        "online_customer",
                        U::col("status = 1"),
                        U::where("phone_no = $phone_no")
                    );
                    // Password is correct, user is authenticated
                    // You may now start a session, set session variables, redirect, etc.
                    Session::name("phone_no",$user['phone_no']);
                    Session::name("customer_name",$user['customer_name']);
                    echo "Login successful!";
                    new Redirect('products');
    
                    // // Optional: Regenerate CSRF token after successful login for added security
                    // unset($_SESSION['csrf_token']);
                } else {
                    // Invalid phone number or password
                    $this->signInErr = "Invalid Login Credentials.";
                }
            }else{
                $this->signInErr = "Invalid Login Credentials.";
                
            }
        }
    }
    public function adminSignIn()
    {
        if (isset($_POST['sign_in'])) {
            // // Check CSRF token
            // if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            //     die("CSRF token validation failed.");
            // }

            // // Proceed with form handling if CSRF check passes
            $username = Form::test_input(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
            $password = Form::test_input(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
            

            // Fetch user data from the database based on the provided phone number
            $username_exist = $this->fetchResult('online_admin', where:["username= $username"]);
            
            if (mysqli_num_rows($username_exist) >0){

                $user = mysqli_fetch_array($username_exist);
                
                if ($user && password_verify($password, $user['password'])) {

                    $this->updates(
                        "online_admin",
                        U::col("status = 1"),
                        U::where("username = $username")
                    );
                    // Password is correct, user is authenticated
                    // You may now start a session, set session variables, redirect, etc.
                    Session::name("admin_username",$user['username']);
                    Session::name("admin_firstname",$user['firstname']);
                    echo "Login successful!";
                    new Redirect('dashboard');
    
                    // // Optional: Regenerate CSRF token after successful login for added security
                    // unset($_SESSION['csrf_token']);
                } else {
                    // Invalid phone number or password
                    $this->signInErr = "Invalid Login Credentials.";
                }
            }else{
                $this->signInErr = "Invalid Login Credentials.";
                
            }
        }
    }

    public function signUp()
    {
        if (isset($_POST['sign_up'])) {
            // Check CSRF token
            // if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            //     die("CSRF token validation failed.");
            // }
            // unset($_SESSION['csrf_token']); // Optional: Invalidate token after use

            // Generate and validate unique UUID for customer_id
            do {
                $customer_id = bin2hex(random_bytes(16)); // Generates a 32-character unique ID
                $result = $this->fetchResult('online_customer', where:["customer_id = $customer_id"]);
            } while (mysqli_num_rows($result) > 0); // Keep generating until a unique ID is found

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

            if (empty(Form::test_input(filter_input(INPUT_POST, 'phone_no', FILTER_SANITIZE_NUMBER_INT)))) {
                $this->phone_numberErr = "Phone Number is required";
            } else {
                $phone_number = Form::test_input(filter_input(INPUT_POST, 'phone_no', FILTER_SANITIZE_NUMBER_INT));

                // Check if phone number already exists in the database
                $phone_no_exist = $this->fetchResult('online_customer', where:["phone_no = $phone_number"]);
                if (mysqli_num_rows($phone_no_exist) > 0) { 
                    $this->phone_no_existErr = "Phone number is already registered";
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
                    $this->insert('online_customer', $customer_id, $customer_name, $address, $phone_number, $password_hash, '0' );
                    // Example: $this->insert('online_customer', ['title' => $title, 'name' => $name, 'phone_number' => $phone_number, 'password' => $password_hash]);
                    // $this->signup_success = "Registration successful!";
                    new Redirect('sign_in');
                    // header("Location: {$_SERVER['HTTP_REFERER']}");
                    // exit;
                }
            }
        }

    }
    public function adminSignUp()
    {
        if (isset($_POST['sign_up'])) {
            // Check CSRF token
            // if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            //     die("CSRF token validation failed.");
            // }
            // unset($_SESSION['csrf_token']); // Optional: Invalidate token after use

            // Generate and validate unique UUID for customer_id
            do {
                $customer_id = bin2hex(random_bytes(16)); // Generates a 32-character unique ID
                $result = $this->fetchResult('online_customer', where:["customer_id = $customer_id"]);
            } while (mysqli_num_rows($result) > 0); // Keep generating until a unique ID is found

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

            if (empty(Form::test_input(filter_input(INPUT_POST, 'phone_no', FILTER_SANITIZE_NUMBER_INT)))) {
                $this->phone_numberErr = "Phone Number is required";
            } else {
                $phone_number = Form::test_input(filter_input(INPUT_POST, 'phone_no', FILTER_SANITIZE_NUMBER_INT));

                // Check if phone number already exists in the database
                $phone_no_exist = $this->fetchResult('online_customer', where:["phone_no = $phone_number"]);
                if (mysqli_num_rows($phone_no_exist) > 0) { 
                    $this->phone_no_existErr = "Phone number is already registered";
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
                    $this->insert('online_customer', $customer_id, $customer_name, $address, $phone_number, $password_hash, '0' );
                    // Example: $this->insert('online_customer', ['title' => $title, 'name' => $name, 'phone_number' => $phone_number, 'password' => $password_hash]);
                    // $this->signup_success = "Registration successful!";
                    new Redirect('sign_in');
                    // header("Location: {$_SERVER['HTTP_REFERER']}");
                    // exit;
                }
            }
        }

    }


}