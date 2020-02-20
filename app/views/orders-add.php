<?php
    $order_id = $data['id'];
    $order_name = $data['username'];
    $order_email = $data['email'];
    $order_desc = $data['content'];
    $order_status = $data['status'];
    $created_checked = '';
    $completed_checked = '';
    if($order_status == 'created') {
        $created_checked = 'checked="checked"';
    } else if($order_status == 'completed') {
        $comleted_checked = 'checked="checked"';
    }
?>
<h1 class="text-center">Добавить</h1>
<div class="row justify-content-center my-3">
    <div class="col-md-8">
        <form action="" method="POST">
            <?php if($order_id && $order_id > 0) : ?>
            <div class="form-group">
                <select name="status" id="status" class="form-control">
                    <option value="created" <?php echo $created_checked; ?>>Создана</option>
                    <option value="completed" <?php echo $completed_checked; ?>>Выполнена</option>
                </select>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Имя" required="required" value="<?php echo $order_name; ?>">
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" required="required" value="<?php echo $order_email; ?>">
            </div>
            <div class="form-group">
                <textarea name="desc" class="form-control" id="desc" rows="4" placeholder="Описание" required="required"><?php echo $order_desc; ?></textarea>
            </div>
            <?php
                if($order_id && $order_id > 0) {
                    echo '<input type="hidden" name="admin_edit" value="1">';
                }
            ?>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</div>