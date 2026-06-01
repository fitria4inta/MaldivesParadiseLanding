<?php
/**
 * models/Experience.php
 * EXTENDS BaseModel → Inheritance
 */
require_once __DIR__ . '/BaseModel.php';
 
class ExperienceModel extends BaseModel {
 
    public function __construct() {
        parent::__construct();
        $this->table = 'experiences';
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
            $data['name'], $data['description'], $data['icon'],
            $data['duration'], $data['image_url'], $data['price'] ?? '',
        ]);
    }
 
    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare("
            UPDATE experiences
            SET name=?, description=?, icon=?, duration=?, image_url=?, price=?
            WHERE id=?
        ");
        return $stmt->execute([
            $data['name'], $data['description'], $data['icon'],
            $data['duration'], $data['image_url'], $data['price'] ?? '', $id,
        ]);
    }
 
    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM experiences WHERE id = ?");
        return $stmt->execute([$id]);
    }
}