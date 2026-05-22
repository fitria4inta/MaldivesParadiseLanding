<?php // views/gallery/create.php ?>
<div class="topbar">
    <div><h1>🖼️ Add New Photo</h1><p>Tambah foto gallery baru</p></div>
</div>
<div class="form-card">
    <form method="POST" action="index.php?page=admin&section=gallery&action=create">
        <div class="form-group">
            <label>Image URL *</label>
            <input type="url" name="image_url" class="form-control" placeholder="https://..." required>
            <div class="form-hint">Gunakan link dari Unsplash atau URL gambar lainnya</div>
        </div>
        <div class="form-group">
            <label>Alt Text *</label>
            <input type="text" name="alt_text" class="form-control" placeholder="e.g. Overwater Bungalows" required>
            <div class="form-hint">Deskripsi singkat foto untuk aksesibilitas</div>
        </div>
        <div style="margin-top:8px">
            <button type="submit" class="btn-submit">Simpan Foto</button>
            <a href="index.php?page=admin&section=gallery" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>
