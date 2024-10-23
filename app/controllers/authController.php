<?php
require_once 'app/views/authView.php';
require_once 'app/models/userModel.php';

class AuthController {
    private $authView;
    private $userModel;

    public function __construct() {
        $this->authView = new AuthView();
        $this->userModel = new UserModel();
    }

    public function showLogin() {
        $this->authView->showLogin();
    }

    public function login() {
        if (!isset($_POST['Nombre']) || empty($_POST['Nombre'])) {
            return $this->authView->showLogin('Falta completar el nombre de usuario');
        }
    
        if (!isset($_POST['Contrasenia']) || empty($_POST['Contrasenia'])) {
            return $this->authView->showLogin('Falta completar la contraseña');
        }
    
        $name = $_POST['Nombre'];
        $password = $_POST['Contrasenia'];
    
        // Verificar que el usuario está en la base de datos
        $userFromDB = $this->userModel->getUserByName($name);

        if($userFromDB && password_verify($password, $userFromDB->Contrasenia)){
            // Guarda en la sesión el ID del usuario
            session_start();
            $_SESSION['USER_ID'] = $userFromDB->Id;
            $_SESSION['USER_NAME'] = $userFromDB->Nombre;
            $_SESSION['LAST_ACTIVITY'] = time();
    
            // Redirije al home
            header('Location: ' . BASE_URL);
        } else {
            return $this->authView->showLogin('El nombre de usuario y/o la contraseña no son correctas.');
        }
    }
    
        public function logout() {
            // Cerrar sesión
            session_start();
            session_unset();
            session_destroy();
            
            // Redireccionar a la página de inicio de sesión
            header("Location: " . BASE_URL . "showLogin");
            exit();
        }
}
