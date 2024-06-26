<?php
session_start();
require_once __DIR__.'/blocks/header.php';
require_once __DIR__.'/boot.php';

$title = 'Логин';

if ($_POST['buttonPressed']) {
    if ($_POST['login'] && $_POST['password']) {
        $flag = login($_POST['login'], $_POST['password'], getPDO());
        if ($flag) {
            $_SESSION['auth'] = True;
            Header('location:/index.php');
        } else {
            $_SESSION['auth'] = False; ?>
            <div class="alert alert-danger"><?='Вы ввели неверный логин или пароль'?></div> <?php
        }
    }
}


?>
    <h1>Логин</h1>
    <br>
    <a href="/index.php">Главная</a>

    <div class="container mt-5">
        <form action="/login.php" method="post">
            <label>
                <input type="text" name="login" placeholder="Введите логин" class="form-control">
                <input type="password" name="password" placeholder="Введите пароль" class="form-control mt-2">
                <input type="submit" value="Логин" class="btn btn-success mt-2" name="buttonPressed">
            </label><br>
        </form>
    </div>

<?php
require('blocks/footer.php');
?>