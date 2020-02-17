<h1 class="text-center">Список</h1>
<?php
    if($data) {
        echo '<div class="row">';
        foreach($data as $t) {
            echo '<div class="col-md-12"><h3>'.$t['title'].'</h3><p>'.$t['content'].'</p></div>';
        }
        echo '</div>';
    }
?>