<?php
/**
 * models/Resort.php
 * MODEL — urusan data resort dari database.
 * Di MVC, Model = class yang berinteraksi langsung dengan database.
 */
require_once __DIR__ . '/../config/database.php';

class ResortModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // READ — ambil semua resort
    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM resorts ORDER BY rating DESC");
        return $stmt->fetchAll();
    }

    // READ — ambil 1 resort by ID
    public function getById(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM resorts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // CREATE — tambah resort baru
    public function create(array $data): bool {
        $stmt = $this->db->prepare("
            INSERT INTO resorts (name, location, price_per_night, rating, image_url, badge, features)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['name'],
            $data['location'],
            $data['price_per_night'],
            $data['rating'],
            $data['image_url'],
            $data['badge']    ?? '',
            $data['features'] ?? '',
        ]);
    }

    // UPDATE — edit resort
    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare("
            UPDATE resorts
            SET name=?, location=?, price_per_night=?, rating=?, image_url=?, badge=?, features=?
            WHERE id=?
        ");
        return $stmt->execute([
            $data['name'],
            $data['location'],
            $data['price_per_night'],
            $data['rating'],
            $data['image_url'],
            $data['badge']    ?? '',
            $data['features'] ?? '',
            $id,
        ]);
    }

    // DELETE — hapus resort
    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM resorts WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
