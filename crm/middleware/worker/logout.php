<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyUser();
$_SESSION = [];

$cookies = $_COOKIE;

foreach ($cookies as $key => $value) {
    setcookie($key, '', time() - 3600, '/');
}

header("Location: /");
