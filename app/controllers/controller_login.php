<?php

class Controller_Main extends Controller {
    function __construct() {
        $this->model = new Model_Login();
        $this->view = new View();
    }

    function action_index() {
        $this->view->generate('login.php', 'Авторизация');
    }

    function action_auth() {
        $this->view->generate('login.php', 'Авторизация');
    }
}

?>