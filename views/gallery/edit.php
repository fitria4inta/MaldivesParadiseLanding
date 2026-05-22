<?php // views/gallery/edit.php ?>
<div class="topbar">
    <div><h1>🖼️ Edit Photo</h1><p>Update data foto gallery</p></div>
</div>
<div class="form-card">
    <form method="POST" action="index.php?page=admin&section=gallery&action=edit&id=<?= $item['id'] ?>">
        <div class="form-group">
            <label>Image URL *</label>
            <input type="url" name="image_url" class="form-control" value="<?= htmlspecialchars($item['image_url']) ?>" required>
            <img src="<?= htmlspecialchars($item['image_url']) ?>" style="margin-top:10px;width:200px;border-radius:8px" alt="Preview">
        </div>
        <div class="form-group">
            <label>Alt Text *</label>
            <input type="text" name="alt_text" class="form-control" value="<?= htmlspecialchars($item['alt_text']) ?>" required>
        </div>
        <div style="margin-top:8px">
            <button type="submit" class="btn-submit">Update Foto</button>
            <a href="index.php?page=admin&section=gallery" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>
