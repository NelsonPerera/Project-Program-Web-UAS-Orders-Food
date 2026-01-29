<?= $this->include('admin/layout/header') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Edit Restaurant</h2>
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

            <form action="/admin/restaurants/edit/<?= $restaurant['id'] ?>" method="post" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Restaurant Name</label>
                        <input type="text" name="name" class="form-control" value="<?= old('name', $restaurant['name']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?= old('phone', $restaurant['phone']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Cuisines</label>
                        <input type="text" name="cuisines" class="form-control" value="<?= old('cuisines', $restaurant['cuisines']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">City</label>
                        <select name="city" class="form-select" required>
                            <option value="Jakarta" <?= old('city', $restaurant['city']) == 'Jakarta' ? 'selected' : '' ?>>Jakarta</option>
                            <option value="Surabaya" <?= old('city', $restaurant['city']) == 'Surabaya' ? 'selected' : '' ?>>Surabaya</option>
                            <option value="Bandung" <?= old('city', $restaurant['city']) == 'Bandung' ? 'selected' : '' ?>>Bandung</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Delivery Time (mins)</label>
                        <input type="number" name="delivery_time" class="form-control" value="<?= old('delivery_time', $restaurant['delivery_time']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Price for Two</label>
                        <input type="number" name="price_for_two" class="form-control" value="<?= old('price_for_two', $restaurant['price_for_two']) ?>">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2"><?= old('address', $restaurant['address']) ?></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"><?= old('description', $restaurant['description']) ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Image File (Upload to replace current)</label>
                        <input type="file" name="image_file" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Current Image URL</label>
                        <input type="text" name="image_url" class="form-control" value="<?= old('image_url', $restaurant['image'] ?? '') ?>">
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Update Restaurant</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->include('admin/layout/footer') ?>
