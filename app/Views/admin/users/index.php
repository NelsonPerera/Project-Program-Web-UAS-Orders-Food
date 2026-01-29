<?= $this->include('admin/layout/header') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Manage Users</h2>
        <!-- <a href="/admin/users/create" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add User</a> -->
    </div>

    <!-- Search -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="" method="get" class="row g-3">
                <div class="col-md-10">
                    <input type="text" name="search" class="form-control" placeholder="Search by name, email, or mobile..." value="<?= esc($search) ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>User</th>
                            <th>Contact</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">No users found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td class="ps-4">#<?= $user['id'] ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <i class="fas fa-user text-secondary"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold"><?= esc($user['name']) ?></div>
                                                <small class="text-muted"><?= esc($user['email']) ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= esc($user['mobile']) ?></td>
                                    <td>
                                        <?php 
                                            $roleBadge = match($user['role']) {
                                                'admin' => 'bg-danger',
                                                'restaurant_owner' => 'bg-info',
                                                default => 'bg-primary'
                                            };
                                        ?>
                                        <span class="badge <?= $roleBadge ?>"><?= ucfirst($user['role']) ?></span>
                                    </td>
                                    <td>
                                        <?php if ($user['is_active']): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d M Y', strtotime($user['created_at'])) ?></td>
                                    <td class="text-end pe-4">
                                        <a href="/admin/users/toggle/<?= $user['id'] ?>" class="btn btn-sm btn-outline-warning" title="Toggle Status">
                                            <i class="fas fa-ban"></i>
                                        </a>
                                        <a href="/admin/users/delete/<?= $user['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')" title="Delete">
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
