<?php
//Importa los controladores.
require_once "app/controllers/authController.php";
require_once "app/controllers/taskController.php";

if (!empty($_GET["action"])) {
    $action = $_GET["action"];
} else {
    $action = "home";
}

$params = explode("/",$action);

switch ($params[0]) {
    //Lleva al sitio principal.
    case 'home':
        //Crea un objeto controlador.
        $controller = new TaskController();
        //Le indica al controlador que ejecute la función de mostrar la sección home.
        $controller->home();
        break;
    //Muestra la lista de vehículos.
    case 'showVehicles':
        $controller = new TaskController();
        $controller->showVehicles();
        break;
    //Muestra la sección de iniciar sesión (Todavía no iniciado.)
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
}