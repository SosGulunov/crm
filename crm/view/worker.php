<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
model('Worker');
onlyAdmin();
$worker_model = new Worker();
$workers = $worker_model->get_one_by_id($_GET['id']);

if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

component('sidebar');
?>
<div class="container">
    <h1>Профиль</h1>

    <div>
        <p>Аккаунт №<?php echo $_GET['id'] ?></p>
        <p>Имя - <?php echo $workers['first_name'] ?></p>
        <p>Фамилия - <?php echo $workers['second_name'] ?></p>
        <p>Дата начала работы - <?php echo $workers['start_work_date'] ?></p>
        <p>Зарплата - <?php echo $workers['salary'] ?>.руб</p>
        <p>Кон.информация - <?php echo $workers['contact_information'] ?></p>
        <p>День Рождения - <?php echo $workers['date_of_birth'] ?></p>
        <p>Логин - <?php echo $workers['login'] ?></p>
        <p>Пароль - <?php echo "********" ?></p>
        <p>Админ Права - <?php
            if($workers['isAdminRoot']){
                echo "Есть";
            }
            else{
                echo "Нет";
            }?>
        </p>
        <p>Позиция в компании - <?php echo $workers['title'] ?></p>
    </div>
        
    <a href="<?php echo view('update_worker') . "?id=" . $_GET['id']?>">Изменить данные</a>
    <a href="<?php echo middleware('worker', 'delete') . "?id=" . $_GET['id'] ?>">Удалить данные</a>
</div>

<?php
component('footer');
?>
