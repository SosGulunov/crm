<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyAdmin();
model('Finance');
component('sidebar');
?>

<div class="container">
    <h1>Редактирование:</h1>
    <a href="<?php echo view('finance') ?>">Вернуться</a>

    <form action="<?php echo middleware('finance', 'new') ?>" method="post" enctype="multipart/form-data">
        <label>
            начало счета финансов
            <input type="date" name="date_start" maxlength="" value="">
        </label>
        <label>
            конец ссчета финансов
            <input type="date" name="date_end" maxlength="" value="">
        </label>
        <label>
            Налоги
            <input type="int" name="taxes" maxlength="" value="">
        </label>
        <button>Добавить</button>

    </form>
</div>
<?php
component('footer');
?>