<?php include 'includes/_header.php'; ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Bulk Upload Products</h2>
        <a href="view_products.php" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Back to Products
        </a>
    </div>
    
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="form-label">Upload CSV File</label>
                    <input type="file" class="form-control" name="csv_file" accept=".csv" required>
                    <small class="text-muted">Download sample CSV template <a href="#">here</a></small>
                </div>
                
                <button type="submit" class="btn btn-primary">Upload Products</button>
            </form>
        </div>
    </div>
</div>