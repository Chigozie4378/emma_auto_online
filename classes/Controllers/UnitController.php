<?php
class UnitController extends Controller
{
    public $addModelErr = "";
    public $addModelSuccess = "";
    public $addManufacturerErr = "";
    public $addManufacturerSuccess = "";
    
    public function addModel()
    {
        if (isset($_POST['add'])) {
            // // Check CSRF token
            // if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            //     die("CSRF token validation failed.");
            // }

            // // Proceed with form handling if CSRF check passes
            $model = Form::test_input(filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING));            

            // Fetch user data from the database based on the provided phone number
            $model_exist = $this->fetchWhereAnd('model', "name= $model");
            
            if (mysqli_num_rows($model_exist) < 1){
                $this->insert('model', $model);
                $this->addModelSuccess = '<div class="alert alert-success alert-dismissible fade show">
                        <strong>Model is Added Successfully </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
                
            }else{
                $this->addModelErr = '<div class="alert alert-danger alert-dismissible fade show">
                        <strong>Model Already Exists</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
                
            }
        }
    }
    public function showAllModel() {
        $model = $this->fetchAll("model");
        
        return $model;
    }
    public function addManufacturer()
    {
        if (isset($_POST['add'])) {
            // // Check CSRF token
            // if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            //     die("CSRF token validation failed.");
            // }

            // // Proceed with form handling if CSRF check passes
            $manufacturer = Form::test_input(filter_input(INPUT_POST, 'manufacturer', FILTER_SANITIZE_STRING));            

            // Fetch user data from the database based on the provided phone number
            $manufacturer_exist = $this->fetchWhereAnd('manufacturer', "name= $manufacturer");
            
            if (mysqli_num_rows($manufacturer_exist) < 1){
                $this->insert('manufacturer', $manufacturer);
                $this->addManufacturerSuccess = '<div class="alert alert-success alert-dismissible fade show">
                        <strong>Manufacturer is Added Successfully </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
                
            }else{
                $this->addManufacturerErr = '<div class="alert alert-danger alert-dismissible fade show">
                        <strong>Manufacturer Already Exists</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
                
            }
        }
    }
    public function showAllManufacturer() {
        $manufacturer = $this->fetchAll("manufacturer");
        
        return $manufacturer;
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
                $result = $this->fetchWhereAnd('online_customer', "customer_id = '$customer_id'");
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
                $phone_no_exist = $this->fetchWhereAnd('online_customer', "phone_no = '$phone_number'");
                if (mysqli_num_rows($phone_no_exist) > 0) { // Assuming fetchWhereAnd returns data if a record exists
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