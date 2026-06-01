<?php
/**
 * models/BaseModel.php
 * BASE CLASS (Parent) untuk semua Model.
 * 
 * KONSEP PBO — INHERITANCE:
 * Class ini diwarisi oleh ResortModel, ExperienceModel,
 * TestimonialModel, dan GalleryModel.
 * 
 * Semua model punya kebutuhan yang sama yaitu koneksi database,
 * jadi koneksinya disimpan di sini agar tidak perlu ditulis
 * berulang di setiap model (DRY - Don't Repeat Yourself).
 */
require_once __DIR__ . '/../config/database.php';

class BaseModel {
    // PROTECTED = bisa diakses oleh class ini dan semua child class
    protected PDO $db;
    protected string $table; // nama tabel, di-set oleh masing-masing child

    // CONSTRUCTOR — dipanggil otomatis, termasuk saat child class dibuat
    public function __construct() {
        $this->db = Database::getInstance();
    }

    // METHOD yang bisa dipakai semua child class
    // Hitung jumlah data di tabel
    public function count(): int {
        $stmt = $this->db->query("SELECT COUNT(*) FROM {$this->table}");
        return (int) $stmt->fetchColumn();
    }

    // Cek apakah data dengan ID tertentu ada
    public function exists(int $id): bool {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return (int) $stmt->fetchColumn() > 0;
    }
}
