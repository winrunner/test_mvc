<?php

class Controller_Orders extends Controller {
    function __construct() {
        $this->model = new Model_Orders();
        $this->view = new View();
    }

    function action_index() {
        $currentPage = 1;
        if(isset($_GET['page'])) {
            if($_GET['page'] && intval($_GET['page']) > 0) {
                $currentPage = intval($_GET['page']);
            }
        }
        $offset = ($currentPage - 1) * OPP;
        $orders = $this->model->get_orders(null, false, 0, 0);
        $pages = ceil($this->model->num($orders)/OPP);

        $data = $this->model->get_orders(null, false, $offset);
        $attr['pagination'] = array($currentPage, $pages);
        $this->view->generate('orders.php', 'Задачи', $data, $attr);
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
        $currentPage = 1;
        if($_GET['page'] && intval($_GET['page']) > 0) {
            $currentPage = intval($_GET['page']);
        }
        $offset = ($currentPage - 1) * OPP;
        $orders = $this->model->get_orders(null, false, 0, 0);
        $pages = ceil($this->model->num($orders)/OPP);
        
        $attr['pagination'] = array($currentPage, $pages);
        $data = $this->model->get_orders(null, true, $offset);
        $this->view->generate('orders.php', 'Задачи', $data);
    }

    function action_sort($param = null) {
        $currentPage = 1;
        if($_GET['page'] && intval($_GET['page']) > 0) {
            $currentPage = intval($_GET['page']);
        }
        $offset = ($currentPage - 1) * OPP;
        $orders = $this->model->get_orders(null, false, 0, 0);
        $pages = ceil($this->model->num($orders)/OPP);

        $data = $this->model->get_orders(null, true, $offset);
        if($param) {
            if($param == 'name') {
                $data = $this->model->get_orders('username', false, $offset);
            } else if($param == 'name_r') {
                $data = $this->model->get_orders('username', true, $offset);
            } else if($param == 'email') {
                $data = $this->model->get_orders('email', false, $offset);
            } else if($param == 'email_r') {
                $data = $this->model->get_orders('email', true, $offset);
            } else if($param == 'status') {
                $data = $this->model->get_orders('status', false, $offset);
            } else if($param == 'status_r') {
                $data = $this->model->get_orders('status', true, $offset);
            } else {
                Route::pageNotFound();
            }
        } else {
            Route::pageNotFound();
        }
        
        $attr['pagination'] = array($currentPage, $pages);
        $this->view->generate('orders.php', 'Задачи', $data, $attr);
    }

    function action_delete($id) {
        if(!$this->model->is_current_admin()) {
            header('Location: /orders?msg=error');
            return;
        }
        $id = intval($id);
        if($id == 0) {
            Route::pageNotFound();
            return;
        }
        $q = $this->model->delete_order($id);
        if($q) {
            header('Location: /orders?msg=success_delete');
        } else {
            header('Location: /orders?msg=error');
        }
    }
}

?>