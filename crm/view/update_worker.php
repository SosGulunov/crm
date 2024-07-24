<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyAdmin();
model('Worker');
model('Positions');
$Worker_model = new Worker();
$old = $Worker_model->get_one_by_id($_GET['id']);

$position = new Position();
$positions = $position->get_all();


if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
component('sidebar');
?>


<div class="container">
    <h1>Редактирование:</h1>
    <a href="<?php echo view('workers') ?>">Вернуться</a>

    <form action="<?php echo middleware('worker', 'update') . '?id=' . $_GET['id'] ?>" method="post" enctype="multipart/form-data">
        <label>
            Имя
            <input type="text" name="first_name" maxlength="18" value="<?php echo old($old, 'first_name') ?>">
        </label>
        <label>
            Фамилия
            <input type="text" name="second_name" maxlength="7" value="<?php echo old($old, 'second_name') ?>">
        </label>
        <label>
            Зарплата
            <input type="number" name="salary" maxlength="7" value="<?php echo old($old, 'salary') ?>">
        </label>
        <label>
            Контакт.инф
            <input type="text" name="contact_information" value="<?php echo old($old, 'contact_information') ?>">
        </label>
        <label>
            День рождение
            <input type="date" name="date_of_birth" value="<?php echo old($old, 'date_of_birth') ?>">
        </label>
        <label>
            Позиция в компании        
        <select name="id_position">
                <?php
                foreach ($positions as $position) {
                    $selected = old($old, 'id_position') == $positions['id'] ? " selected " : "";
                ?>
                    <option <?php echo $selected ?> value="<?php echo $position['id'] ?>"><?php echo $position['title'] ?></option>
                <?php
                }
                ?>
            </select>
        </label>    
        <button>Изменить</button>

    </form>
</div>

<?php
component('footer');
?>