<?php
// views/resorts/create.php
// Ini bagian dari admin.php layout, dipanggil oleh ResortController
?>
<div class="topbar">
    <div><h1>🏨 Add New Resort</h1><p>Tambah resort baru</p></div>
</div>
<div class="form-card">
    <form method="POST" action="index.php?page=admin&section=resorts&action=create">
        <div class="form-row">
            <div class="form-group">
                <label>Resort Name *</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Soneva Jani" required>
            </div>
            <div class="form-group">
                <label>Location *</label>
                <input type="text" name="location" class="form-control" placeholder="e.g. Noonu Atoll" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Price Per Night (USD) *</label>
                <input type="number" name="price_per_night" class="form-control" placeholder="e.g. 2800" min="0" required>
            </div>
            <div class="form-group">
                <label>Rating *</label>
                <input type="number" name="rating" class="form-control" placeholder="e.g. 4.9" min="1" max="5" step="0.1" required>
            </div>
        </div>
        <div class="form-group">
            <label>Image URL *</label>
            <input type="url" name="image_url" class="form-control" placeholder="https://..." required>
            <div class="form-hint">Gunakan link dari Unsplash atau URL gambar lainnya</div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Badge</label>
                <input type="text" name="badge" class="form-control" placeholder="e.g. ⭐ Top Pick">
            </div>
            <div class="form-group">
                <label>Features</label>
                <input type="text" name="features" class="form-control" placeholder="e.g. Overwater Villa,Private Pool">
                <div class="form-hint">Pisahkan dengan koma</div>
            </div>
        </div>
        <div style="margin-top:8px">
            <button type="submit" class="btn-submit">Simpan Resort</button>
            <a href="index.php?page=admin&section=resorts" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>
