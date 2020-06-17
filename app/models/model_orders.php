<?php

class Model_Orders extends Model {
    public function add_order($content, $email, $name) {
        $q = $this->query("INSERT INTO `orders` (`status`, `content`, `email`, `username`) VALUES ('created', '$content', '$email', '$name')");
        if($q) {
            return true;
        } else {
            return false;
        }
    }

    public function edit_order($id, $status, $content, $email, $name, $admin_edit) {
        $q = $this->query("UPDATE `orders` SET `status` = '$status', `content` = '$content', `email` = '$email', `username` = '$name', `admin_edit` = $admin_edit WHERE `id` = $id");
        if($q) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_order($id) {
        $c = $this->query("SELECT * FROM `orders` WHERE `id` = $id");
        if($this->num($c) == 0) {
            return false;
        }
        $q = $this->query("DELETE FROM `orders` WHERE `id` = $id");
        if($q) {
            return true;
        } else {
            return false;
        }
    }

    public function get_orders($sort_by = null, $reverse = false, $offset = 0, $opp = OPP) {
        $sort = '';
        $limit = '';
        if($reverse) {
            $order = "DESC";
        } else {
            $order = "ASC";
        }
        if($sort_by) {
            $sort = "ORDER BY `$sort_by` $order";
        } else {
            $sort = "ORDER BY `id` $order";
        }
        if($opp > 0) {
            $limit = "LIMIT $offset,$opp";
        }
        $q = $this->query("SELECT * FROM `orders` $sort $limit");
        if($q) {
            return $q;
        } else {
            return false;
        }
    }

    public function get_order($id) {
        $order_id = intval($id);
        if($id == 0) {
            return false;
        }
        $q = $this->query("SELECT * FROM `orders` WHERE `id` = $id");
        if($this->num($q) > 0) {
            return $this->fetch($q);
        } else {
            return false;
        }
    }

}

?>