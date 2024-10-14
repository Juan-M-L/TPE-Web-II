<?php
require_once 'app/views/authView.php';
require_once 'app/models/authModel.php';

class AuthController {
    private $authView;
    private $authModel;

    public function __construct() {
        $this->authView = new AuthView();
        $this->authModel = new AuthModel();
    }

    public function showLogin() {
        $this->authView->showLogin();
    }
}