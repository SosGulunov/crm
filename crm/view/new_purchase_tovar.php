<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyAdmin();
model('Purchase');
model('Tovar');
$purchase_model = new Purchase();
$purchases = $purchase_model->get_all();

$tovars_model = new Tovar();
$tovars = $tovars_model->get_all();
component('sidebar');
?>

<div class="container">
    <h1>Добавление закупки:</h1>
    <a href="<?php echo view('purchase_tovar') ?>">Вернуться</a>

    <form action="<?php echo middleware('purchase', 'new') ?>" method="post" enctype="multipart/form-data">
        
        <label>
            Товар
            <select name="tovar_id">
                <?php
                foreach ($tovars as $tovar) {
                ?>
                    <option value="<?php echo $tovar['id'] ?>"><?php echo $tovar['name'] ?></option>
                <?php
                }
                ?>
            </select>
        </label>
        <label>
            Кол-во
            <input type="int" name="count" maxlength="" value="">
        </label>
        <label>
            Дата
            <input type="date" name="date" maxlength="" value="">
        </label>
        <button>Добавить</button>

    </form>
</div>
<?php
component('footer');
?>