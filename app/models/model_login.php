<?php

class Model_Login extends Model {
    public function auth($login, $password) {
        $q = $this->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
        if($this->num($q) > 0) {
            session_start();
            $_SESSION['user_login'] = $login;
            return $_SESSION['user_login'];
        } else {
            if($_SESSION) {
                session_destroy();
            }
            return false;
        }
    }
}

?>