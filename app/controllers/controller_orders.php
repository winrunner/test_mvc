<?php

class Controller_Orders extends Controller {
    function __construct() {
        $this->model = new Model_Orders();
        $this->view = new View();
    }

    function action_index() {
        $data = $this->model->get_data();
        $this->view->generate('orders.php', 'Список', $data);
    }

    function action_add() {
        if(isset($_POST['name']) && $_POST['name'] != '' && isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['desc']) && $_POST['desc'] != '') {
            $mc = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
            if(!$mc) {
                echo 'error';
            }
        }
        $this->view->generate('orders-add.php', 'Добавить');
    }
}

?>