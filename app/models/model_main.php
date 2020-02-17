<?php

class Model_Main extends Model {
    public function get_data() {
        $arr = [
            ['title' => 'Title_1', 'content' => 'Content_1'],
            ['title' => 'Title_2', 'content' => 'Content_2']
        ];
        return $arr;
    }

    public function get_orders($reverse = false) {
        $sort = '';
        if($reverse) {
            $sort = "ORDER BY `id` DESC";
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
}

?>