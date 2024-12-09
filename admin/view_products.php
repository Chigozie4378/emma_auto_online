<?php include 'includes/_header.php';
$ctr = new ProductsController();
$ctr1 = new UnitsController();
$products = $ctr->showAllProducts();
$models = $ctr1->showAllModel();
$manufacturers = $ctr1->showAllManufacturer();

?>

<!-- Add modal for enlarged image -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="enlargedImage" class="img-fluid" alt="Enlarged Product">
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Products List</h2>
        <div>
            <button class="btn btn-outline-secondary me-2">
                <i class="fas fa-file-export me-2"></i>Export
            </button>
            <a href="add_product.php" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Product
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover spreadsheet-table mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4" style="width: 50px;">S/N</th>
                            <th style="width: 80px;">Image</th>
                            <th>Name</th>
                            <th style="width: 200px;">Model</th>
                            <th style="width: 200px;">Manufacturer</th>
                            <th style="width: 100px;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($products)) {
                            $id = $row['id'];
                            $name = $row['product_name'];
                            $model = $row['model'];
                            $manufacturer = $row['manufacturer'];
                            $image = $row['image_path'];
                            echo '
                       
                        <tr>
                            <td class="ps-4">' . ++$i . '</td>
                            <td>
                                <div class="position-relative product-image-cell">
                                    <img src="' . $image . '" 
                                         class="rounded product-image" 
                                         width="40" 
                                         height="40" 
                                         alt="Product"
                                         data-bs-toggle="tooltip">
                                    <input type="file" 
                                           class="d-none image-upload" 
                                           accept="image/*">
                                </div>
                            </td>
                            <td>
                                <div class="editable-cell" contenteditable="true">' . $name . '</div>
                            </td>
                            <td>
                                <select class="form-select form-select-sm">';
        // If a model is already set, show it as selected
        if (!empty($model)) {
            echo '<option value="' . htmlspecialchars($model) . '" selected>' . htmlspecialchars($model) . '</option>';
        } else {
            echo '<option value="" selected>Select a Model</option>';
        }

        // Reset the result pointer since we're reusing $models
        mysqli_data_seek($models, 0);
        
        // Fetch and display all available models
        while ($modelItem = mysqli_fetch_array($models)) {
            if ($modelItem['name'] !== $model) { // Don't show duplicate of selected model
                echo '<option value="' . htmlspecialchars($modelItem['name']) . '">' . 
                     htmlspecialchars($modelItem['name']) . '</option>';
            }
        }
        echo '</select>
                            </td>

                            <td>
                                <select class="form-select form-select-sm">';
                                // If a model is already set, show it as selected
        if (!empty($manufacturer)) {
            echo '<option value="' . htmlspecialchars($manufacturer) . '" selected>' . htmlspecialchars($manufacturer) . '</option>';
        } else {
            echo '<option value="" selected>Select a Manufacturer</option>';
        }
        // Reset the result pointer since we're reusing $models
        mysqli_data_seek($manufacturers, 0);
        
        // Fetch and display all available models
        while ($manufacturerItem = mysqli_fetch_array($manufacturers)) {
            if ($manufacturerItem['name'] !== $model) { // Don't show duplicate of selected model
                echo '<option value="' . htmlspecialchars($manufacturerItem['name']) . '">' . 
                     htmlspecialchars($manufacturerItem['name']) . '</option>';
            }
        }
        echo      '</select>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-link text-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                     
                        ';

                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/_footer.php'; ?>