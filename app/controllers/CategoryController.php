<?php
require_once 'app/models/categoryModel.php';

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new CategoryModel();
        $this->user = $_SESSION['user'] ?? null;
    }

    public function showAddCategory() {
        $categories = $this->categoryModel->getAllCategories();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/TPE-web-II/templates/showCategories.phtml'; // Cambia la ruta si es necesario
    }
    

    public function addCategory() {
        $categories = $this->categoryModel->getAllCategories();
    
        if (!isset($_POST['Nombre']) || empty($_POST['Nombre'])) {
            return $this->showAddCategories('Por favor, complete el campo Nombre');
        }
    
        // Captura los datos
        $nombre = $_POST['Nombre'];
        $anio = $_POST['Anio'];
        $capacidad = $_POST['Capacidad'];
        $combustible = $_POST['Combustible'];
    
        // Llama a la función para agregar la categoría
        $this->categoryModel->addCategory($nombre, $anio, $capacidad, $combustible);
    
        // Redirige a la página de categorías
        $mainController = new MainController(); // Crear una instancia del MainController
        return $mainController->showCategories(); // Llamar a showCategories en MainController
    }
    
    
    

    public function showUpdateCategory($message = "", $id) {
        $error = $this->categoryModel->getDBError();
        $category = $this->categoryModel->getCategoryById($id);
        // Muestra la vista para actualizar la categoría
        require_once $_SERVER['DOCUMENT_ROOT'] . '/TPE-web-II/templates/updateCategory/bodymodel.phtml'; // Asegúrate de que este archivo exista
    }

    public function updateCategory() {
        $error = $this->categoryModel->getDBError();
        $id = $_POST['id'];
        $category = $this->categoryModel->getCategoryById($id);

        // Validaciones
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->mainView->showUpdateCategory($error, 'Por favor, complete el campo Nombre', $id);
        }

        // Captura los datos
        $nombre = $_POST['nombre'];
        // Lógica para actualizar la categoría
        $this->categoryModel->updateCategory($id, $nombre); // Asegúrate de que este método esté definido

        return $this->showUpdateCategory($error, "Categoría actualizada", $id);
    }

    public function deleteCategory($id) {
        $this->categoryModel->deleteCategory($id);
        header("Location: showCategories");
    }
}
?>





