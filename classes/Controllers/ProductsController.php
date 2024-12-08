<?php

class ProductsController extends Controller
{
    public function uploadProducts()
    {
        if (isset($_POST['upload'])) {
            // Set maximum upload sizes in PHP
            ini_set('max_execution_time', 50000);
            ini_set('max_input_time', 50000);
            ini_set('memory_limit', '35600M');

            $target_dir = "../assets/images/products/"; // Directory to store the uploaded files
            $allowed_types = array("image/jpeg", "image/png", "image/gif");

            $successful_uploads = []; // To store names of successfully uploaded files
            $failed_uploads = [];    // To store reasons for failed uploads

            foreach ($_FILES['files']['name'] as $i => $name) {
                $name = Form::test_input($name); // Sanitize the name
                $type = Form::test_input($_FILES['files']['type'][$i]);

                if (empty($name)) {
                    $failed_uploads[] = "You must select a file.";
                    continue; // Skip if no file was selected
                }

                if (!in_array($type, $allowed_types)) {
                    $failed_uploads[] = "Sorry, only JPG, PNG, and GIF files are allowed for file '$name'.";
                    continue; // Skip invalid file types
                }

                $target_file = $target_dir . basename($name);

                if (file_exists($target_file)) {
                    $failed_uploads[] = "File '$name' has already been uploaded.";
                    continue; // Skip already uploaded files
                }

                if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $target_file)) {
                    do {
                        $unique_id = uniqid();
                        $hash = md5($unique_id);
                        $product_id = substr($hash, 0, 15);

                        // Check if the ID already exists in the database
                        $row = $this->fetchWhereAnd("online_products", "product_id = '$product_id'");
                    } while (mysqli_num_rows($row) > 0);

                    $this->insert('online_products', $product_id, pathinfo($name, PATHINFO_FILENAME), "", "", $target_file);

                    $successful_uploads[] = $name; // Add to successful uploads
                } else {
                    $failed_uploads[] = "Sorry, there was an error uploading '$name'.";
                }
            }

            // Consolidate messages
            if (!empty($successful_uploads)) {
                echo '<div class="alert alert-success alert-dismissible fade show">
                        <strong>Successfully uploaded: </strong>' . implode(', ', $successful_uploads) . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
            }

            if (!empty($failed_uploads)) {
                echo '<div class="alert alert-danger alert-dismissible fade show">
                        <strong>Failed uploads: </strong>' . implode('<br>', $failed_uploads) . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
            }
        }
    }
    public function showAllProducts() {
        $products = $this->fetchAll("online_products");
        
        return $products;
    }
    
}
