<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css">
</head>
<body>
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
                    <a class="nav-item nav-link" href="/login">Войти</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container my-5">
        <?php include "app/views/$contentView"; ?>
    </div>

<script src="/public/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>