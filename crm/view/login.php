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

if(isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
    header("Location: /middleware/worker/auto.php");;
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="<?php echo assets() ?>css/login.css">
</head>

<body>
    <div class="wrapper">
        <form action="<?php echo middleware("worker", "authorize") ?>" method="post">
            <h2>Login</h2>
            <div class="input-field">
                <input type="login" name="login" value="<?php echo old($old, 'login') ?>">
                <label>Enter your login</label>
            </div>
            <div class="input-field">
                <input type="password" name="password" value="<?php echo old($old, 'password') ?>">
                <label>Enter your password</label>
            </div>
            <div class="forget">
                <label for="remember">
                    <input type="checkbox" id="remember " name="remember">
                    <p>Remember me</p>
                </label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit">Log In</button>
        </form>
    </div>
</body>

</html>