<?php
/**
 * controllers/TestimonialController.php
 * CONTROLLER — jembatan antara Model dan View untuk Testimonial.
 */
require_once __DIR__ . '/../models/Testimonial.php';

class TestimonialController {
    private TestimonialModel $model;

    public function __construct() {
        $this->model = new TestimonialModel();
    }

    public function index(): array {
        return $this->model->getAll();
    }

    public function create(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
            header('Location: index.php?page=admin&section=testimonials&msg=created');
            exit;
        }
        require_once __DIR__ . '/../views/testimonials/create.php';
    }

    public function edit(int $id): void {
        $testimonial = $this->model->getById($id);
        if (!$testimonial) {
            header('Location: index.php?page=admin&section=testimonials&msg=notfound');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            header('Location: index.php?page=admin&section=testimonials&msg=updated');
            exit;
        }
        require_once __DIR__ . '/../views/testimonials/edit.php';
    }

    public function delete(int $id): void {
        $this->model->delete($id);
        header('Location: index.php?page=admin&section=testimonials&msg=deleted');
        exit;
    }

    public function adminList(): array {
        return $this->model->getAll();
    }
}
