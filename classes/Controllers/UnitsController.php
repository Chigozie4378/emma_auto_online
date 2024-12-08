<?php
class UnitsController extends Controller
{
    public $addModelErr = "";
    public $addModelSuccess = "";
    public $addManufacturerErr = "";
    public $addManufacturerSuccess = "";
    public $deleteModelSuccess = "";
    
    public function addModel()
    {
        if (isset($_POST['add'])) {
            // // Check CSRF token
            // if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            //     die("CSRF token validation failed.");
            // }

            // unset($_SESSION['csrf_token']); // Optional: Invalidate token after use
            do {
                $model_id = bin2hex(random_bytes(16)); // Generates a 32-character unique ID
                $result = $this->fetchWhereAnd('model', "model_id = '$model_id'");
            } while (mysqli_num_rows($result) > 0); // Keep generating until a unique ID is found
            $model = strtoupper(Form::test_input(filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING)));            

            // Fetch user data from the database based on the provided phone number
            $model_exist = $this->fetchWhereAnd('model', "name= $model");
            
            if (mysqli_num_rows($model_exist) < 1){
                $this->insert('model', $model_id, $model);
                $this->addModelSuccess = '<div class="alert alert-success alert-dismissible fade show">
                        <strong>'.$model.'  is Added Successfully </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
                
            }else{
                $this->addModelErr = '<div class="alert alert-danger alert-dismissible fade show">
                        <strong>'.$model.' Already Exists</strong>
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
            $manufacturer = strtoupper(Form::test_input(filter_input(INPUT_POST, 'manufacturer', FILTER_SANITIZE_STRING)));            
            do {
                $manufacturer_id = bin2hex(random_bytes(16)); // Generates a 32-character unique ID
                $result = $this->fetchWhereAnd('manufacturer', "manufacturer_id = '$manufacturer_id'");
            } while (mysqli_num_rows($result) > 0); // Keep generating until a unique ID is found
            // Fetch user data from the database based on the provided phone number
            $manufacturer_exist = $this->fetchWhereAnd('manufacturer', "name= $manufacturer");
            
            if (mysqli_num_rows($manufacturer_exist) < 1){
                $this->insert('manufacturer', $manufacturer_id, $manufacturer);
                $this->addManufacturerSuccess = '<div class="alert alert-success alert-dismissible fade show">
                        <strong>'.$manufacturer.' is Added Successfully </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
                
            }else{
                $this->addManufacturerErr = '<div class="alert alert-danger alert-dismissible fade show">
                        <strong>'.$manufacturer.'  Already Exists</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
                
            }
        }
    }
    public function showAllManufacturer() {
        $manufacturer = $this->fetchAll("manufacturer");
        
        return $manufacturer;
    }
 
    public function deleteModel() {
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $this->trashWhere('model', "model_id = $id");
            $this->deleteModelSuccess = '<div class="alert alert-success alert-dismissible fade show">
                        <strong>Model is Deleted Successfully </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
        }
    }
    public function deleteManufacturer() {
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $this->trashWhere('manufacturer', "manufacturer_id = $id");
            $this->deleteModelSuccess = '<div class="alert alert-success alert-dismissible fade show">
                        <strong>Manufacturer is Deleted Successfully </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
        }
    }
    public function updateManufacturer($id, $name) {

      
        $this->updates(
            "manufacturer",
            U::col("name = $name"),
            U::where("manufacturer_id = $id")
        );
    }
    public function updateModel($id, $name) {

      
        $this->updates(
            "model",
            U::col("name = $name"),
            U::where("model_id = $id")
        );
    }
    

}