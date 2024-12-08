<?php include 'includes/_header.php'; 
$ctr = new UnitsController();
$ctr->addModel();
$ctr->deleteModel();
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Add New Model</h2>
        <a href="view_products.php" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Back to Products
        </a>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="card border-2 shadow-sm">
                <div class="card-body">
                    <?php echo $ctr->addModelErr;?>
                    <?php echo $ctr->addModelSuccess;?>
                    <form action="" method="POST">
                        <div class="row">
                                <div class="mb-3">
                                    <label class="form-label">Model</label>
                                    <input type="text" class="form-control" name="model" required>
                                </div>

                            <div class="col-12">
                                <button type="submit" name="add" class="btn btn-primary">Add Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="table">
                <table class="table table-hover spreadsheet-table mb-0">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Model</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $models = $ctr->showAllModel();
                        while ($row = mysqli_fetch_array($models)) {
                            $id = $row['model_id'];
                            $name = $row['name'];
                            echo '
                       
                        <tr>
                            <td class="ps-4">' . ++$i . '</td>
                        
                            <td>
                                <div class="editable-cell" contenteditable="true" data-id="' . $id . '">' . $name . '</div>
                            </td>
                            
                             <td>
                            <a class="btn btn-sm btn-link text-danger" href="model.php?delete='.$id.'">
                            <i class="fas fa-trash"></i>
                            </a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.editable-cell').on('keyup', function() {
        const manufacturerId = $(this).data('id'); // Get manufacturer ID
        const newValue = $(this).text().trim(); // Get updated value
        
        $.ajax({
            url: 'ajax/units/model.php', // Backend script
            method: 'POST',
            data: {
                id: manufacturerId,
                name: newValue,
            },
            success: function(data) {
                $("#test").html(data);
            },
            error: function() {
                console.error('An error occurred while updating the manufacturer.');
            }
        });
    });
});
</script>
