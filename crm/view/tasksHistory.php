<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyUser();
model('Task');
$task_model = new Task();
$tasks = $task_model->get_all();

component('sidebar');
?>
<div class="container">
    <h1>Все задачи</h1>
    <div class="adverts">

        <?php
        if ($tasks) {
            foreach ($tasks as $task) {
        ?>
                <?php
                $date = $task['deadline'];
                if($task['status'] == 1){
                ?>
                    <div class="advert">
                        <p>заголовок - <?php echo $task['name_task'] ?></p>
                        <p>описание - <?php echo $task['description_task'] ?></p>
                        <p>старт задачи - <?php echo $task['date_start'] ?></p>
                        <p>дедлайн -
                            <?php echo $task['deadline'] ?>
                        </p>
                        <p>Приоритет - <?php
                                        if ($task['priority'] == 1) {
                                            echo '<div class="red">Красный</div>';
                                        } else {
                                            echo '<div class="green">Зеленый</div>';
                                        }
                                        ?></p>
                        <p>Ответственный - <?php echo $task['first_name'] ?> <?php echo $task['second_name'] ?></p>
                        <?php
                        if($date <= date('Y-m-d')){
                            ?>
                            <button>Задача просрочена</button>
                        <?php
                        }
                        else{
                            ?>
                        <form action="<?php echo middleware('task', 'unreadiness') . '?id=' . $task['id'] ?>" method="post">
                            <button>Вернуть задачу</button>
                        </form>
                        <?php    
                        }
                        
                        ?>
                    </div>

                <?php

                }

                ?>

            <?php
            }
        } else {
            ?>
            <p>Товаров нет</p>
        <?php
        }
        ?>
        <h3><a href="<?php echo view('tasks') ?>">Вернуться</a></h3>
    </div>
</div>

<?php
component('footer');
?>