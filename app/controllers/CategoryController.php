<?php
require_once 'app/models/categoryModel.php';
require_once 'app/views/categoryView.php';

class CategoryController {
    private $response;
    private $categoryModel;
    private $categoryView;

    public function __construct($response, $user = null) {
        $this->response = $response;
        $this->categoryModel = new CategoryModel();
        $this->categoryView = new CategoryView($user);
    }

    public function showCategories() {
        $categories = $this->categoryModel->getAllCategories();
        $this->categoryView->showCategories($categories);
    }

    public function showAddCategory() {
        $this->categoryView->showAddCategory();
    }

    public function addCategory() {
        $name = $_POST['Nombre'];
        $anio = $_POST['Anio'];
        $capacidad = $_POST['Capacidad'];
        $combustible = $_POST['Combustible'];

        if ($this->categoryModel->addCategory($name, $anio, $capacidad, $combustible)) {
            header('Location: ' . BASE_URL . 'showCategories');
        } else {
            $this->categoryView->showAddCategory(true, "Error al agregar la categoría.");
        }
    }

    public function showUpdateCategory($id) {
        $category = $this->categoryModel->getCategoryById($id);
        $this->categoryView->showUpdateCategory($category);
    }

    public function updateCategory() {
        $id = $_POST['id'];
        $name = $_POST['Nombre'];
        $anio = $_POST['Anio'];
        $capacidad = $_POST['Capacidad'];
        $combustible = $_POST['Combustible'];

        if ($this->categoryModel->updateCategory($id, $name, $anio, $capacidad, $combustible)) {
            header('Location: ' . BASE_URL . 'showCategories');
        } else {
            $this->categoryView->showUpdateCategory($this->categoryModel->getCategoryById($id), true, "Error al actualizar la categoría.");
        }
    }

    public function deleteCategory($id) {
        if ($this->categoryModel->deleteCategory($id)) {
            header('Location: ' . BASE_URL . 'showCategories');
        } else {
            $this->categoryView->showCategories($this->categoryModel->getAllCategories(), true);
        }
    }
}
?>







