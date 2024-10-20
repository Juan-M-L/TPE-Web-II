<?php
require_once 'app/models/categoryModel.php';

class CategoryController {
    private $categoryModel;
    public $user; // Definir la propiedad

    public function __construct() {
        $this->categoryModel = new CategoryModel();
        $this->user = $_SESSION['user'] ?? null; // Asegúrate de que la sesión esté iniciada y la variable esté establecida
    }

    public function showCategories() {
        $categories = $this->categoryModel->getAllCategories();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/TPE-web-II/templates/showVehicles/categoryOverview.phtml';
    }

    public function addCategory() {
        if (isset($_POST['Nombre'], $_POST['Anio'], $_POST['Capacidad'], $_POST['Combustible'])) {
            $name = $_POST['Nombre'];
            $year = $_POST['Anio'];
            $capacity = $_POST['Capacidad'];
            $fuelType = $_POST['Combustible'];
            $this->categoryModel->addCategory($name, $year, $capacity, $fuelType);
        }
        header('Location: showCategories'); // Redirigir a la lista de categorías
    }

    public function editCategory($id) {
        $category = $this->categoryModel->getCategoryById($id);
        require_once $_SERVER['DOCUMENT_ROOT'] . '/TPE-web-II/templates/showVehicles/categoryOverview.phtml';
    }

    public function updateCategory() {
        if (isset($_POST['Id'], $_POST['Nombre'], $_POST['Anio'], $_POST['Capacidad'], $_POST['Combustible'])) {
            $id = $_POST['Id'];
            $name = $_POST['Nombre'];
            $year = $_POST['Anio'];
            $capacity = $_POST['Capacidad'];
            $fuelType = $_POST['Combustible'];
            $this->categoryModel->editCategory($id, $name, $year, $capacity, $fuelType);
        }
        header('Location: showCategories'); // Redirigir a la lista de categorías
    }

    public function deleteCategory($id) {
        $this->categoryModel->deleteCategory($id);
        header('Location: showCategories'); // Redirigir a la lista de categorías
    }
}
?>


