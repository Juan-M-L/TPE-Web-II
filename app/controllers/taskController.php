<?php
require_once 'app/views/taskView.php';
require_once 'app/models/taskModel.php';

class TaskController {
    private $model;
    private $taskView;

    //Siempre que se cree un nuevo objeto tipo TaskController, este va a crear un objeto modelo y un objeto vista.
    public function __construct() {
        $this->model = new Model();
        $this->taskView = new TaskView();
    }

    //Acá le indica a la vista que muestre la página principal.
    public function home() {
        $error = $this->model->getDBError();
        $this->taskView->home($error);
    }

    //Acá le indica al modelo que agarre todos los datos, y a la vista que muestre esos datos.
    public function showVehicles() {
        $error = $this->model->getDBError();
        $data = $this->model->getAllData();
        $this->taskView->showVehicles($data, $error);
    }

    public function vehicle($id) {
        $error = $this->model->getDBError();
        $data = $this->model->getById($id);
        $this->taskView->vehicle($data, $error);
    }  

    public function showCategories() {
        $error = $this->model->getDBError();
        $categories = $this->model->getAllCategories();
        $this->taskView->showCategories($categories, $error);
    }

    public function showVehiclesByCategory($categoryId) {
        $error = $this->model->getDBError();
        $vehicles = $this->model->getVehiclesByCategory($categoryId);
        $this->taskView->showVehicles($vehicles, $error);
    }
}