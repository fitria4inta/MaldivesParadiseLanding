<?php
// views/resorts/edit.php
// $resort sudah di-set dari ResortController::edit()
?>
<div class="topbar">
    <div><h1>🏨 Edit Resort</h1><p>Update data resort</p></div>
</div>
<div class="form-card">
    <form method="POST" action="index.php?page=admin&section=resorts&action=edit&id=<?= $resort['id'] ?>">
        <div class="form-row">
            <div class="form-group">
                <label>Resort Name *</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($resort['name']) ?>" required>
            </div>
            <div class="form-group">
                <label>Location *</label>
                <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($resort['location']) ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Price Per Night (USD) *</label>
                <input type="number" name="price_per_night" class="form-control" value="<?= $resort['price_per_night'] ?>" min="0" required>
            </div>
            <div class="form-group">
                <label>Rating *</label>
                <input type="number" name="rating" class="form-control" value="<?= $resort['rating'] ?>" min="1" max="5" step="0.1" required>
            </div>
        </div>
        <div class="form-group">
            <label>Image URL *</label>
            <input type="url" name="image_url" class="form-control" value="<?= htmlspecialchars($resort['image_url']) ?>" required>
            <?php if ($resort['image_url']): ?>
            <img src="<?= htmlspecialchars($resort['image_url']) ?>" style="margin-top:10px;width:200px;border-radius:8px" alt="Preview">
            <?php endif; ?>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Badge</label>
                <input type="text" name="badge" class="form-control" value="<?= htmlspecialchars($resort['badge']) ?>">
            </div>
            <div class="form-group">
                <label>Features</label>
                <input type="text" name="features" class="form-control" value="<?= htmlspecialchars($resort['features']) ?>">
                <div class="form-hint">Pisahkan dengan koma</div>
            </div>
        </div>
        <div style="margin-top:8px">
            <button type="submit" class="btn-submit">Update Resort</button>
            <a href="index.php?page=admin&section=resorts" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>
