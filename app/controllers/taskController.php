<?php
require_once 'app/views/taskView.php';
require_once 'app/models/model.php';

//Plantilla para crear controladores
class TaskController {
    private $model;
    private $taskView;

    //Siempre que crees un nuevo objeto tipo controlador, este va a crear un objeto modelo y un objeto vista.
    public function __construct() {
        $this->model = new Model();
        $this->taskView = new TaskView();
    }

    //Acá le indica a la vista que muestre la página principal.
    public function home() {
        $this->taskView->home();
    }

    //Acá le indica al modelo que agarre todos los datos, y a la vista que muestre esos datos.
    public function showVehicles() {
        $data = $this->model->getAllData();
        $this->taskView->showVehicles($data);
    }

    public function vehicle($id) {
        $data = $this->model->getById($id);
        $this->taskView->vehicle($data);
    }
}

// TODO: CREAR VISTA DE LOGIN.
