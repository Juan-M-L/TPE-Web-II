<?php
//Si hay un usuario logueado, no hace nada. Si no, redirige al login.
    function verifyAuthMiddleware($response) {
        if($response->user) {
            return;
        } else {
            header('Location: ' . BASE_URL . 'showLogin');
            die();
        }
    }
?>
