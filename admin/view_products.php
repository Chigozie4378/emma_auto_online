<?php include 'includes/_header.php'; ?>

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
                            <th class="ps-4" style="width: 50px;">ID</th>
                            <th style="width: 80px;">Image</th>
                            <th>Name</th>
                            <th style="width: 200px;">Model</th>
                            <th style="width: 200px;">Manufacturer</th>
                            <th style="width: 100px;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data -->
                        <tr>
                            <td class="ps-4">1</td>
                            <td>
                                <div class="position-relative product-image-cell">
                                    <img src="../assets/images/products/image.png" 
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
                                <div class="editable-cell" contenteditable="true">Chain and Sprocket</div>
                            </td>
                            <td>
                                <select class="form-select form-select-sm">
                                    <option>BX100</option>
                                    <option>BX150</option>
                                    <option>BX200</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-select form-select-sm">
                                    <option>Chanlin</option>
                                    <option>DID</option>
                                    <option>RK</option>
                                </select>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-link text-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Add more sample rows for better visualization -->
                        <tr>
                            <td class="ps-4">2</td>
                            <td>
                                <div class="position-relative product-image-cell">
                                    <img src="../assets/images/products/image.png" 
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
                                <div class="editable-cell" contenteditable="true">Front Sprocket</div>
                            </td>
                            <td>
                                <select class="form-select form-select-sm">
                                    <option value="">Not Selected</option>
                                    <option value="BX100">BX100</option>
                                    <option value="BX150" selected>BX150</option>
                                    <option value="BX200">BX200</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-select form-select-sm">
                                    <option>Chanlin</option>
                                    <option selected>DID</option>
                                    <option>RK</option>
                                </select>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-link text-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/_footer.php'; ?>
