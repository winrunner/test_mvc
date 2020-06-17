<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php session_start(); ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Навигация">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="/">Главная</a>
                </div>
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link" href="/orders/add">Добавить</a>
                    <?php
                        if(isset($_SESSION['user_login']) && $_SESSION['user_login'] != '') {
                            echo '<a class="nav-item nav-link" href="/logout">Выйти</a>';
                        } else {
                            echo '<a class="nav-item nav-link" href="/login">Войти</a>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </nav>
    <?php
        $msg = array('', '');
        if(isset($_GET['msg'])) {
            if($_GET['msg'] == 'success_login') {
                $msg = array('success', 'Вы успешно вошли');
            } else if($_GET['msg'] == 'success_add') {
                $msg = array('success', 'Добавление прошло успешно');
            } else if($_GET['msg'] == 'success_edit') {
                $msg = array('success', 'Изменение прошло успешно');
            } else if($_GET['msg'] == 'success_delete') {
                $msg = array('success', 'Удаление прошло успешно');
            } else if($_GET['msg'] == 'error') {
                $msg = array('danger', 'Попробуйте еще раз');
            }
        }
        if(isset($attr['message']) && $attr['message'][1] != '') {
            $msg = array($attr['message'][0], $attr['message'][1]);
        }
    ?>
    <div class="container my-5">
        <?php if($msg[1] != '') : ?>
        <div class="alert alert-<?php echo $msg[0]; ?> alert-dismissible fade show" role="alert">
            <span><?php echo $msg[1]; ?></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
        <?php include "app/views/$contentView"; ?>
    </div>

<script src="/public/js/jquery-3.4.1.min.js"></script>
<script src="/public/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>