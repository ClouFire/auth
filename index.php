<?php
    session_start();
    $title = 'Главная';
    require_once('blocks/header.php');
    include_once __DIR__.'/boot.php';
?>
<a href="/about.php">О нас</a>
<h1>Главная страница</h1>

<?php

if ($_SESSION['auth']) { ?>
    <a href="index.php">Выход</a>
    <?php
    unset($_SESSION['auth']);
} else {?>
<a href="/login.php">Логин</a> |
<a href="/reg.php">Регистрация</a>

    <?php
}
    ?>

<?php
    require_once('blocks/footer.php');
?>