<?php include 'includes/_header.php';
$ctr = new ProductsController();
$ctr1 = new UnitsController();
$products = $ctr->showAllProducts();
$models = $ctr1->showAllModel();
$manufacturers = $ctr1->showAllManufacturer();
$ctr->deleteProduct();

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
                            $id = $row['product_id'];
                            $name = $row['product_name'];
                            $model = $row['model'];
                            $manufacturer = $row['manufacturer'];
                            $image = $row['image_path'];
                        ?>
                        <tr>
                            <td class="ps-4"><?php echo ++$i; ?></td>
                            <!-- Editable Image -->
                            <td>
                                <div class="position-relative product-image-cell">
                                    <img src="<?php echo $image?>" 
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
                            <!-- Editable Name -->
                            <td>
                                <div class="editable-cell" contenteditable="true" data-id="<?php echo $id; ?>" data-field="product_name">
                                    <?php echo htmlspecialchars($name); ?>
                                </div>
                            </td>
                            <!-- Editable Model -->
                            <td>
                                <select class="form-select form-select-sm model-select" data-id="<?php echo $id; ?>" data-field="model">
                                    <option value="">Select Model</option>
                                    <?php
                                    mysqli_data_seek($models, 0);
                                    while ($modelItem = mysqli_fetch_array($models)) {
                                        $selected = $modelItem['name'] === $model ? 'selected' : '';
                                        echo '<option value="' . htmlspecialchars($modelItem['name']) . '" ' . $selected . '>' .
                                             htmlspecialchars($modelItem['name']) . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <!-- Editable Manufacturer -->
                            <td>
                                <select class="form-select form-select-sm manufacturer-select" data-id="<?php echo $id; ?>" data-field="manufacturer">
                                    <option value="">Select Manufacturer</option>
                                    <?php
                                    mysqli_data_seek($manufacturers, 0);
                                    while ($manufacturerItem = mysqli_fetch_array($manufacturers)) {
                                        $selected = $manufacturerItem['name'] === $manufacturer ? 'selected' : '';
                                        echo '<option value="' . htmlspecialchars($manufacturerItem['name']) . '" ' . $selected . '>' .
                                             htmlspecialchars($manufacturerItem['name']) . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-link text-danger">
                                    <a class="text-danger" href="view_products.php?product_id=<?php echo $id;?>"><i class="fas fa-trash"></i></a>
                                    
                                </button>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/_footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Update text fields (Name)
    $('.editable-cell').on('keyup', function () {
        const id = $(this).data('id');
        const field = $(this).data('field');
        const value = $(this).text().trim();
       
        $.ajax({
            url: 'ajax/products/update.php',
            type: 'POST',
            data: { id, field, value },
            success: function (response) {
                console.log('Updated successfully:', response);
            },
            error: function () {
                console.error('Failed to update');
            }
        });
    });

    // Update select fields (Model, Manufacturer)
    $('.model-select, .manufacturer-select').on('change', function () {
        const id = $(this).data('id');
        const field = $(this).data('field');
        const value = $(this).val();

        $.ajax({
            url: 'ajax/products/update.php',
            type: 'POST',
            data: { id, field, value },
            success: function (response) {
                console.log('Updated successfully:', response);
            },
            error: function () {
                console.error('Failed to update');
            }
        });
    });

    // Update image
    $('.image-upload').on('change', function () {
        const id = $(this).data('id');
        const file = this.files[0];
        const formData = new FormData();
        formData.append('id', id);
        formData.append('field', 'image_path');
        formData.append('file', file);
        
        $.ajax({
            url: 'ajax/products/update.php',
            type: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            success: function (response) {
                console.log('Image updated successfully:', response);
                location.reload(); // Reload to reflect the updated image
            },
            error: function () {
                console.error('Failed to update image');
            }
        });
    });

});
</script>
