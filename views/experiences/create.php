<?php // views/experiences/create.php ?>
<div class="topbar">
    <div><h1>🤿 Add New Experience</h1><p>Tambah experience baru</p></div>
</div>
<div class="form-card">
    <form method="POST" action="index.php?page=admin&section=experiences&action=create">
        <div class="form-row">
            <div class="form-group">
                <label>Experience Name *</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Snorkeling" required>
            </div>
            <div class="form-group">
                <label>Icon (Emoji) *</label>
                <input type="text" name="icon" class="form-control" placeholder="e.g. 🤿" required>
            </div>
        </div>
        <div class="form-group">
            <label>Description *</label>
            <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat..." required></textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Duration *</label>
                <input type="text" name="duration" class="form-control" placeholder="e.g. 2-3 hours" required>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="text" name="price" class="form-control" placeholder="e.g. From $80">
            </div>
        </div>
        <div class="form-group">
            <label>Image URL *</label>
            <input type="url" name="image_url" class="form-control" placeholder="https://..." required>
        </div>
        <div style="margin-top:8px">
            <button type="submit" class="btn-submit">Simpan Experience</button>
            <a href="index.php?page=admin&section=experiences" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>
