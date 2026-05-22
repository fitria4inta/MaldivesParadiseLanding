 <?php
/**
 * ============================================================
 *  INDEX.PHP — Entry Point Utama (MVC Version)
 * ============================================================
 *
 *  STRUKTUR FOLDER:
 *  maldives-mvc/
 *  ├── index.php                     ← Kamu di sini
 *  ├── database.sql                  ← Jalankan ini di Laragon dulu
 *  ├── config/
 *  │   └── database.php              ← Koneksi PDO
 *  ├── models/                       ← M (Model) — urusan database
 *  │   ├── Resort.php
 *  │   ├── Experience.php
 *  │   ├── Testimonial.php
 *  │   └── Gallery.php
 *  ├── views/                        ← V (View) — urusan tampilan
 *  │   ├── layouts/admin.php
 *  │   ├── resorts/create.php, edit.php
 *  │   ├── experiences/create.php, edit.php
 *  │   ├── testimonials/create.php, edit.php
 *  │   └── gallery/create.php, edit.php
 *  ├── controllers/                  ← C (Controller) — jembatan M & V
 *  │   ├── ResortController.php
 *  │   ├── ExperienceController.php
 *  │   ├── TestimonialController.php
 *  │   └── GalleryController.php
 *  └── assets/css, js, images/
 */

// ── Routing sederhana ─────────────────────────────────────────
$page = $_GET['page'] ?? 'home';

// Halaman Admin Panel
if ($page === 'admin') {
    require_once 'views/layouts/admin.php';
    exit;
}

// ── Load Controllers untuk landing page ──────────────────────
require_once 'controllers/ResortController.php';
require_once 'controllers/ExperienceController.php';
require_once 'controllers/TestimonialController.php';
require_once 'controllers/GalleryController.php';

// Ambil data dari database via Controller
$resortCtrl  = new ResortController();
$expCtrl     = new ExperienceController();
$testiCtrl   = new TestimonialController();
$galleryCtrl = new GalleryController();

$resorts      = $resortCtrl->index();
$experiences  = $expCtrl->index();
$testimonials = $testiCtrl->index();
$gallery      = $galleryCtrl->index();

// Helper functions
function renderStars(float $rating): string {
    return str_repeat('★', (int)$rating) . str_repeat('☆', 5 - (int)$rating);
}
function formatPrice(float $price): string {
    return '$' . number_format($price, 0);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Escape to paradise. Discover luxury resorts in the Maldives.">
    <title>Maldives — Luxury Paradise Escape</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Admin link floating button */
        .admin-fab {
            position: fixed; bottom: 32px; right: 32px; z-index: 999;
            background: linear-gradient(135deg, #0a4f6e, #1a7fa8);
            color: #fff; font-size: 13px; font-weight: 700;
            padding: 12px 20px; border-radius: 50px;
            box-shadow: 0 4px 20px rgba(10,79,110,0.4);
            text-decoration: none; transition: all 0.3s;
            display: flex; align-items: center; gap: 8px;
        }
        .admin-fab:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(10,79,110,0.5); }
    </style>
</head>
<body>

<!-- ── NAVBAR ─────────────────────────────────────────────── -->
<nav class="navbar" id="navbar">
    <div class="nav-inner">
        <a href="#" class="nav-logo">
            <span class="logo-icon">🌴</span>
            <div class="logo-text">
                <span class="logo-main">Maldives</span>
                <span class="logo-sub">PARADISE ESCAPE</span>
            </div>
        </a>
        <div class="nav-links" id="navLinks">
            <a href="#home">Home</a>
            <a href="#resorts">Resorts</a>
            <a href="#packages">Packages</a>
            <a href="#experiences">Experiences</a>
            <a href="#reviews">Reviews</a>
            <a href="#contact">Contact</a>
        </div>
        <div class="nav-right">
            <button class="btn-book" onclick="scrollToBooking()">Book Now</button>
            <button class="nav-toggle" id="navToggle" onclick="toggleNav()">☰</button>
        </div>
    </div>
</nav>

<!-- ── HERO ───────────────────────────────────────────────── -->
<section class="hero" id="home">
    <div class="hero-bg">
        <img src="https://images.unsplash.com/photo-1514282401047-d79a71a590e8?w=1920&q=90" alt="Maldives Paradise" class="hero-img">
        <div class="hero-overlay"></div>
    </div>
    <div class="hero-content">
        <p class="hero-eyebrow">✦ YOUR DREAM VACATION ✦</p>
        <h1 class="hero-title">Escape to<br><em>Paradise</em></h1>
        <p class="hero-sub">Discover the breathtaking beauty of Maldives.<br>Luxury resorts, crystal clear water, and unforgettable moments.</p>
        <div class="hero-btns">
            <button class="btn-primary" onclick="document.getElementById('packages').scrollIntoView({behavior:'smooth'})">Explore Packages →</button>
            <button class="btn-ghost">▶ Watch Video</button>
        </div>
        <div class="hero-stats">
            <div class="stat"><b>10K+</b><span>Happy Travelers</span></div>
            <div class="stat-divider"></div>
            <div class="stat"><b><?= count($resorts) ?>+</b><span>Luxury Resorts</span></div>
            <div class="stat-divider"></div>
            <div class="stat"><b>4.9★</b><span>Average Rating</span></div>
        </div>
    </div>
    <div class="hero-scroll"><div class="scroll-line"></div><span>Scroll</span></div>
</section>

<!-- ── BOOKING BAR ────────────────────────────────────────── -->
<section class="booking-bar" id="booking">
    <div class="booking-glass">
        <div class="booking-field">
            <label>📍 Destination</label>
            <select><option>Maldives</option><option>North Malé Atoll</option><option>South Malé Atoll</option><option>Baa Atoll</option></select>
        </div>
        <div class="booking-divider"></div>
        <div class="booking-field">
            <label>📅 Check In</label>
            <input type="date" id="checkin">
        </div>
        <div class="booking-divider"></div>
        <div class="booking-field">
            <label>📅 Check Out</label>
            <input type="date" id="checkout">
        </div>
        <div class="booking-divider"></div>
        <div class="booking-field">
            <label>👥 Guests</label>
            <select><option>2 Adults, 0 Child</option><option>2 Adults, 1 Child</option><option>1 Adult</option></select>
        </div>
        <button class="btn-search">🔍 Search</button>
    </div>
</section>

<!-- ── POPULAR RESORTS ────────────────────────────────────── -->
<section class="resorts-section" id="resorts">
    <div class="section-header">
        <p class="section-eyebrow">POPULAR RESORTS</p>
        <h2>Discover Our Best Resorts</h2>
        <div class="section-line"></div>
    </div>
    <div class="resorts-grid">
        <?php foreach ($resorts as $r):
            $features = array_map('trim', explode(',', $r['features']));
            $featureTags = implode('', array_map(fn($f) => "<span class='feature-tag'>$f</span>", $features));
            $badge = $r['badge'] ? "<span class='resort-badge'>{$r['badge']}</span>" : '';
        ?>
        <div class="resort-card">
            <div class="resort-img-wrap">
                <img src="<?= htmlspecialchars($r['image_url']) ?>" alt="<?= htmlspecialchars($r['name']) ?>" loading="lazy">
                <?= $badge ?>
                <button class="wishlist-btn">♡</button>
            </div>
            <div class="resort-info">
                <div class="resort-meta">
                    <span class="resort-location">📍 <?= htmlspecialchars($r['location']) ?></span>
                    <span class="resort-rating"><?= renderStars($r['rating']) ?> <b><?= $r['rating'] ?></b></span>
                </div>
                <h3 class="resort-name"><?= htmlspecialchars($r['name']) ?></h3>
                <div class="resort-features"><?= $featureTags ?></div>
                <div class="resort-footer">
                    <div class="resort-price">
                        <span class="from">From</span>
                        <span class="price"><?= formatPrice($r['price_per_night']) ?></span>
                        <span class="per">/night</span>
                    </div>
                    <button class="btn-view">View Details →</button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- ── EXPERIENCES ────────────────────────────────────────── -->
<section class="experiences-section" id="experiences">
    <div class="container">
        <div class="section-header">
            <p class="section-eyebrow">WHAT TO DO</p>
            <h2>Unforgettable Experiences</h2>
            <div class="section-line"></div>
        </div>
    </div>
    <div class="exp-grid" style="max-width:1200px;margin:0 auto;padding:0 24px">
        <?php foreach ($experiences as $e): ?>
        <div class="exp-card">
            <div class="exp-img-wrap">
                <img src="<?= htmlspecialchars($e['image_url']) ?>" alt="<?= htmlspecialchars($e['name']) ?>">
                <div class="exp-overlay"><span class="exp-icon"><?= $e['icon'] ?></span></div>
            </div>
            <div class="exp-body">
                <h3><?= htmlspecialchars($e['name']) ?></h3>
                <p><?= htmlspecialchars($e['description']) ?></p>
                <div class="exp-meta">
                    <span>⏱ <?= htmlspecialchars($e['duration']) ?></span>
                    <?php if ($e['price']): ?><span class="exp-price"><?= htmlspecialchars($e['price']) ?></span><?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- ── WHY CHOOSE US ──────────────────────────────────────── -->
<section class="why-us" id="about">
    <div class="container">
        <div class="section-header">
            <p class="section-eyebrow">WHY CHOOSE US</p>
            <h2>The Maldives Expert<br>You Can Trust</h2>
            <div class="section-line"></div>
        </div>
        <div class="why-grid">
            <?php
            $whyItems = [
                ['🌴','Luxury Resorts','Handpicked top resorts for unmatched luxury experience.'],
                ['🛡️','Best Price','Get the best price guarantee for your dream vacation.'],
                ['🎧','24/7 Support','We are here to help you anytime, anywhere.'],
                ['🔒','Secure Booking','Book your trip easily and securely with us.'],
                ['✈️','Private Transfers','Speedboat and seaplane transfers arranged for you.'],
                ['🏅','Trusted Agency','Over 10 years of crafting perfect Maldives getaways.'],
            ];
            foreach ($whyItems as $w): ?>
            <div class="why-card">
                <div class="why-icon"><?= $w[0] ?></div>
                <h3><?= $w[1] ?></h3>
                <p><?= $w[2] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── TESTIMONIALS ───────────────────────────────────────── -->
<section class="testimonials" id="reviews">
    <div class="container">
        <div class="section-header">
            <p class="section-eyebrow">HAPPY TRAVELERS</p>
            <h2>What Our Guests Say</h2>
            <div class="section-line"></div>
        </div>
    </div>
    <div class="testi-grid" style="max-width:1200px;margin:0 auto;padding:0 24px">
        <?php foreach ($testimonials as $t): ?>
        <div class="testi-card">
            <div class="testi-stars"><?= renderStars($t['rating']) ?></div>
            <p class="testi-text">"<?= htmlspecialchars($t['review_text']) ?>"</p>
            <div class="testi-footer">
                <img src="<?= htmlspecialchars($t['avatar_url']) ?>" alt="<?= htmlspecialchars($t['name']) ?>" class="testi-avatar">
                <div class="testi-info">
                    <strong><?= htmlspecialchars($t['name']) ?></strong>
                    <span><?= htmlspecialchars($t['origin']) ?> · <?= htmlspecialchars($t['trip_type']) ?></span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- ── GALLERY ────────────────────────────────────────────── -->
<section class="gallery-section" id="packages">
    <div class="container">
        <div class="section-header">
            <p class="section-eyebrow">GALLERY</p>
            <h2>A Glimpse of Paradise</h2>
            <div class="section-line"></div>
        </div>
    </div>
    <div class="gallery-grid" style="max-width:1200px;margin:0 auto;padding:0 24px">
        <?php foreach ($gallery as $g): ?>
        <div class="gallery-item">
            <img src="<?= htmlspecialchars($g['image_url']) ?>" alt="<?= htmlspecialchars($g['alt_text']) ?>" loading="lazy">
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- ── CTA ────────────────────────────────────────────────── -->
<section class="cta-section">
    <div class="cta-bg">
        <img src="https://images.unsplash.com/photo-1540202404-a2f29cf7eca7?w=1600&q=80" alt="Maldives Sunset">
        <div class="cta-overlay"></div>
    </div>
    <div class="cta-content">
        <p class="cta-eyebrow">✦ START YOUR JOURNEY ✦</p>
        <h2>Ready for Your<br><em>Dream Vacation?</em></h2>
        <p>Let us craft the perfect Maldives escape for you.</p>
        <div class="cta-btns">
            <button class="btn-primary" onclick="scrollToBooking()">Book Your Escape</button>
            <button class="btn-ghost-light">Contact Us</button>
        </div>
    </div>
</section>

<!-- ── FOOTER ─────────────────────────────────────────────── -->
<footer class="footer" id="contact">
    <div class="footer-top">
        <div class="footer-brand">
            <div class="footer-logo">🌴 Maldives</div>
            <p>Crafting unforgettable luxury escapes to the most beautiful islands on Earth.</p>
            <div class="social-links">
                <a href="#" class="social-btn">📘</a>
                <a href="#" class="social-btn">📸</a>
                <a href="#" class="social-btn">🐦</a>
                <a href="#" class="social-btn">▶️</a>
            </div>
        </div>
        <div class="footer-links">
            <h4>Quick Links</h4>
            <a href="#home">Home</a><a href="#resorts">Resorts</a>
            <a href="#packages">Packages</a><a href="#experiences">Experiences</a>
            <a href="#reviews">Reviews</a>
        </div>
        <div class="footer-links">
            <h4>Services</h4>
            <a href="#">Honeymoon Packages</a><a href="#">Private Island</a>
            <a href="#">Overwater Villas</a><a href="#">Diving &amp; Snorkeling</a>
        </div>
        <div class="footer-contact">
            <h4>Contact</h4>
            <p>📧 hello@maldivesparadise.com</p>
            <p>📞 +60 3-1234 5678</p>
            <p>📍 Malé, Republic of Maldives</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© <?= date('Y') ?> Maldives Paradise Escape. All rights reserved.</p>
        <div class="footer-bottom-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
        </div>
    </div>
</footer>

<!-- Admin Panel FAB -->
<a href="index.php?page=admin" class="admin-fab">⚙️ Admin Panel</a>

<script src="assets/js/main.js"></script>
</body>
</html>
