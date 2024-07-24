<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyUser();
model('Reviews');
model('Task');
$reviews_model = new Reviews();
$r = $reviews_model->unreaded_count($_SESSION['auth']['login']);

$task_model = new Task();
$t = $task_model->unreaded_count($_SESSION['auth']['login']);

?>

<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="<?php echo assets() ?>css/style.css">
    

    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <script src="<?php echo assets() ?>js/script.js">
    </script>

</head>

<body>
    <script>
        const body = document.querySelector('body')
        const modeSwitch = body.querySelector(".toggle-switch")
        const initialTheme = localStorage.getItem('theme') || 'light';
        if (initialTheme === 'dark') {
            body.classList.add('dark');
            modeText.innerText = "Light mode";
        } else {
            modeText.innerText = "Dark mode";
        }
    </script>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="<?php echo assets() ?>images/logo.png" alt="">
                </span>
                <div class="text logo-text">
                    <span class="name">CRM система</span>
                    <span class="profession">Для магазина одежды</span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="<?php echo "http://" . $_SERVER['SERVER_NAME'] . '/' ?>">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Главная</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="<?php echo view('workers') ?>">
                            <i class='bx bxs-user-account icon'></i>
                            <span class="text nav-text">Работники</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="<?php echo view('clients') ?>">
                            <i class='bx bxs-user icon'></i>
                            <span class="text nav-text">Клиенты</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="<?php echo view('tovars') ?>">
                            <i class='bx bxs-layer icon'></i>
                            <span class="text nav-text">Товар</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="<?php echo view('purchase_tovar') ?>">
                            <i class='bx bxs-layer-plus icon'></i>
                            <span class="text nav-text">Закуп товара</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="<?php echo view('finance') ?>">
                            <i class='bx bx-chart icon'></i>
                            <span class="text nav-text">Финансы</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="<?php echo view('reviews') ?>">
                            <i class='bx bxs-chat icon'></i>
                            <span class="text nav-text">Отзывы</span>
                            <div class="circle" id="circle_reviews"><?php echo $r ?></div>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="<?php echo view('tasks') ?>">
                            <i class='bx bx-task icon'></i>
                            <span class="text nav-text">Задачи</span>
                            <div class="circle" id="circle_tasks"><?php echo $t ?></div>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="<?php echo view('orders') ?>">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">Заказы</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">

                <?php
                if (!isset($_SESSION['auth'])) {
                ?>
                    <li class="">
                        <a href="<?php echo view("login") ?>">
                            <i class='bx bx-log-in icon'></i>
                            <span class="text nav-text">Войти</span>
                        </a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="">
                        <a href="<?php echo middleware('worker', 'logout') ?>">
                            <i class='bx bx-log-out icon'></i>
                            <span class="text nav-text">Выйти</span>
                        </a>
                    </li>
                <?php
                }
                ?>
                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>

            </div>
        </div>
    </nav>
    <section class="home">