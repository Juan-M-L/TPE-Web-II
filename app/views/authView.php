<?php
class AuthView {
    private $user = null;

    public function showLogin($message = "") {
        require 'templates/logIn/body.phtml';
    }
}