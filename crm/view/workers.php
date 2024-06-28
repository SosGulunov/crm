<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyUser();
model('Worker');
$worker_model = new Worker();
$workers = $worker_model->get_all();

component('header');
?>
<div class="container">
    <h1>Все работники</h1>
    <div class="adverts">

        <?php
        if ($workers) {
            foreach ($workers as $worker) {
        ?>
                <div class="advert">
                    <h4><?php echo $worker['first_name'] ?> <?php echo $worker['second_name'] ?></h4>
                    <p><?php echo $worker_model->get_id_position($worker['id_position']) ?> </p>
                    <a href="<?php echo view('worker') . "?id=" . $worker['id'] ?>">Подробнее</a>
                </div>
            <?php
            }
        } else {
            ?>
            <p>Работников нет</p>
        <?php
        }
        ?>

        <a href="<?php echo view('new_worker')?>">Добавить работника</a>

    </div>
</div>