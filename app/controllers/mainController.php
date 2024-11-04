<?php
require_once 'app/views/mainView.php';
require_once 'app/Models/mainModel.php';

class MainController {
    private $mainModel;
    private $mainView;

    //Siempre que se cree un nuevo objeto tipo TaskController, este va a crear un objeto mainModelo y un objeto vista.
    public function __construct($response) {
        $this->mainModel = new MainModel();
        $this->mainView = new MainView($response->user);
    }

    //Acá le indica a la vista que muestre la página principal.
    public function home() {
        $error = $this->mainModel->getDBError();
        $this->mainView->home($error);
    }

    //VEHÍCULOS.

    //Acá le indica al Modelo que agarre todos los datos, y a la vista que muestre esos datos.
    public function showVehicles() {
        $error = $this->mainModel->getDBError();
        $data = $this->mainModel->getVehicleData();
        $this->mainView->showVehicles($data, $error);
    }

    public function vehicle($id) {
        $error = $this->mainModel->getDBError();
        $data = $this->mainModel->getById($id);
        $this->mainView->vehicle($data, $error);
    }  

    public function showAddVehicle($message="") {
        $error = $this->mainModel->getDBError();
        $categories = $this->mainModel->getAllCategories();
        $this->mainView->showAddVehicle($error, $message, $categories);
    }

    public function addVehicle() {
        $error = $this->mainModel->getDBError();
        $categories = $this->mainModel->getAllCategories();

        if (!isset($_POST['marca']) || empty($_POST['marca'])) {
            return $this->mainView->showAddVehicle($error, 'Por favor, complete el campo Marca', $categories);
        }
    
        if (!isset($_POST['modelo']) || empty($_POST['modelo'])) {
            return $this->mainView->showAddVehicle($error, "Por favor, complete el campo Modelo", $categories);
        }

        if (!isset($_POST['kilometraje']) || $_POST['kilometraje'] === "") {
            return $this->mainView->showAddVehicle($error, "Por favor, complete el campo Kilometraje", $categories);
        }

        if (!isset($_POST['precio']) || empty($_POST['precio'])) {
            return $this->mainView->showAddVehicle($error, "Por favor, complete el campo Precio", $categories);
        }

        if ($_POST['kilometraje'] < 0 || $_POST['precio'] < 0) {
            return $this->mainView->showAddVehicle($error, "No se permiten valores negativos", $categories);
        }

        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $kilometraje = $_POST['kilometraje'];
        $precio = $_POST['precio'];

        $this->mainModel->addVehicle($marca, $modelo, $kilometraje, $precio);

        return $this->mainView->showAddVehicle($error, "Vehículo agregado", $categories);
    }

    public function showUpdateVehicle($message="", $id) {
        $error = $this->mainModel->getDBError();
        $categories = $this->mainModel->getAllCategories();
        $vehicle = $this->mainModel->getById($id);
        $this->mainView->showUpdateVehicle($error, $message, $categories, $vehicle);
    }

    public function updateVehicle() {
        $error = $this->mainModel->getDBError();
        $categories = $this->mainModel->getAllCategories();
        $id = $_POST['id'];
        $vehicle = $this->mainModel->getById($id);

        if (!isset($_POST['marca']) || empty($_POST['marca'])) {
            return $this->mainView->showUpdateVehicle($error, 'Por favor, complete el campo Marca', $categories, $vehicle);
        }
    
        if (!isset($_POST['modelo']) || empty($_POST['modelo'])) {
            return $this->mainView->showUpdateVehicle($error, "Por favor, complete el campo Modelo", $categories, $vehicle);
        }

        if (!isset($_POST['kilometraje']) || $_POST['kilometraje'] === "") {
            return $this->mainView->showUpdateVehicle($error, "Por favor, complete el campo Kilometraje", $categories, $vehicle);
        }

        if (!isset($_POST['precio']) || empty($_POST['precio'])) {
            return $this->mainView->showUpdateVehicle($error, "Por favor, complete el campo Precio", $categories, $vehicle);
        }

        if ($_POST['kilometraje'] < 0 || $_POST['precio'] < 0) {
            return $this->mainView->showUpdateVehicle($error, "No se permiten valores negativos", $categories, $vehicle);
        }

        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $kilometraje = $_POST['kilometraje'];
        $precio = $_POST['precio'];

        $this->mainModel->updateVehicle($id, $marca, $modelo, $kilometraje, $precio);
        return $this->mainView->showUpdateVehicle($error, "Vehículo actualizado", $categories, $this->mainModel->getById($id));
    }

    public function deleteVehicle($id) {
        $this->mainModel->deleteVehicle($id);
        header("Location: ". BASE_URL ."/showVehicles");
    }

    //CATEGORÍAS.

    public function showCategories() {
        $error = $this->mainModel->getDBError();
        $categories = $this->mainModel->getAllCategories();
        $this->mainView->showCategories($categories, $error);
    }

    public function showVehiclesByCategory($categoryId) {
        $error = $this->mainModel->getDBError();
        $vehicles = $this->mainModel->getVehiclesByCategory($categoryId);
        $this->mainView->showVehicles($vehicles, $error);
    }

    public function showAddCategory($message="") {
        $error = $this->mainModel->getDBError();
        $this->mainView->showAddCategory($error, $message);
    }

    public function addCategory() {
        $error = $this->mainModel->getDBError();

        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->mainView->showAddCategory($error, 'Por favor, complete el campo Nombre');
        }
    
        if (!isset($_POST['anio']) || empty($_POST['anio'])) {
            return $this->mainView->showAddCategory($error, "Por favor, complete el campo Año");
        }

        if (!isset($_POST['capacidad']) || empty($_POST['capacidad'])) {
            return $this->mainView->showAddCategory($error, "Por favor, complete el campo Asientos");
        }

        if (!isset($_POST['combustible']) || empty($_POST['combustible'])) {
            return $this->mainView->showAddCategory($error, "Por favor, complete el campo Combustible");
        }

        if ($_POST['capacidad'] < 1 || $_POST['anio'] < 1) {
            return $this->mainView->showAddCategory($error, "No se permiten valores por debajo de 1");
        }

        if ($_POST['anio'] > getdate()["year"]) {
            return $this->mainView->showAddCategory($error, "No se permiten valores superiores a ".getdate()["year"]." en Año");
        }


        $nombre = $_POST['nombre'];
        $anio = $_POST['anio'];
        $capacidad = $_POST['capacidad'];
        $combustible = $_POST['combustible'];

        $this->mainModel->addCategory($nombre, $anio, $capacidad, $combustible);

        return $this->mainView->showAddCategory($error, "Modelo agregado");

    }

    public function showUpdateCategory($message="", $id) {
        $error = $this->mainModel->getDBError();
        $category = $this->mainModel->getCategoryById($id);
        $this->mainView->showUpdateCategory($error, $message, $category);
    }

    public function updateCategory() { // Adaptar código para que actualice en vez de agregar.
        $error = $this->mainModel->getDBError();
        $id = $_POST['id'];
        $category = $this->mainModel->getCategoryById($id);

        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->mainView->showUpdateCategory($error, 'Por favor, complete el campo Nombre', $category);
        }
    
        if (!isset($_POST['anio']) || empty($_POST['anio'])) {
            return $this->mainView->showUpdateCategory($error, "Por favor, complete el campo Año", $category);
        }

        if (!isset($_POST['capacidad']) || empty($_POST['capacidad'])) {
            return $this->mainView->showUpdateCategory($error, "Por favor, complete el campo Asientos", $category);
        }

        if (!isset($_POST['combustible']) || empty($_POST['combustible'])) {
            return $this->mainView->showUpdateCategory($error, "Por favor, complete el campo Combustible", $category);
        }

        if ($_POST['capacidad'] < 1 || $_POST['anio'] < 1) {
            return $this->mainView->showUpdateCategory($error, "No se permiten valores por debajo de 1", $category);
        }

        if ($_POST['anio'] > getdate()["year"]) {
            return $this->mainView->showUpdateCategory($error, "No se permiten valores superiores a ".getdate()["year"]." en el campo Año", $category);
        }

        $nombre = $_POST['nombre'];
        $anio = $_POST['anio'];
        $capacidad = $_POST['capacidad'];
        $combustible = $_POST['combustible'];

        $this->mainModel->UpdateCategory($id, $nombre, $anio, $capacidad, $combustible);

        return $this->mainView->showUpdateCategory($error, "Modelo actualizado", $this->mainModel->getCategoryById($id));
    }

    public function deleteCategory($categoryId) {
        $vehicles = $this->mainModel->getVehiclesByCategory($categoryId);
        if (empty($vehicles)) {
            if (!empty($this->mainModel->getCategoryById($categoryId))) {
                $this->mainModel->deleteCategory($categoryId);
                header("Location: " . BASE_URL . "/showCategories");
                return;
            } else {
                $this->mainView->showDeleteCategory("Este modelo no existe");
            }
        } else {
            $this->mainView->showDeleteCategory("No puedes eliminar un modelo con autos asociados.");
        }
    }
}