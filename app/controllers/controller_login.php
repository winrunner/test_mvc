<?php

class Controller_Login extends Controller {
    function __construct() {
        $this->model = new Model_Login();
        $this->view = new View();
    }

    function action_index() {
        if(isset($_POST['login']) && $_POST['login'] != '' && isset($_POST['password']) && $_POST['password'] != '') {
            $login = strip_tags($_POST['login']);
            $password = strip_tags($_POST['password']);
            $auth = $this->model->auth($login, md5($password));
            if($auth) {
                session_start();
                header('Location: /orders?msg=success_login');
            } else {
                $attr['message'] = array('danger', 'Неверный логин или пароль');
                $this->view->generate('login.php', 'Авторизация', null, $attr);
            }
        } else {
            $this->view->generate('login.php', 'Авторизация');
        }
    }
}

?>