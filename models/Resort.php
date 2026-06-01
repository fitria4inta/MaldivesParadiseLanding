<?php
/**
 * models/Resort.php
 * EXTENDS BaseModel → Inheritance
 */
require_once __DIR__ . '/BaseModel.php';
 
class ResortModel extends BaseModel {
 
    public function __construct() {
        parent::__construct(); // panggil constructor BaseModel
        $this->table = 'resorts';
    }
 
    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM resorts ORDER BY rating DESC");
        return $stmt->fetchAll();
    }
 
    public function getById(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM resorts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
 
    public function create(array $data): bool {
        $stmt = $this->db->prepare("
            INSERT INTO resorts (name, location, price_per_night, rating, image_url, badge, features)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['name'], $data['location'], $data['price_per_night'],
            $data['rating'], $data['image_url'],
            $data['badge'] ?? '', $data['features'] ?? '',
        ]);
    }
 
    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare("
            UPDATE resorts
            SET name=?, location=?, price_per_night=?, rating=?, image_url=?, badge=?, features=?
            WHERE id=?
        ");
        return $stmt->execute([
            $data['name'], $data['location'], $data['price_per_night'],
            $data['rating'], $data['image_url'],
            $data['badge'] ?? '', $data['features'] ?? '', $id,
        ]);
    }
 
    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM resorts WHERE id = ?");
        return $stmt->execute([$id]);
    }
}