<?php

class Model_Orders extends Model {
    public function get_data() {
        $arr = [
            ['title' => 'Title_1', 'content' => 'Content_1'],
            ['title' => 'Title_2', 'content' => 'Content_2']
        ];
        return $arr;
    }

    public function add_order($content, $email, $name) {
        $mc = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
        $q = mysqli_query($mc, "INSERT INTO `orders` (`status`, `content`, `email`, `username`) VALUES ('created', '$content', '$email', '$name')");
        mysqli_close($mc);
        if($q) {
            return true;
        } else {
            return false;
        }
    }

    public function edit_order($id, $status, $content, $email, $name, $admin_edit) {
        $mc = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
        $q = mysqli_query($mc, "UPDATE `orders` SET `status` = '$status', `content` = '$content', `email` = '$email', `username` = '$name', `admin_edit` = $admin_edit WHERE `id` = $id");
        echo "ID: $id\n";
        mysqli_close($mc);
        var_dump($q);
        if($q) {
            echo "EDIT_ORDER TRUE";
            return true;
        } else {
            echo "EDIT_ORDER FALSE";
            return false;
        }
    }

    public function delete_order($id) {
        $mc = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
        $c = mysqli_query($mc, "SELECT * FROM `orders` WHERE `id` = $id");
        if(mysqli_num_rows($c) == 0) {
            mysqli_close($mc);
            return false;
        }
        $q = mysqli_query($mc, "DELETE FROM `orders` WHERE `id` = $id");
        mysqli_close($mc);
        if($q) {
            return true;
        } else {
            return false;
        }
    }

    public function get_orders($sort_by = null, $reverse = false) {
        $sort = '';
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
        $mc = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
        $q = mysqli_query($mc, "SELECT * FROM `orders` $sort");
        mysqli_close($mc);
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
        $mc = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
        $q = mysqli_query($mc, "SELECT * FROM `orders` WHERE `id` = $id");
        mysqli_close($mc);
        if(mysqli_num_rows($q) > 0) {
            return mysqli_fetch_assoc($q);
        } else {
            return false;
        }
    }

}

?>