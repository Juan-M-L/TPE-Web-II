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

    //Acá le indica al Modelo que agarre todos los datos, y a la vista que muestre esos datos.
    public function showVehicles() {
        $error = $this->mainModel->getDBError();
        $data = $this->mainModel->getAllData();
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

        if (!isset($_POST['kilometraje']) || empty($_POST['kilometraje'])) {
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

        if (!isset($_POST['kilometraje']) || empty($_POST['kilometraje'])) {
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
}