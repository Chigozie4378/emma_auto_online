<?php
include_once "../../../autoload/loader.php";
$ctr = new ProductsController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $field = $_POST['field'];
    $value = isset($_POST['value']) ? $_POST['value'] : null;

    if ($field === 'image_path' && isset($_FILES['file'])) {
        // Handle image upload
        // $targetDir = "../assets/images/products/";
        $targetDir = "../../../assets/images/products/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory if not exists
        }
        
        $fileName = uniqid() . '_' . basename($_FILES['file']['name']);
        $targetFile = $targetDir . $fileName;
        // $target_file = $target_dir . basename($_FILES['file']['name']);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            $relativePath = str_replace("../../../", "", $targetFile); // Relative path for serving the image
            // $ctr->updateProductField($id, $field, $targetFile);
            $ctr->updateProductField($id, $field, $relativePath);
            // echo json_encode(['success' => true, 'message' => 'Image updated successfully']);
        } 
        // else {
        //     echo json_encode(['success' => false, 'error' => 'Failed to upload image']);
        // }
    } else {
        // Handle text or select updates
        $ctr->updateProductField($id, $field, $value);
        echo json_encode(['success' => true, 'message' => ucfirst($field) . ' updated successfully']);
    }
}

