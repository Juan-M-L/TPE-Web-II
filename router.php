<?php
require_once "app/libs/response.php";
require_once "app/middleware/sessionAuthMiddleware.php";
require_once "app/middleware/verifyAuthMiddleware.php";
require_once "app/controllers/authController.php";
require_once "app/controllers/mainController.php";

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$response = new Response();

if (!empty($_GET["action"])) {
    $action = $_GET["action"];
} else {
    $action = "home";
}

$params = explode("/",$action);

switch ($params[0]) {
    //Lleva al sitio principal.
    case 'home':
        //Inicia/reanuda la sesión. Si hay un usuario logueado, carga sus datos en la sesión.
        sessionAuthMiddleware($response);
        //Crea un objeto controlador.
        $controller = new MainController($response);
        //Le indica al controlador que ejecute la función de mostrar la sección home.
        $controller->home();
        break;
    //Muestra la lista de vehículos.
    case 'showVehicles':
        sessionAuthMiddleware($response);
        $controller = new MainController($response);
        $controller->showVehicles();
        break;
    //Muestra un vehículo particular.
    case 'vehicle':
        sessionAuthMiddleware($response);
        $controller = new MainController($response);
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $controller->vehicle($id);
        break;
    //Muestra la interfaz para agregar un vehículo.
    case 'showAddVehicle':
        sessionAuthMiddleware($response);
        verifyAuthMiddleware($response);
        $controller = new MainController($response);
        $controller->showAddVehicle();
        break;
    //Agrega un vehículo.
    case 'addVehicle':
        sessionAuthMiddleware($response);
        verifyAuthMiddleware($response);
        $controller = new MainController($response);
        $controller->addVehicle();
        break;
    case 'showUpdateVehicle':
        sessionAuthMiddleware($response);
        verifyAuthMiddleware($response);
        $controller = new MainController($response);
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $controller->showUpdateVehicle("", $id);
        break;
    case 'updateVehicle':
        sessionAuthMiddleware($response);
        verifyAuthMiddleware($response);
        $controller = new MainController($response);
        $controller->updateVehicle();
        break;
    case 'deleteVehicle':
        sessionAuthMiddleware($response);
        verifyAuthMiddleware($response);
        $controller = new MainController($response);
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $controller->deleteVehicle($id);
        break;
    //Muestra todas las categorías (todos los modelos)
    case 'showCategories':
        sessionAuthMiddleware($response);
        $controller = new MainController($response);
        $controller->showCategories();
        break;
    //Muestra todos los autos pertenecientes a una categoría particular.
    case 'category':
        sessionAuthMiddleware($response);
        $controller = new MainController($response);
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $controller->showVehiclesByCategory($id);
        break; 
    //Muestra la sección de iniciar sesión.
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    //Inicia sesión.
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    default:
        echo "Error 404. Página no encontrada";
        break;
}