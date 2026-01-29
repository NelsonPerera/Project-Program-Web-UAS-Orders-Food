<?= $this->include('admin/layout/header') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Manage Orders</h2>
    </div>

    <!-- Filter -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="" method="get" class="row g-3">
                <div class="col-md-10">
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="pending" <?= $status == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="preparing" <?= $status == 'preparing' ? 'selected' : '' ?>>Preparing</option>
                        <option value="on_delivery" <?= $status == 'on_delivery' ? 'selected' : '' ?>>On Delivery</option>
                        <option value="delivered" <?= $status == 'delivered' ? 'selected' : '' ?>>Delivered</option>
                        <option value="cancelled" <?= $status == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Order ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">No orders found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td class="ps-4 fw-bold"><?= esc($order['order_number']) ?></td>
                                    <td>
                                        <div><?= esc($order['customer_name']) ?></div>
                                        <small class="text-muted"><?= esc($order['customer_phone']) ?></small>
                                    </td>
                                    <td>Rp <?= number_format($order['total_amount'], 0, ',', '.') ?></td>
                                    <td>
                                        <?php 
                                            $statusBadge = match($order['status']) {
                                                'completed', 'delivered' => 'bg-success',
                                                'pending' => 'bg-warning',
                                                'cancelled' => 'bg-danger',
                                                'preparing' => 'bg-info',
                                                'on_delivery' => 'bg-primary',
                                                default => 'bg-secondary'
                                            };
                                        ?>
                                        <span class="badge <?= $statusBadge ?>"><?= ucfirst(str_replace('_', ' ', $order['status'])) ?></span>
                                    </td>
                                    <td><?= date('d M Y H:i', strtotime($order['created_at'])) ?></td>
                                    <td class="text-end pe-4">
                                        <!-- Simple status update dropdown (inline form) -->
                                        <form action="/admin/orders/update-status" method="post" class="d-inline">
                                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                            <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                                <option disabled selected>Change Status</option>
                                                <option value="pending">Pending</option>
                                                <option value="preparing">Preparing</option>
                                                <option value="on_delivery">On Delivery</option>
                                                <option value="delivered">Delivered</option>
                                                <option value="cancelled">Cancelled</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3">
            <?= $pager->links() ?>
        </div>
    </div>
</div>

<?= $this->include('admin/layout/footer') ?>
