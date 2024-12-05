<?php include 'includes/_header.php'; ?>

<div class="container py-4">
    <h2 class="mb-4">Pending Orders</h2>
    
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data -->
                        <tr>
                            <td>#ORD-001</td>
                            <td>John Doe</td>
                            <td>2024-02-20</td>
                            <td>$299.99</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-success me-2">Process</button>
                                <button class="btn btn-sm btn-primary">View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 