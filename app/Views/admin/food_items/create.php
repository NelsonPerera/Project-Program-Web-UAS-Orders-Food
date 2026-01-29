<?= $this->include('admin/layout/header') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Add Food Item</h2>
        <a href="/admin/food-items" class="btn btn-secondary">Back</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <form action="/admin/food-items/create" method="post" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Restaurant</label>
                        <select name="restaurant_id" class="form-select" required>
                            <option value="">Select Restaurant</option>
                            <?php foreach ($restaurants as $r): ?>
                                <option value="<?= $r['id'] ?>" <?= old('restaurant_id') == $r['id'] ? 'selected' : '' ?>><?= esc($r['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Item Name</label>
                        <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-control" placeholder="e.g. Main Course, Dessert" value="<?= old('category') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Price (Rp)</label>
                        <input type="number" name="price" class="form-control" value="<?= old('price') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Type</label>
                        <select name="is_veg" class="form-select">
                            <option value="1" <?= old('is_veg') == '1' ? 'selected' : '' ?>>Vegetarian</option>
                            <option value="0" <?= old('is_veg') == '0' ? 'selected' : '' ?>>Non-Vegetarian</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Image File (Upload)</label>
                        <input type="file" name="image_file" class="form-control" accept="image/*">
                        <small class="text-muted">Or enter URL below</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Image URL</label>
                        <input type="text" name="image_url" class="form-control" value="<?= old('image_url') ?>">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"><?= old('description') ?></textarea>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Create Item</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->include('admin/layout/footer') ?>
