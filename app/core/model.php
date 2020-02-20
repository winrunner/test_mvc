<?php

class Model {
    protected $mc;

    /**
     * Конструктор инициализирующий подключение к базе данных
     */
    function __construct($dbhost = DBHOST, $dbuser = DBUSER, $dbpassword = DBPASSWORD, $dbname = DBNAME) {
        $this->mc = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
    }

    /**
     * Деструктор закрывающий соединение с базой данных
     */
    function __destruct() {
        mysqli_close($this->mc);
    }

    /**
     * Обработчик запросов
     */
    protected function query($sql) {
        return mysqli_query($this->mc, $sql);
    }

    /**
     * Считает количество строк в запросе
     */
    protected function num($q) {
        return mysqli_num_rows($q);
    }

    /**
     * Преобразует запрос в ассоциативный массив
     */
    protected function fetch($q) {
        return mysqli_fetch_assoc($q);
    }

    /**
     * Проверяет логин пользователя
     */
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

    /**
     * Проверяет текущего пользователя
     */
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