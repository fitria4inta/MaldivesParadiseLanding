<?php // views/experiences/edit.php ?>
<div class="topbar">
    <div><h1>🤿 Edit Experience</h1><p>Update data experience</p></div>
</div>
<div class="form-card">
    <form method="POST" action="index.php?page=admin&section=experiences&action=edit&id=<?= $experience['id'] ?>">
        <div class="form-row">
            <div class="form-group">
                <label>Experience Name *</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($experience['name']) ?>" required>
            </div>
            <div class="form-group">
                <label>Icon (Emoji) *</label>
                <input type="text" name="icon" class="form-control" value="<?= htmlspecialchars($experience['icon']) ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label>Description *</label>
            <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($experience['description']) ?></textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Duration *</label>
                <input type="text" name="duration" class="form-control" value="<?= htmlspecialchars($experience['duration']) ?>" required>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="text" name="price" class="form-control" value="<?= htmlspecialchars($experience['price']) ?>">
            </div>
        </div>
        <div class="form-group">
            <label>Image URL *</label>
            <input type="url" name="image_url" class="form-control" value="<?= htmlspecialchars($experience['image_url']) ?>" required>
            <img src="<?= htmlspecialchars($experience['image_url']) ?>" style="margin-top:10px;width:200px;border-radius:8px" alt="Preview">
        </div>
        <div style="margin-top:8px">
            <button type="submit" class="btn-submit">Update Experience</button>
            <a href="index.php?page=admin&section=experiences" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>
