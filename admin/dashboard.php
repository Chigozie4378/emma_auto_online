<?php include 'includes/_header.php'; ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Dashboard Overview</h2>
        <div class="text-muted">Welcome, <?php echo $_SESSION['admin_firstname']; ?>!</div>
    </div>
    
    <div class="row g-4">
        <!-- Statistics Cards -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary">Total Products</h5>
                    <h2 class="mb-0">150</h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-success">Total Orders</h5>
                    <h2 class="mb-0">48</h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-warning">Pending Orders</h5>
                    <h2 class="mb-0">12</h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-info">Customers</h5>
                    <h2 class="mb-0">256</h2>
                </div>
            </div>
        </div>
    </div>
</div>