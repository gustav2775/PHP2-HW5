<?php
include_once  "../engine/login.php";
?>

<div class="container">
    <div class="authorization">
        <a href="/?page=orders">Заказы</a>
        <?php if ($auth) : ?>
            <p class="auth"><?= $name ?><span> <a href="/?logout">Выход</a> </span></p>
        <?php else : ?>
            <form action="" method="post">
                <input type="text" name="login">
                <input type="text" name="pass">
                Save? <input type="checkbox" name="save">
                <input type="submit" value="Войти">
            </form>
            <a href="/?page=registation" class="regBtn">Регистрация</a>
        <?php endif; ?>
    </div>
</div>