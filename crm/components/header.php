<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo assets() ?>css/style.css">
    <title>crm system</title>
</head>

<body>
    <header class="flex">
        <a href="<?php echo view('workers') ?>">Все работники</a>
        <a href="<?php echo view('clients') ?>">Все Клиенты</a>
        <a href="<?php echo view('tovars') ?>">Все товары</a>
        <a href="<?php echo view('purchase_tovar') ?>">Закуп товара</a>
        <a href="<?php echo view('finance') ?>">Финансы</a>
        <a href="<?php echo view('rewiews') ?>">Отзывы</a>
        <a href="<?php echo view('tasks') ?>">Задачи</a>
        <a href="<?php echo view('orders') ?>">Заказы</a>

        <a href="/">Главная</a>
        <?php
        if (!isset($_SESSION['auth'])) {
        ?>
            <a href="<?php echo view("login") ?>">Войти</a>
        <?php
        } else {
        ?>
            <a href="<?php echo middleware('worker', 'logout') ?>">Выйти</a>
        <?php
        }
        ?>

    </header>

