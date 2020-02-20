<?php

class Model_Main extends Model {
    public function get_orders($reverse = false) {
        $sort = '';
        if($reverse) {
            $sort = "ORDER BY `id` DESC";
        }
        $q = $this->query("SELECT * FROM `orders` $sort");
        if($q) {
            return $q;
        } else {
            return false;
        }
    }
}

?>