<?php
/**
 * controllers/ExperienceController.php
 * CONTROLLER — jembatan antara Model dan View untuk Experience.
 */
require_once __DIR__ . '/../models/Experience.php';

class ExperienceController {
    private ExperienceModel $model;

    public function __construct() {
        $this->model = new ExperienceModel();
    }

    public function index(): array {
        return $this->model->getAll();
    }

    public function create(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
            header('Location: index.php?page=admin&section=experiences&msg=created');
            exit;
        }
        require_once __DIR__ . '/../views/experiences/create.php';
    }

    public function edit(int $id): void {
        $experience = $this->model->getById($id);
        if (!$experience) {
            header('Location: index.php?page=admin&section=experiences&msg=notfound');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            header('Location: index.php?page=admin&section=experiences&msg=updated');
            exit;
        }
        require_once __DIR__ . '/../views/experiences/edit.php';
    }

    public function delete(int $id): void {
        $this->model->delete($id);
        header('Location: index.php?page=admin&section=experiences&msg=deleted');
        exit;
    }

    public function adminList(): array {
        return $this->model->getAll();
    }
}
