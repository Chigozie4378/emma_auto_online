<?php 
include 'includes/_header.php';

$ctr = new ProductsController();

?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Upload Products</h2>
        <a href="view_products.php" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Back to Products
        </a>
    </div>
    
   
   <?php $ctr->uploadProducts(); ?>
    
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="form-label">Upload Product Images</label>
                    <input type="file" class="form-control" name="files[]" accept="image/*" multiple required>
                    <small class="text-muted">
                        Select multiple image files. The file names will be used as product names.
                        Supported formats: JPG, JPEG, PNG
                    </small>
                </div>
                
                <button type="submit" name="upload" class="btn btn-primary">Upload Products</button>
            </form>
        </div>
    </div>
</div>