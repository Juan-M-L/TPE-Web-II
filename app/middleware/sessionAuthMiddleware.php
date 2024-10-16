<?php
//Inicia/reanuda la sesión. Si hay un usuario logueado, carga sus datos en la sesión.
    function sessionAuthMiddleware($response) {
        session_start();
        if(isset($_SESSION['USER_ID'])) {
            $response->user = new stdClass();
            $response->user->id = $_SESSION['USER_ID'];
            $response->user->name = $_SESSION['USER_NAME'];

            if ($_SESSION['USER_NAME'] == "webadmin") {
                $response->user->admin = true;
            } else {
                $response->user->admin = false;
            }
            return;
        }
    }
?>
