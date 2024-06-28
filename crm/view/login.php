<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyGuest();

$error = false;
$old = false;

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    $old = $error['old'];
    unset($_SESSION['error']);
    echo $error['message'];
}

component('header');
?>
<div class="container">
    <h1>Страница логина</h1>
    <form action="<?php echo middleware("worker", "authorize") ?>" method="post">
        <input type="login" name="login" value="<?php echo old($old, 'login') ?>">
        <input type="password" name="password" value="<?php echo old($old, 'password') ?>">
        <button>Войти</button>
    </form>
</div>

<?php
component('footer');
?>