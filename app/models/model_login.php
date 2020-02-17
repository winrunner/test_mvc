<?php

class Model_Login extends Model {
    public function get_data() {
        $arr = [
            ['title' => 'Title_1', 'content' => 'Content_1'],
            ['title' => 'Title_2', 'content' => 'Content_2']
        ];
        return $arr;
    }

    public function auth($login, $password) {
        $mc = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
        $q = mysqli_query($mc, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
        mysqli_close($mc);
        if(mysqli_num_rows($q) > 0) {
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