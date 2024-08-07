<?php
session_start();
$ROOT = $_SERVER['DOCUMENT_ROOT'] . '/'; #корень проекта
$HOME = "http://" . $_SERVER['SERVER_NAME'] . '/';

function connectDB()
{
    global $ROOT;
    require_once $ROOT . 'DB.php';
}

function model($name)
{
    global $ROOT;
    require_once $ROOT . 'model/' . $name . '.php';
}

function middleware($element, $name)
{
    global $HOME;
    return $HOME . 'middleware/' . $element . '/' . $name . '.php';
}

function view($name)
{
    global $HOME;
    return $HOME . 'view/' . $name . '.php';
}

function assets()
{
    global $HOME;
    return $HOME . 'assets/';
}

function component($name)
{
    global $ROOT;
    require $ROOT . "components/" . $name . ".php";
}

function delete_file($path){
    global $ROOT;
    unlink($ROOT . $path);
}

function old($arr, $value)
{
    if ($arr) {
        if (isset($arr[$value])) {
            return $arr[$value];
        }
    }
    return "";
}



function onlyUser()
{
    if (!isset($_SESSION['auth'])) {
        header("Location: " . view('login'));
        die();
    }
}



function isAdmin()
{
    if ($_SESSION['auth']['isAdminRoot'] == 0) {
        $_SESSION['message'] = 'Ваш аккаунт не имеет допустимых прав. Пожалуйста зайдите в аккаунт менеджера';
        return false;
    }
    else{
        return true;
    }
}

function onlyAdmin()
{
    if ($_SESSION['auth']['isAdminRoot'] == 0) {
        $_SESSION['message'] = 'Ваш аккаунт не имеет допустимых прав. Пожалуйста зайдите в аккаунт менеджера';
        header("Location: /");
        die();
    }
}

function onlyGuest()
{
    if (isset($_SESSION['auth'])) {
        header("Location: " . view('profile'));
        die();
    }
}

function validate_required(array $data, array $values)
{
    foreach ($values as $value) {
        if (strlen($data[$value]) == 0) {
            return false;
        }
    }
    return true;
}

function validate_email($email)
{
}

function validate_password($password)
{
}

function validate_phone($phone)
{
}


