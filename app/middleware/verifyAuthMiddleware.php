<?php
//Si hay un usuario logueado, no hace nada. Si no, redirige al login.
    function verifyAuthMiddleware($response) {
        if($response->user) {
            if($response->user->admin) {
                return;
            }
            header('Location: '. BASE_URL . 'home');
            die();
        } else {
            header('Location: ' . BASE_URL . 'showLogin');
            die();
        }
    }
?>
