<?php

class Model {
    public function get_data() {}

    public function is_admin($id = null) {
        if(!$id) {
            return false;
        }
        $mc = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
        $q = mysqli_query($mc, "SELECT `login` FROM `users` WHERE `id` = $id");
        mysqli_close($mc);
        if(mysqli_num_rows($q) > 0) {
            return mysqli_fetch_assoc($q);
        }
        return false;
    }

    public function is_current_admin() {
        session_start();
        if($_SESSION['user_login'] == 'admin') {
            return true;
        } else {
            return false;
        }
    }
}

?>