<?php
/**
 * controllers/GalleryController.php
 * CONTROLLER — jembatan antara Model dan View untuk Gallery.
 */
require_once __DIR__ . '/../models/Gallery.php';

class GalleryController {
    private GalleryModel $model;

    public function __construct() {
        ob_start();
        $this->model = new GalleryModel();
    }

    public function index(): array {
        return $this->model->getAll();
    }

    public function create(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
            header('Location: index.php?page=admin&section=gallery&msg=created');
            exit;
        }
        require_once __DIR__ . '/../views/gallery/create.php';
    }

    public function edit(int $id): void {
        $item = $this->model->getById($id);
        if (!$item) {
            header('Location: index.php?page=admin&section=gallery&msg=notfound');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            header('Location: index.php?page=admin&section=gallery&msg=updated');
            exit;
        }
        require_once __DIR__ . '/../views/gallery/edit.php';
    }

    public function delete(int $id): void {
        $this->model->delete($id);
        header('Location: index.php?page=admin&section=gallery&msg=deleted');
        exit;
    }

    public function adminList(): array {
        return $this->model->getAll();
    }
}
