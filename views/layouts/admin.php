<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel — Maldives Paradise</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ocean: #0a4f6e; --ocean-lt: #1a7fa8; --gold: #c9983a;
            --gold-lt: #e8b84b; --dark: #0d1b2a; --gray: #6b7a8d;
            --sand: #f5f0e8; --white: #fff; --red: #e53935; --green: #2e7d32;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Poppins', sans-serif; background: #f0f4f8; color: var(--dark); }
        a { text-decoration: none; color: inherit; }

        /* LAYOUT */
        .admin-wrap { display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            width: 260px; background: var(--dark); color: #fff;
            padding: 0; position: fixed; top: 0; left: 0; height: 100vh;
            display: flex; flex-direction: column;
        }
        .sidebar-logo {
            padding: 28px 24px; border-bottom: 1px solid rgba(255,255,255,0.08);
            font-size: 20px; font-weight: 700; color: var(--gold-lt);
        }
        .sidebar-logo span { font-size: 13px; display: block; color: rgba(255,255,255,0.5); font-weight: 400; margin-top: 2px; }
        .sidebar-nav { padding: 16px 0; flex: 1; }
        .nav-label { font-size: 10px; font-weight: 600; letter-spacing: 2px; color: rgba(255,255,255,0.35); padding: 16px 24px 8px; text-transform: uppercase; }
        .nav-item {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 24px; font-size: 14px; font-weight: 500;
            color: rgba(255,255,255,0.7); transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .nav-item:hover, .nav-item.active {
            background: rgba(255,255,255,0.07); color: #fff;
            border-left-color: var(--gold-lt);
        }
        .nav-item .icon { font-size: 18px; width: 24px; text-align: center; }
        .sidebar-footer { padding: 20px 24px; border-top: 1px solid rgba(255,255,255,0.08); }
        .back-btn {
            display: flex; align-items: center; gap: 8px;
            font-size: 13px; color: rgba(255,255,255,0.5); transition: all 0.2s;
        }
        .back-btn:hover { color: var(--gold-lt); }

        /* MAIN */
        .main { margin-left: 260px; flex: 1; padding: 32px; }

        /* TOPBAR */
        .topbar {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 32px;
        }
        .topbar h1 { font-size: 24px; font-weight: 700; }
        .topbar p  { font-size: 14px; color: var(--gray); margin-top: 2px; }
        .btn-add {
            background: linear-gradient(135deg, var(--gold), var(--gold-lt));
            color: var(--dark); font-weight: 700; font-size: 14px;
            padding: 10px 24px; border-radius: 10px; border: none;
            cursor: pointer; transition: all 0.2s; text-decoration: none;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-add:hover { transform: translateY(-1px); box-shadow: 0 4px 16px rgba(201,152,58,0.4); }

        /* ALERT */
        .alert {
            padding: 14px 20px; border-radius: 10px; margin-bottom: 24px;
            font-size: 14px; font-weight: 500;
        }
        .alert-success { background: #e8f5e9; color: var(--green); border: 1px solid #a5d6a7; }
        .alert-danger  { background: #ffebee; color: var(--red);   border: 1px solid #ef9a9a; }

        /* STATS CARDS */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 32px; }
        .stat-card {
            background: var(--white); border-radius: 14px; padding: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }
        .stat-card .stat-icon { font-size: 32px; margin-bottom: 12px; }
        .stat-card .stat-num  { font-size: 28px; font-weight: 800; color: var(--ocean); }
        .stat-card .stat-lbl  { font-size: 13px; color: var(--gray); margin-top: 4px; }

        /* TABLE */
        .table-card {
            background: var(--white); border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06); overflow: hidden;
        }
        .table-header {
            padding: 20px 24px; border-bottom: 1px solid #eef2f7;
            display: flex; justify-content: space-between; align-items: center;
        }
        .table-header h2 { font-size: 16px; font-weight: 700; }
        table { width: 100%; border-collapse: collapse; }
        th {
            background: #f8fafc; padding: 12px 16px; text-align: left;
            font-size: 12px; font-weight: 600; color: var(--gray);
            text-transform: uppercase; letter-spacing: 0.5px;
        }
        td { padding: 14px 16px; font-size: 14px; border-top: 1px solid #eef2f7; vertical-align: middle; }
        tr:hover td { background: #fafbfc; }
        .td-img { width: 60px; height: 44px; border-radius: 8px; object-fit: cover; }
        .badge-pill {
            display: inline-block; font-size: 11px; font-weight: 600;
            padding: 3px 10px; border-radius: 20px;
            background: #e3f2fd; color: var(--ocean);
        }
        .rating-stars { color: var(--gold); font-size: 13px; }

        /* ACTION BUTTONS */
        .action-btns { display: flex; gap: 8px; }
        .btn-edit, .btn-del {
            padding: 6px 14px; border-radius: 8px; font-size: 12px;
            font-weight: 600; border: none; cursor: pointer; transition: all 0.2s;
            text-decoration: none; display: inline-block;
        }
        .btn-edit { background: #e3f2fd; color: var(--ocean); }
        .btn-edit:hover { background: var(--ocean); color: #fff; }
        .btn-del  { background: #ffebee; color: var(--red); }
        .btn-del:hover  { background: var(--red);   color: #fff; }

        /* FORM */
        .form-card {
            background: var(--white); border-radius: 14px;
            padding: 32px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            max-width: 700px;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: var(--dark); margin-bottom: 6px; }
        .form-control {
            width: 100%; padding: 11px 14px; border: 1.5px solid #e5e9ef;
            border-radius: 10px; font-family: 'Poppins', sans-serif;
            font-size: 14px; transition: all 0.2s; outline: none;
        }
        .form-control:focus { border-color: var(--ocean-lt); box-shadow: 0 0 0 3px rgba(26,127,168,0.1); }
        .form-hint { font-size: 12px; color: var(--gray); margin-top: 4px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .btn-submit {
            background: linear-gradient(135deg, var(--ocean), var(--ocean-lt));
            color: #fff; font-weight: 700; font-size: 15px;
            padding: 13px 32px; border-radius: 10px; border: none;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 4px 16px rgba(10,79,110,0.3); }
        .btn-cancel {
            background: #f0f4f8; color: var(--gray); font-weight: 600;
            font-size: 15px; padding: 13px 24px; border-radius: 10px;
            border: none; cursor: pointer; margin-left: 12px; text-decoration: none;
            display: inline-block;
        }

        @media (max-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .sidebar { width: 100%; height: auto; position: relative; }
            .main { margin-left: 0; padding: 16px; }
        }
    </style>
</head>
<body>
<div class="admin-wrap">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            🌴 Maldives Admin
            <span>Paradise Escape Panel</span>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-label">Dashboard</div>
            <a href="index.php?page=admin" class="nav-item <?= (!isset($_GET['section'])) ? 'active' : '' ?>">
                <span class="icon">📊</span> Overview
            </a>
            <div class="nav-label">Manage Data</div>
            <a href="index.php?page=admin&section=resorts" class="nav-item <?= (($_GET['section'] ?? '') === 'resorts') ? 'active' : '' ?>">
                <span class="icon">🏨</span> Resorts
            </a>
            <a href="index.php?page=admin&section=experiences" class="nav-item <?= (($_GET['section'] ?? '') === 'experiences') ? 'active' : '' ?>">
                <span class="icon">🤿</span> Experiences
            </a>
            <a href="index.php?page=admin&section=testimonials" class="nav-item <?= (($_GET['section'] ?? '') === 'testimonials') ? 'active' : '' ?>">
                <span class="icon">💬</span> Testimonials
            </a>
            <a href="index.php?page=admin&section=gallery" class="nav-item <?= (($_GET['section'] ?? '') === 'gallery') ? 'active' : '' ?>">
                <span class="icon">🖼️</span> Gallery
            </a>
        </nav>
        <div class="sidebar-footer">
            <a href="index.php" class="back-btn">← Back to Landing Page</a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main">
        <?php
        // Alert messages
        $msgs = [
            'created' => ['success', '✅ Data berhasil ditambahkan!'],
            'updated' => ['success', '✅ Data berhasil diupdate!'],
            'deleted' => ['success', '✅ Data berhasil dihapus!'],
            'notfound'=> ['danger',  '❌ Data tidak ditemukan.'],
        ];
        if (isset($_GET['msg']) && isset($msgs[$_GET['msg']])) {
            [$type, $text] = $msgs[$_GET['msg']];
            echo "<div class='alert alert-$type'>$text</div>";
        }

        $section = $_GET['section'] ?? '';

        // ── OVERVIEW ──────────────────────────────────────────────
        if ($section === '') {
            require_once __DIR__ . '/../../models/Resort.php';
            require_once __DIR__ . '/../../models/Experience.php';
            require_once __DIR__ . '/../../models/Testimonial.php';
            require_once __DIR__ . '/../../models/Gallery.php';
            $resortCount  = count((new ResortModel())->getAll());
            $expCount     = count((new ExperienceModel())->getAll());
            $testiCount   = count((new TestimonialModel())->getAll());
            $galleryCount = count((new GalleryModel())->getAll());
        ?>
        <div class="topbar">
            <div><h1>Dashboard Overview</h1><p>Welcome to Maldives Admin Panel</p></div>
        </div>
        <div class="stats-grid">
            <div class="stat-card"><div class="stat-icon">🏨</div><div class="stat-num"><?= $resortCount ?></div><div class="stat-lbl">Total Resorts</div></div>
            <div class="stat-card"><div class="stat-icon">🤿</div><div class="stat-num"><?= $expCount ?></div><div class="stat-lbl">Experiences</div></div>
            <div class="stat-card"><div class="stat-icon">💬</div><div class="stat-num"><?= $testiCount ?></div><div class="stat-lbl">Testimonials</div></div>
            <div class="stat-card"><div class="stat-icon">🖼️</div><div class="stat-num"><?= $galleryCount ?></div><div class="stat-lbl">Gallery Photos</div></div>
        </div>
        <?php } ?>

        <?php
        // ── RESORTS ───────────────────────────────────────────────
        if ($section === 'resorts') {
            require_once __DIR__ . '/../../controllers/ResortController.php';
            $ctrl   = new ResortController();
            $action = $_GET['action'] ?? 'list';
            $id     = isset($_GET['id']) ? (int)$_GET['id'] : 0;

            if ($action === 'create') { $ctrl->create(); }
            elseif ($action === 'edit' && $id) { $ctrl->edit($id); }
            elseif ($action === 'delete' && $id) { $ctrl->delete($id); }
            else {
                $resorts = $ctrl->adminList();
        ?>
        <div class="topbar">
            <div><h1>🏨 Resorts</h1><p>Manage resort data</p></div>
            <a href="index.php?page=admin&section=resorts&action=create" class="btn-add">+ Add Resort</a>
        </div>
        <div class="table-card">
            <table>
                <thead><tr><th>Image</th><th>Name</th><th>Location</th><th>Price/Night</th><th>Rating</th><th>Badge</th><th>Actions</th></tr></thead>
                <tbody>
                <?php foreach ($resorts as $r): ?>
                <tr>
                    <td><img src="<?= htmlspecialchars($r['image_url']) ?>" class="td-img" alt=""></td>
                    <td><b><?= htmlspecialchars($r['name']) ?></b></td>
                    <td><?= htmlspecialchars($r['location']) ?></td>
                    <td>$<?= number_format($r['price_per_night'], 0) ?></td>
                    <td><span class="rating-stars"><?= str_repeat('★', (int)$r['rating']) ?></span> <?= $r['rating'] ?></td>
                    <td><span class="badge-pill"><?= htmlspecialchars($r['badge']) ?></span></td>
                    <td>
                        <div class="action-btns">
                            <a href="index.php?page=admin&section=resorts&action=edit&id=<?= $r['id'] ?>" class="btn-edit">Edit</a>
                            <a href="index.php?page=admin&section=resorts&action=delete&id=<?= $r['id'] ?>" class="btn-del" onclick="return confirm('Hapus resort ini?')">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php } } ?>

        <?php
        // ── EXPERIENCES ───────────────────────────────────────────
        if ($section === 'experiences') {
            require_once __DIR__ . '/../../controllers/ExperienceController.php';
            $ctrl   = new ExperienceController();
            $action = $_GET['action'] ?? 'list';
            $id     = isset($_GET['id']) ? (int)$_GET['id'] : 0;

            if ($action === 'create') { $ctrl->create(); }
            elseif ($action === 'edit' && $id) { $ctrl->edit($id); }
            elseif ($action === 'delete' && $id) { $ctrl->delete($id); }
            else {
                $experiences = $ctrl->adminList();
        ?>
        <div class="topbar">
            <div><h1>🤿 Experiences</h1><p>Manage experience data</p></div>
            <a href="index.php?page=admin&section=experiences&action=create" class="btn-add">+ Add Experience</a>
        </div>
        <div class="table-card">
            <table>
                <thead><tr><th>Image</th><th>Name</th><th>Icon</th><th>Duration</th><th>Price</th><th>Actions</th></tr></thead>
                <tbody>
                <?php foreach ($experiences as $e): ?>
                <tr>
                    <td><img src="<?= htmlspecialchars($e['image_url']) ?>" class="td-img" alt=""></td>
                    <td><b><?= htmlspecialchars($e['name']) ?></b></td>
                    <td style="font-size:24px"><?= $e['icon'] ?></td>
                    <td><?= htmlspecialchars($e['duration']) ?></td>
                    <td><?= htmlspecialchars($e['price']) ?></td>
                    <td>
                        <div class="action-btns">
                            <a href="index.php?page=admin&section=experiences&action=edit&id=<?= $e['id'] ?>" class="btn-edit">Edit</a>
                            <a href="index.php?page=admin&section=experiences&action=delete&id=<?= $e['id'] ?>" class="btn-del" onclick="return confirm('Hapus experience ini?')">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php } } ?>

        <?php
        // ── TESTIMONIALS ──────────────────────────────────────────
        if ($section === 'testimonials') {
            require_once __DIR__ . '/../../controllers/TestimonialController.php';
            $ctrl   = new TestimonialController();
            $action = $_GET['action'] ?? 'list';
            $id     = isset($_GET['id']) ? (int)$_GET['id'] : 0;

            if ($action === 'create') { $ctrl->create(); }
            elseif ($action === 'edit' && $id) { $ctrl->edit($id); }
            elseif ($action === 'delete' && $id) { $ctrl->delete($id); }
            else {
                $testimonials = $ctrl->adminList();
        ?>
        <div class="topbar">
            <div><h1>💬 Testimonials</h1><p>Manage testimonial data</p></div>
            <a href="index.php?page=admin&section=testimonials&action=create" class="btn-add">+ Add Testimonial</a>
        </div>
        <div class="table-card">
            <table>
                <thead><tr><th>Avatar</th><th>Name</th><th>Origin</th><th>Rating</th><th>Trip Type</th><th>Actions</th></tr></thead>
                <tbody>
                <?php foreach ($testimonials as $t): ?>
                <tr>
                    <td><img src="<?= htmlspecialchars($t['avatar_url']) ?>" class="td-img" style="border-radius:50%" alt=""></td>
                    <td><b><?= htmlspecialchars($t['name']) ?></b></td>
                    <td><?= htmlspecialchars($t['origin']) ?></td>
                    <td><span class="rating-stars"><?= str_repeat('★', (int)$t['rating']) ?></span></td>
                    <td><span class="badge-pill"><?= htmlspecialchars($t['trip_type']) ?></span></td>
                    <td>
                        <div class="action-btns">
                            <a href="index.php?page=admin&section=testimonials&action=edit&id=<?= $t['id'] ?>" class="btn-edit">Edit</a>
                            <a href="index.php?page=admin&section=testimonials&action=delete&id=<?= $t['id'] ?>" class="btn-del" onclick="return confirm('Hapus testimonial ini?')">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php } } ?>

        <?php
        // ── GALLERY ───────────────────────────────────────────────
        if ($section === 'gallery') {
            require_once __DIR__ . '/../../controllers/GalleryController.php';
            $ctrl   = new GalleryController();
            $action = $_GET['action'] ?? 'list';
            $id     = isset($_GET['id']) ? (int)$_GET['id'] : 0;

            if ($action === 'create') { $ctrl->create(); }
            elseif ($action === 'edit' && $id) { $ctrl->edit($id); }
            elseif ($action === 'delete' && $id) { $ctrl->delete($id); }
            else {
                $gallery = $ctrl->adminList();
        ?>
        <div class="topbar">
            <div><h1>🖼️ Gallery</h1><p>Manage gallery photos</p></div>
            <a href="index.php?page=admin&section=gallery&action=create" class="btn-add">+ Add Photo</a>
        </div>
        <div class="table-card">
            <table>
                <thead><tr><th>Preview</th><th>Alt Text</th><th>Image URL</th><th>Actions</th></tr></thead>
                <tbody>
                <?php foreach ($gallery as $g): ?>
                <tr>
                    <td><img src="<?= htmlspecialchars($g['image_url']) ?>" class="td-img" alt=""></td>
                    <td><b><?= htmlspecialchars($g['alt_text']) ?></b></td>
                    <td style="font-size:12px;color:#999;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= htmlspecialchars($g['image_url']) ?></td>
                    <td>
                        <div class="action-btns">
                            <a href="index.php?page=admin&section=gallery&action=edit&id=<?= $g['id'] ?>" class="btn-edit">Edit</a>
                            <a href="index.php?page=admin&section=gallery&action=delete&id=<?= $g['id'] ?>" class="btn-del" onclick="return confirm('Hapus foto ini?')">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php } } ?>

    </main>
</div>
</body>
</html>
