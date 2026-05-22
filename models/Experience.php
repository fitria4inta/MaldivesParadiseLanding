<?php
/**
 * models/Experience.php
 * MODEL — urusan data experience dari database.
 */
require_once __DIR__ . '/../config/database.php';

class ExperienceModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM experiences ORDER BY id ASC");
        return $stmt->fetchAll();
    }

    public function getById(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM experiences WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool {
        $stmt = $this->db->prepare("
            INSERT INTO experiences (name, description, icon, duration, image_url, price)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['name'],
            $data['description'],
            $data['icon'],
            $data['duration'],
            $data['image_url'],
            $data['price'] ?? '',
        ]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare("
            UPDATE experiences
            SET name=?, description=?, icon=?, duration=?, image_url=?, price=?
            WHERE id=?
        ");
        return $stmt->execute([
            $data['name'],
            $data['description'],
            $data['icon'],
            $data['duration'],
            $data['image_url'],
            $data['price'] ?? '',
            $id,
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM experiences WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
