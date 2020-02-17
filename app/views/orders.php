<h1 class="text-center">Задачи</h1>
<div class="btn-group mb-3" role="group" aria-label="Sort">
    <a href="/orders" class="btn btn-secondary">&#8595;</a>
    <a href="/orders/reverse" class="btn btn-secondary">&#8593;</a>
</div>
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
?>