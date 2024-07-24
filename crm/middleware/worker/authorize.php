<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
model("Worker");


if (!isset($_POST['login']) || !isset($_POST['password'])) {
    header("Location: /");
    die();
} else {
    $user = new Worker();
    $isUser = $user->authtorize($_POST['login'], $_POST['password']);
    if ($isUser) {
        echo "Вход в аккаунт успешен";
        if (isset($_POST['remember'])) {
            setcookie('login', $_POST['login'], time() + 3600 * 24 * 30, '/');
            setcookie('password', md5($_POST['password']), time() + 3600 * 24 * 30, '/');
        }
        $_SESSION['auth'] = $user->get_one_by_id($isUser);
        header("Location: /");
    } else {
        echo "Не верные данные для входа";
        $_SESSION['error'] = [
            'message' => "Не верный логин или пароль",
            'old' => [
                'email' => $_POST['login'],
                'password' => $_POST['password']
            ]
        ];
        header("Location: " . view('login'));
        die();
    }
}
