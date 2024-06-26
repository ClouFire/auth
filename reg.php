<?php
session_start();
require_once __DIR__.'/blocks/header.php';
require_once __DIR__.'/boot.php';

$title = 'Регистрация';
$errors = [];
$password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-_ !@#$%^&*()+,])[a-zA-Z\d!@#$%^&*()+,\-_\s]{6,}$/';

if (isset($_POST['buttonPressed'])) {

    if (empty($_POST['login']) || empty($_POST['password']) || empty($_POST['email'])) {
        $errors[] = 'Пожалуйста, заполните все данные';
    } elseif (checkLogin($_POST['login'], getPDO())) {
        $errors[] = 'Данный логин уже занят';
    } elseif (!preg_match($password_pattern, $_POST['password'])) {
        $errors[] = "Пароль не подходит<br>В нем должен быть минимум 1 специальный символ<br>Строчные и заглавные латинские буквы<br>Минимальная длина не меньше 6 символов";
    } elseif (checkEmail($_POST['email'], getPDO())) {
        $errors[] = 'Данный мейл уже занят';
    }

    else {
        $_SESSION['auth'] = createUser($_POST['login'], $_POST['password'], $_POST['email'], getPDO());
        if ($_SESSION['auth']) Header("location:/login.php");
    }
}

foreach ($errors as $error) { ?>
    <div class="alert alert-danger"><?=$error?></div>
<?php
} unset($errors);
?>
    <h1>Регистрация</h1>
    <br>
    <a href="/index.php">Главная</a>

    <div class="container mt-5">
        <form action="/reg.php" method="post">
            <label>
                <input type="text" name="login" placeholder="Введите логин" class="form-control">
                <input type="password" name="password" placeholder="Введите пароль" class="form-control mt-2">
                <input type="email" name="email" placeholder="Введите почту" class="form-control mt-2">
                <input type="submit" value="Зарегистрироваться" class="btn btn-success mt-2" name="buttonPressed">
            </label><br>
        </form>
    </div>


<?php
require('blocks/footer.php');
?>