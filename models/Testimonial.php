<?php
/**
 * models/Testimonial.php
 * MODEL — urusan data testimonial dari database.
 */
require_once __DIR__ . '/../config/database.php';

class TestimonialModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM testimonials ORDER BY id ASC");
        return $stmt->fetchAll();
    }

    public function getById(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM testimonials WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool {
        $stmt = $this->db->prepare("
            INSERT INTO testimonials (name, origin, review_text, rating, avatar_url, trip_type)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['name'],
            $data['origin'],
            $data['review_text'],
            $data['rating'],
            $data['avatar_url'],
            $data['trip_type'] ?? 'Vacation',
        ]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare("
            UPDATE testimonials
            SET name=?, origin=?, review_text=?, rating=?, avatar_url=?, trip_type=?
            WHERE id=?
        ");
        return $stmt->execute([
            $data['name'],
            $data['origin'],
            $data['review_text'],
            $data['rating'],
            $data['avatar_url'],
            $data['trip_type'] ?? 'Vacation',
            $id,
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM testimonials WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
