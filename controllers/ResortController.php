<?php
/**
 * controllers/ResortController.php
 * CONTROLLER — jembatan antara Model dan View untuk Resort.
 * Menerima request dari user → ambil data dari Model → kirim ke View.
 */
require_once __DIR__ . '/../models/Resort.php';

class ResortController {
    private ResortModel $model;

    public function __construct() {
        $this->model = new ResortModel();
    }

    // Tampilkan semua resort (untuk landing page)
    public function index(): array {
        return $this->model->getAll();
    }

    // Tampilkan form tambah + proses tambah
    public function create(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
            header('Location: index.php?page=admin&section=resorts&msg=created');
            exit;
        }
        require_once __DIR__ . '/../views/resorts/create.php';
    }

    // Tampilkan form edit + proses edit
    public function edit(int $id): void {
        $resort = $this->model->getById($id);
        if (!$resort) {
            header('Location: index.php?page=admin&section=resorts&msg=notfound');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            header('Location: index.php?page=admin&section=resorts&msg=updated');
            exit;
        }
        require_once __DIR__ . '/../views/resorts/edit.php';
    }

    // Proses hapus
    public function delete(int $id): void {
        $this->model->delete($id);
        header('Location: index.php?page=admin&section=resorts&msg=deleted');
        exit;
    }

    // List semua resort untuk panel admin
    public function adminList(): array {
        return $this->model->getAll();
    }
}
