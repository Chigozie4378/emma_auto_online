<?php
include "../autoload/loader.php";
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/admin/css/admin-style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;450;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg admin-navbar fixed-top">
    <div class="container">
        <a class="navbar-brand" href="dashboard">
            <i class="fas fa-cube me-2"></i>AdminPanel
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'dashboard.php') ? 'active-nav' : ''; ?>" 
                       href="dashboard">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo in_array($current_page, ['view_products.php', 'add_product.php', 'upload_product.php']) ? 'active-nav' : ''; ?>" 
                       href="#" 
                       role="button">
                        <i class="fas fa-box me-2"></i>Product
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="view_products">View Products</a></li>
                        <li><a class="dropdown-item" href="add_product">Add Product</a></li>
                        <li><a class="dropdown-item" href="upload_product">Upload Product</a></li>
                    </ul>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo in_array($current_page, ['pending_orders.php', 'order_history.php']) ? 'active-nav' : ''; ?>" 
                       href="#" 
                       role="button">
                        <i class="fas fa-shopping-cart me-2"></i>Orders
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="pending_orders">Pending Orders</a></li>
                        <li><a class="dropdown-item" href="order_history">Order History</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'customers.php') ? 'active-nav' : ''; ?>" 
                       href="customers">
                        <i class="fas fa-users me-2"></i>Registered Customers
                    </a>
                </li>
            </ul>
            
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link logout-btn" href="logout">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div style="padding-top: 70px;">
</div>


