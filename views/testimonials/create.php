<?php // views/testimonials/create.php ?>
<div class="topbar">
    <div><h1>💬 Add New Testimonial</h1><p>Tambah testimonial baru</p></div>
</div>
<div class="form-card">
    <form method="POST" action="index.php?page=admin&section=testimonials&action=create">
        <div class="form-row">
            <div class="form-group">
                <label>Name *</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Sarah & James" required>
            </div>
            <div class="form-group">
                <label>Origin *</label>
                <input type="text" name="origin" class="form-control" placeholder="e.g. United Kingdom" required>
            </div>
        </div>
        <div class="form-group">
            <label>Review Text *</label>
            <textarea name="review_text" class="form-control" rows="3" placeholder="Tulis ulasan..." required></textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Rating (1-5) *</label>
                <input type="number" name="rating" class="form-control" min="1" max="5" value="5" required>
            </div>
            <div class="form-group">
                <label>Trip Type</label>
                <select name="trip_type" class="form-control">
                    <option>Honeymoon</option>
                    <option>Family Trip</option>
                    <option>Solo Travel</option>
                    <option>Vacation</option>
                    <option>Business</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Avatar URL *</label>
            <input type="url" name="avatar_url" class="form-control" placeholder="https://..." required>
        </div>
        <div style="margin-top:8px">
            <button type="submit" class="btn-submit">Simpan Testimonial</button>
            <a href="index.php?page=admin&section=testimonials" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>
