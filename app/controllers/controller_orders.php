<?php

class Controller_Orders extends Controller {
    function __construct() {
        $this->model = new Model_Orders();
        $this->view = new View();
    }

    function action_index() {
        $data = $this->model->get_orders();
        $this->view->generate('orders.php', 'Список', $data);
    }

    function action_add($param = null) {
        if($param) {
            Route::pageNotFound();
        }
        if(isset($_POST['name']) && $_POST['name'] != '' && isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['desc']) && $_POST['desc'] != '') {
            $content = strip_tags($_POST['desc']);
            $email = strip_tags($_POST['email']);
            $name = strip_tags($_POST['name']);
            $q = $this->model->add_order($content, $email, $name);
            if($q) {
                header('Location: /orders?msg=success_add');
            } else {
                $data['message'] = array('error', 'Не удалось создать, попробуйте еще раз');
                $this->view->generate('orders-add.php', 'Добавить', $data);
            }
        } else {
            $this->view->generate('orders-add.php', 'Добавить');
        }
    }

    function action_edit($param = null) {
        if(!$param) {
            Route::pageNotFound();
            return;
        }
        $order_id = intval($param);
        $order = $this->model->get_order($order_id);
        if($order) {
            if(isset($_POST['status']) && $_POST['status'] != '' && isset($_POST['name']) && $_POST['name'] != '' && isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['desc']) && $_POST['desc'] != '' && isset($_POST['admin_edit'])) {
                $status = strip_tags($_POST['status']);
                $content = strip_tags($_POST['desc']);
                $email = strip_tags($_POST['email']);
                $name = strip_tags($_POST['name']);
                $admin_edit = intval(strip_tags($_POST['admin_edit']));
                $q = $this->model->edit_order($order_id, $status, $content, $email, $name, $admin_edit);
                if($q) {
                    header('Location: /orders?msg=success_edit');
                } else {
                    $data['message'] = array('error', 'Не удалось изменить, попробуйте еще раз');
                    $this->view->generate('orders-add.php', 'Изменить', $data);
                }
            } else {
                $this->view->generate('orders-add.php', 'Изменить', $order);
            }
        } else {
            Route::pageNotFound();
        }
    }

    function action_reverse() {
        $data = $this->model->get_orders(null, true);
        $this->view->generate('orders.php', 'Задачи', $data);
    }

    function action_sort($param = null) {
        $data = $this->model->get_orders(null, true);
        if($param) {
            if($param == 'name') {
                $data = $this->model->get_orders('username');
            } else if($param == 'name_r') {
                $data = $this->model->get_orders('username', true);
            } else if($param == 'email') {
                $data = $this->model->get_orders('email');
            } else if($param == 'email_r') {
                $data = $this->model->get_orders('email', true);
            } else if($param == 'status') {
                $data = $this->model->get_orders('status');
            } else if($param == 'status_r') {
                $data = $this->model->get_orders('status', true);
            } else {
                Route::pageNotFound();
            }
        } else {
            Route::pageNotFound();
        }
        $this->view->generate('orders.php', 'Задачи', $data);
    }

    function action_delete($id) {
        if(!$this->model->is_current_admin()) {
            header('Location: /orders?msg=error');
            return;
        }
        if(!is_int($id)) {
            Route::pageNotFound();
            return;
        }
        $id = intval($id);
        $q = $this->model->delete_order($id);
        if($q) {
            header('Location: /orders?msg=success_delete');
        } else {
            header('Location: /orders?msg=error');
        }
    }
}

?>