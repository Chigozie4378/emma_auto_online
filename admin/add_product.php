<?php include 'includes/_header.php';
$ctr = new ProductsController();
$ctr1 = new UnitsController();
$models = $ctr1->showAllModel();
$manufacturers = $ctr1->showAllManufacturer();
?>


<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Add New Product</h2>
        <a href="view_products" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Back to Products
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <?php $ctr->addProduct(); ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row g-4">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="name" required>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Model</label>
                            <select class="form-select " name="model">
                                <option value="">Select a Model</option>
                                <?php
                                while ($modelItem = mysqli_fetch_array($models)) {
                                    echo '<option value="' . htmlspecialchars($modelItem['name']) . '">' .
                                        htmlspecialchars($modelItem['name']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Manufacturer</label>
                            <select class="form-select  model-select" name="manufacturer">
                                <option value="">Select a Manufacturer</option>
                                <?php
                                while ($manufacturerItem = mysqli_fetch_array($manufacturers)) {
                                    echo '<option value="' . htmlspecialchars($manufacturerItem['name']) . '">' .
                                        htmlspecialchars($manufacturerItem['name']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Product Image</label>
                            <input type="file" class="form-control" name="file" accept="image/*">
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" name="upload" class="btn btn-primary">Add Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>