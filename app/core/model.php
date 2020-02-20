<?php

class Model {
    protected $mc;

    function __construct($dbhost = DBHOST, $dbuser = DBUSER, $dbpassword = DBPASSWORD, $dbname = DBNAME) {
        $this->mc = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
    }

    function __destruct() {
        mysqli_close($this->mc);
    }

    protected function query($sql) {
        return mysqli_query($this->mc, $sql);
    }

    protected function num($q) {
        return mysqli_num_rows($q);
    }

    protected function fetch($q) {
        return mysqli_fetch_assoc($q);
    }

    public function is_admin($id = null) {
        if(!$id) {
            return false;
        }
        $q = $this->query("SELECT `login` FROM `users` WHERE `id` = $id");
        if($this->num($q) > 0) {
            return $this->fetch($q);
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