<h1 class="text-center">Задачи</h1>
<div class="btn-group mb-3" role="group" aria-label="Sort Name">
    <a href="/orders/sort/name_r" class="btn btn-secondary">&#8595;</a>
    <span class="btn btn-secondary disabled">Имя</span>
    <a href="/orders/sort/name" class="btn btn-secondary">&#8593;</a>
</div>
<div class="btn-group mb-3" role="group" aria-label="Sort Status">
    <a href="/orders/sort/status_r" class="btn btn-secondary">&#8595;</a>
    <span class="btn btn-secondary disabled">Статус</span>
    <a href="/orders/sort/status" class="btn btn-secondary">&#8593;</a>
</div>
<div class="btn-group mb-3" role="group" aria-label="Sort Email">
    <a href="/orders/sort/email_r" class="btn btn-secondary">&#8595;</a>
    <span class="btn btn-secondary disabled">Email</span>
    <a href="/orders/sort/email" class="btn btn-secondary">&#8593;</a>
</div>
<?php
    if($data) {
        echo '<div class="row">';
        while($row = mysqli_fetch_assoc($data)) {
            $status = '';
            if($row['status'] == 'created') {
                $status = 'Создана';
            } else if($row['status'] == 'completed') {
                $status = 'Выполнена';
            }
            $output = '<div class="col-md-10"><h4>'.$row['content'].'</h4><p>Автор: '.$row['username'].'<br/>Статус: '.$status.'</p></div>';
            if($_SESSION['user_login'] == 'admin') {
                $output .= '<div class="col-md-2 text-center"><div class="btn-group"><a href="/orders/delete/'.$row['id'].'" class="btn btn-secondary">X</a><a href="/orders/edit/'.$row['id'].'" class="btn btn-secondary">Изм.</a></div></div>';
            }
            echo $output;
        }
        echo '</div>';
    }
    if($attr['pagination'][1] > 1) {
        $currentPage = $attr['pagination'][0];
        $pages = $attr['pagination'][1];
        $pagination = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
        if($currentPage != 1) {
            $pagination .= '<li class="page-item"><a class="page-link" href="?page='.($currentPage - 1).'"><</a></li>';
        } else {
            $pagination .= '<li class="page-item disabled"><span class="page-link"><</span></li>';
        }
        // генерация
        for($i = 1; $i <= $pages; $i++) {
            $i == $currentPage ? $dis = ' disabled' : $dis = '';
            $pagination .= '<li class="page-item'.$dis.'"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
        }
        // конец генерации
        if($currentPage != $pages) {
            $pagination .= '<li class="page-item"><a class="page-link" href="?page='.($currentPage + 1).'">></a></li>';
        } else {
            $pagination .= '<li class="page-item disabled"><span class="page-link">></span></li>';
        }
        $pagination .= '</ul></nav>';
        echo $pagination;
    }
?>