<?php
require_once 'app/views/view.php';
require_once 'app/models/model.php';

class Controller {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new Model();
        $this->view = new View();
    }

}