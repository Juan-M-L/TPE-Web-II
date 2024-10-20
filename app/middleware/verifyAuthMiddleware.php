<?php
    function verifyAuthMiddleware($response) {
        //Si el usuario logueado es administrador, no hace nada. Si no, redirige al home.
        if($response->user) {
            if($response->user->admin) {
                return;
            }
            header('Location: '. BASE_URL . 'home');
            die();
        //Si el usuario no esta logueado, redirige al login.
        } else {
            header('Location: ' . BASE_URL . 'showLogin');
            die();
        }
    }
?>
