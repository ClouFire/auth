<?php

function getPDO() {

    static $pdo;

    if(!$pdo) {
        $dbName = 'test';
        $dbHost = '127.0.0.1';
        try {
            $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", 'root', '');
        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }
    return $pdo;
}

function checkLogin($login, $pdo) {
    $stmt = $pdo->prepare("SELECT login FROM users WHERE login=:login");
    $stmt->execute(["login" => $login]);
    return $stmt->fetch();
}

function createUser($login, $password, $email, $pdo) {

    $stmt = $pdo->prepare("INSERT INTO users(login, password, email) VALUES (:login, :password, :email)");
    $stmt->execute([
        "login" => $login,
        "password" => md5($password),
        "email" => $email
    ]);

    return True;
}

function login($login, $password, $pdo) {

    $stmt = $pdo->prepare("SELECT password FROM users WHERE login=:login");
    $stmt->execute(["login" => $login]);
    $isLogin = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($isLogin["password"] == md5($password)) {
        return True;
    } else {
        return False;
    }

}

function checkEmail($email, $pdo) {
    $stmt = $pdo->prepare("SELECT email FROM users WHERE email=:email");
    $stmt->execute(["login" => $email]);
    return $stmt->fetch();
}

