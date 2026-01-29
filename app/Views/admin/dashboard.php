<?= $this->include('admin/layout/header') ?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="h4">Dashboard Overview</h2>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="fas fa-shopping-bag text-primary fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Orders</h6>
                        <h4 class="mb-0 fw-bold"><?= number_format($stats['total_orders']) ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="fas fa-money-bill-wave text-success fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Revenue</h6>
                        <h4 class="mb-0 fw-bold">Rp <?= number_format($stats['total_revenue'], 0, ',', '.') ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="fas fa-users text-warning fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Users</h6>
                        <h4 class="mb-0 fw-bold"><?= number_format($stats['total_users']) ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-danger bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="fas fa-store text-danger fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Restaurants</h6>
                        <h4 class="mb-0 fw-bold"><?= number_format($stats['total_restaurants']) ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders & Charts Placeholder -->
    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h5 class="card-title mb-0">Recent Orders</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Restaurant</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($stats['recent_orders'])): ?>
                                    <?php foreach ($stats['recent_orders'] as $order): ?>
                                    <tr>
                                        <td>#<?= $order['order_number'] ?></td>
                                        <td><?= $order['customer_name'] ?></td>
                                        <td><?= $order['restaurant_name'] ?? 'N/A' ?></td>
                                        <td>Rp <?= number_format($order['total_amount'], 0, ',', '.') ?></td>
                                        <td>
                                            <span class="badge bg-<?= $order['status'] === 'completed' ? 'success' : ($order['status'] === 'pending' ? 'warning' : 'primary') ?>">
                                                <?= ucfirst($order['status']) ?>
                                            </span>
                                        </td>
                                        <td><?= date('Y-m-d', strtotime($order['created_at'])) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">No orders found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <h5 class="card-title mb-0">Popular Items</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted text-center py-4">No data available</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('admin/layout/footer') ?>
