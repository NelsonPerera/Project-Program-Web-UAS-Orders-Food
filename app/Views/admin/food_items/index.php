<?= $this->include('admin/layout/header') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Manage Food Items</h2>
        <a href="/admin/food-items/create" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Food Item</a>
    </div>

    <!-- Filter & Search -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="" method="get" class="row g-3">
                <div class="col-md-4">
                    <select name="restaurant_id" class="form-select">
                        <option value="">All Restaurants</option>
                        <?php foreach ($restaurants as $r): ?>
                            <option value="<?= $r['id'] ?>" <?= $restaurantId == $r['id'] ? 'selected' : '' ?>><?= esc($r['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Search by name..." value="<?= esc($search) ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Food Items Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Item</th>
                            <th>Restaurant</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($foodItems)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">No food items found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($foodItems as $item): ?>
                                <tr>
                                    <td class="ps-4">#<?= $item['id'] ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3 position-relative">
                                                <img src="<?= esc($item['image']) ?>" alt="" class="rounded" width="40" height="40" style="object-fit: cover;">
                                                <span class="position-absolute top-0 start-100 translate-middle p-1 border border-light rounded-circle <?= $item['is_veg'] ? 'bg-success' : 'bg-danger' ?>">
                                                    <span class="visually-hidden"><?= $item['is_veg'] ? 'Veg' : 'Non-veg' ?></span>
                                                </span>
                                            </div>
                                            <div>
                                                <div class="fw-bold"><?= esc($item['name']) ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= esc($item['restaurant_name']) ?></td>
                                    <td><?= esc($item['category']) ?></td>
                                    <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                                    <td>
                                        <?php if ($item['is_available']): ?>
                                            <span class="badge bg-success">Available</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Sold Out</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="/admin/food-items/edit/<?= $item['id'] ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="/admin/food-items/delete/<?= $item['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
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
