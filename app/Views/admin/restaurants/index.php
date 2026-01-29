<?= $this->include('admin/layout/header') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Manage Restaurants</h2>
        <a href="/admin/restaurants/create" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Restaurant</a>
    </div>

    <!-- Search -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="" method="get" class="row g-3">
                <div class="col-md-10">
                    <input type="text" name="search" class="form-control" placeholder="Search by name or city..." value="<?= esc($search) ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Restaurants Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Restaurant</th>
                            <th>Cuisine</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Rating</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($restaurants)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">No restaurants found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($restaurants as $restaurant): ?>
                                <tr>
                                    <td class="ps-4">#<?= $restaurant['id'] ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= esc($restaurant['image']) ?>" alt="" class="rounded me-3" width="40" height="40" style="object-fit: cover;">
                                            <div>
                                                <div class="fw-bold"><?= esc($restaurant['name']) ?></div>
                                                <small class="text-muted"><?= esc($restaurant['phone']) ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= esc($restaurant['cuisines']) ?></td>
                                    <td><?= esc($restaurant['city']) ?></td>
                                    <td>
                                        <?php if ($restaurant['is_active']): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><i class="fas fa-star text-warning me-1"></i><?= $restaurant['rating'] ?></td>
                                    <td class="text-end pe-4">
                                        <a href="/admin/restaurants/edit/<?= $restaurant['id'] ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="/admin/restaurants/toggle/<?= $restaurant['id'] ?>" class="btn btn-sm btn-outline-warning" title="Toggle Status">
                                            <i class="fas fa-power-off"></i>
                                        </a>
                                        <a href="/admin/restaurants/delete/<?= $restaurant['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')" title="Delete">
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
