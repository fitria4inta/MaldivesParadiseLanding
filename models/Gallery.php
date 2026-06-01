<?php
/**
 * models/Gallery.php
 * EXTENDS BaseModel → Inheritance
 */
require_once __DIR__ . '/BaseModel.php';
 
class GalleryModel extends BaseModel {
 
    public function __construct() {
        parent::__construct();
        $this->table = 'gallery';
    }
 
    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM gallery ORDER BY id ASC");
        return $stmt->fetchAll();
    }
 
    public function getById(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM gallery WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
 
    public function create(array $data): bool {
        $stmt = $this->db->prepare("INSERT INTO gallery (image_url, alt_text) VALUES (?, ?)");
        return $stmt->execute([$data['image_url'], $data['alt_text']]);
    }
 
    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare("UPDATE gallery SET image_url=?, alt_text=? WHERE id=?");
        return $stmt->execute([$data['image_url'], $data['alt_text'], $id]);
    }
 
    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM gallery WHERE id = ?");
        return $stmt->execute([$id]);
    }
}