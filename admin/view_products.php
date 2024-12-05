<?php include 'includes/_header.php'; ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Products List</h2>
        <a href="add_product.php" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Product
        </a>
    </div>
    
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Model</th>
                            <th>Manufacturer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data -->
                        <tr>
                            <td>1</td>
                            <td><img src="../assets/images/products/Atom210x50.webp" width="50" height="50" alt="Product"></td>
                            <td>Chain and Sprocket</td>
                            <td>BX100</td>
                            <td>Chanlin</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/_footer.php'; ?> 