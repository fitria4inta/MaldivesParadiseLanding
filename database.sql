-- ============================================================
--  FILE: database.sql
--  Jalankan file ini di terminal Laragon / phpMyAdmin
--  Cara: mysql -u root -p < database.sql
-- ============================================================

CREATE DATABASE IF NOT EXISTS maldives_landing CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE maldives_landing;

-- ── TABEL RESORTS ────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS resorts (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    name           VARCHAR(100)   NOT NULL,
    location       VARCHAR(100)   NOT NULL,
    price_per_night DECIMAL(10,2) NOT NULL,
    rating         DECIMAL(2,1)   NOT NULL,
    image_url      TEXT           NOT NULL,
    badge          VARCHAR(50)    DEFAULT '',
    features       VARCHAR(255)   DEFAULT '',
    created_at     TIMESTAMP      DEFAULT CURRENT_TIMESTAMP
);

-- ── TABEL EXPERIENCES ────────────────────────────────────────
CREATE TABLE IF NOT EXISTS experiences (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    description TEXT         NOT NULL,
    icon        VARCHAR(10)  NOT NULL,
    duration    VARCHAR(50)  NOT NULL,
    image_url   TEXT         NOT NULL,
    price       VARCHAR(50)  DEFAULT '',
    created_at  TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
);

-- ── TABEL TESTIMONIALS ───────────────────────────────────────
CREATE TABLE IF NOT EXISTS testimonials (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    origin      VARCHAR(100) NOT NULL,
    review_text TEXT         NOT NULL,
    rating      TINYINT      NOT NULL DEFAULT 5,
    avatar_url  TEXT         NOT NULL,
    trip_type   VARCHAR(50)  DEFAULT 'Vacation',
    created_at  TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
);

-- ── TABEL GALLERY ────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS gallery (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    image_url  TEXT         NOT NULL,
    alt_text   VARCHAR(100) NOT NULL,
    created_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
);

-- ============================================================
--  INSERT DATA
-- ============================================================

-- ── INSERT RESORTS ───────────────────────────────────────────
INSERT INTO resorts (name, location, price_per_night, rating, image_url, badge, features) VALUES
('Soneva Jani',      'Noonu Atoll',       2800.00, 5.0, 'https://images.unsplash.com/photo-1573843981267-be1999ff37cd?w=600&q=80', '⭐ Top Pick',      'Overwater Villa,Private Pool,Slide to Ocean'),
('Baros Maldives',   'North Malé Atoll',  1200.00, 4.9, 'https://images.unsplash.com/photo-1540202404-a2f29cf7eca7?w=600&q=80',    '🏆 Award Winner',  'Beach Villa,Spa,Fine Dining'),
('Gili Lankanfushi', 'North Malé Atoll',  2100.00, 4.9, 'https://images.unsplash.com/photo-1602002418816-5c0aeef426aa?w=600&q=80', '💍 Honeymoon',     'No News No Shoes,Island Dining,Water Sports'),
('Joali Maldives',   'Raa Atoll',         3200.00, 5.0, 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=600&q=80', '✨ Luxury',        'Private Beach,Art Collection,Underwater Bar');

-- ── INSERT EXPERIENCES ───────────────────────────────────────
INSERT INTO experiences (name, description, icon, duration, image_url, price) VALUES
('Snorkeling',     'Discover vibrant coral reefs and tropical fish.',            '🤿', '2-3 hours', 'https://images.unsplash.com/photo-1682687982501-1e58ab814714?w=500&q=80', 'From $80'),
('Scuba Diving',   'Explore the deep blue with certified instructors.',          '🐠', '3-4 hours', 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=500&q=80', 'From $150'),
('Sunset Cruise',  'Sail into a golden horizon on a private dhoni.',             '⛵', '2 hours',   'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=500&q=80', 'From $120'),
('Private Dinner', 'Dine under the stars on a secluded sandbank.',               '🍽️', 'Evening',   'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=500&q=80', 'From $250'),
('Spa Retreat',    'Rejuvenate with an over-water massage experience.',          '💆', 'Full day',  'https://images.unsplash.com/photo-1600334089648-b0d9d3028eb2?w=500&q=80', 'From $200');

-- ── INSERT TESTIMONIALS ──────────────────────────────────────
INSERT INTO testimonials (name, origin, review_text, rating, avatar_url, trip_type) VALUES
('Sarah & James', 'United Kingdom', 'Best honeymoon experience ever! The overwater villa was magical. We will definitely return for our anniversary.', 5, 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80', 'Honeymoon'),
('Reza Pratama',  'Indonesia',      'Pelayanannya luar biasa! Dari penjemputan speedboat sampai dinner di pantai, semua sempurna. Mimpi jadi nyata!',   5, 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80', 'Family Trip'),
('Emily Chen',    'Singapore',      'The snorkeling tour was breathtaking — crystal clear water and vibrant coral reefs. This place is truly paradise.', 5, 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&q=80', 'Solo Travel');

-- ── INSERT GALLERY ───────────────────────────────────────────
INSERT INTO gallery (image_url, alt_text) VALUES
('https://images.unsplash.com/photo-1514282401047-d79a71a590e8?w=800&q=80', 'Overwater Bungalows'),
('https://images.unsplash.com/photo-1573843981267-be1999ff37cd?w=400&q=80', 'Crystal Clear Water'),
('https://images.unsplash.com/photo-1602002418816-5c0aeef426aa?w=400&q=80', 'Tropical Sunset'),
('https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80', 'Beach Resort'),
('https://images.unsplash.com/photo-1540202404-a2f29cf7eca7?w=400&q=80',    'Ocean View'),
('https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=400&q=80', 'Private Pool Villa');
