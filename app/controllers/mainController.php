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