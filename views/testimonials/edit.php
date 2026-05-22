<?php // views/testimonials/edit.php ?>
<div class="topbar">
    <div><h1>💬 Edit Testimonial</h1><p>Update data testimonial</p></div>
</div>
<div class="form-card">
    <form method="POST" action="index.php?page=admin&section=testimonials&action=edit&id=<?= $testimonial['id'] ?>">
        <div class="form-row">
            <div class="form-group">
                <label>Name *</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($testimonial['name']) ?>" required>
            </div>
            <div class="form-group">
                <label>Origin *</label>
                <input type="text" name="origin" class="form-control" value="<?= htmlspecialchars($testimonial['origin']) ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label>Review Text *</label>
            <textarea name="review_text" class="form-control" rows="3" required><?= htmlspecialchars($testimonial['review_text']) ?></textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Rating (1-5) *</label>
                <input type="number" name="rating" class="form-control" min="1" max="5" value="<?= $testimonial['rating'] ?>" required>
            </div>
            <div class="form-group">
                <label>Trip Type</label>
                <select name="trip_type" class="form-control">
                    <?php foreach (['Honeymoon','Family Trip','Solo Travel','Vacation','Business'] as $type): ?>
                    <option <?= $testimonial['trip_type'] === $type ? 'selected' : '' ?>><?= $type ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Avatar URL *</label>
            <input type="url" name="avatar_url" class="form-control" value="<?= htmlspecialchars($testimonial['avatar_url']) ?>" required>
            <img src="<?= htmlspecialchars($testimonial['avatar_url']) ?>" style="margin-top:10px;width:60px;height:60px;border-radius:50%;object-fit:cover" alt="Preview">
        </div>
        <div style="margin-top:8px">
            <button type="submit" class="btn-submit">Update Testimonial</button>
            <a href="index.php?page=admin&section=testimonials" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>
