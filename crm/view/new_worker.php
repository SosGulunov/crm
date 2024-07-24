<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyAdmin();
model('Positions');
$position = new Position();
$positions = $position->get_all();
component('sidebar');
?>

<div class="container">
    <h1>Редактирование:</h1>
    <a href="<?php echo view('workers') ?>">Вернуться</a>

    <form action="<?php echo middleware('worker', 'new') ?>" method="post" enctype="multipart/form-data">
        <label>
            Имя
            <input type="text" name="first_name" maxlength="" value="">
        </label>
        <label>
            Фамилия
            <input type="text" name="second_name" maxlength="" value="">
        </label>
        <label>
            Зарплата
            <input type="number" name="salary" maxlength="" value="">
        </label>
        <label>
            Контакт.инф
            <input type="text" name="contact_information" value="">
        </label>
        <label>
            День рождение
            <input type="date" name="date_of_birth" value="">
        </label>
        <label>
            Дата начала работы
            <input type="date" name="start_work_date" maxlength="" value="">
        </label>
        <label>
            Логин
            <input type="text" name="login" value="">
        </label>
        <label>
            Пароль
            <input type="text" name="password" value="">
        </label>
        <label>
            Позиция в компании
            <select name="id_position">
                <?php
                foreach ($positions as $position) {
                ?>
                    <option value="<?php echo $position['id'] ?>"><?php echo $position['title'] ?></option>
                <?php
                }
                ?>
            </select>
        </label>
        <label>
            Админ Права
            <select name="isAdminRoot">
                <option value="1">есть</option>
                <option value="0">нет</option>

            </select>
        </label>
        <button>Добавить</button>

    </form>
</div>
<?php
component('footer');
?>

