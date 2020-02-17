<?php

class Controller_Logout extends Controller {
    function action_index() {
        session_start();
        if($_SESSION) {
            session_destroy();
        }
        header('Location: /orders');
    }
}

?>