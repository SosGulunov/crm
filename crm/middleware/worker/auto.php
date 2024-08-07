<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
model("Worker");



$user = new Worker();
$isUser = $user->auto($_COOKIE['login'], $_COOKIE['password']);
if ($isUser) {
    $_SESSION['auth'] = $user->get_one_by_id($isUser);
    header("Location: /");
    
} else {
    $_SESSION['error'] = [
        'message' => "Не верный логин или пароль",
        'old' => [
            'email' => $_COOKIE['login'],
            'password' => $_COOKIE['password']
        ]
    ];
    header("Location: /");
    die();
}
