<?= $this->include('admin/layout/header') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Add Restaurant</h2>
        <a href="/admin/restaurants" class="btn btn-secondary">Back</a>
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

            <form action="/admin/restaurants/create" method="post" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Restaurant Name</label>
                        <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?= old('phone') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Cuisines</label>
                        <input type="text" name="cuisines" class="form-control" placeholder="e.g. Indonesian, Chinese" value="<?= old('cuisines') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">City</label>
                        <select name="city" class="form-select" required>
                            <option value="">Select City</option>
                            <option value="Jakarta" <?= old('city') == 'Jakarta' ? 'selected' : '' ?>>Jakarta</option>
                            <option value="Surabaya" <?= old('city') == 'Surabaya' ? 'selected' : '' ?>>Surabaya</option>
                            <option value="Bandung" <?= old('city') == 'Bandung' ? 'selected' : '' ?>>Bandung</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Delivery Time (mins)</label>
                        <input type="number" name="delivery_time" class="form-control" value="<?= old('delivery_time', 30) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Price for Two</label>
                        <input type="number" name="price_for_two" class="form-control" value="<?= old('price_for_two') ?>">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2"><?= old('address') ?></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"><?= old('description') ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Image File (Upload)</label>
                        <input type="file" name="image_file" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Image URL</label>
                        <input type="text" name="image_url" class="form-control" placeholder="https://..." value="<?= old('image_url', $restaurant['image'] ?? '') ?>">
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Create Restaurant</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->include('admin/layout/footer') ?>
