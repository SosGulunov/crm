<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyAdmin();
model('Tovar');
$tovar_model = new Tovar();
$old = $tovar_model->get_one_by_id($_GET['id']);


if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

$sizes = $tovar_model->get_all_by_size_id();
$categories = $tovar_model->get_all_by_categories_id();
component('sidebar');
?>

<div class="container">
    <h1>Редактирование:</h1>
    <a href="<?php echo view('workers') ?>">Вернуться</a>

    <form action="<?php echo middleware('tovar', 'update') . '?id=' . $_GET['id'] ?>" method="post" enctype="multipart/form-data">
        <label>
            Название
            <input type="text" name="name" maxlength="18" value="<?php echo old($old, 'name') ?>">
        </label>
        <label>
            Цена
            <input type="texnumbert" name="price" maxlength="7" value="<?php echo old($old, 'price') ?>">
        </label>
        <label>
            Сезон
            <input type="text" name="season" maxlength="7" value="<?php echo old($old, 'season') ?>">
        </label>
        <label>
            Кол-во
            <input type="number" name="count" value="<?php echo old($old, 'count') ?>">
        </label>
        <label>
            Категория товара
            <select name="category_id">
                <?php
                foreach ($categories as $category) {
                ?>
                    <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                <?php
                }
                ?>
            </select>
        </label>
        <label>
            <select name="size_id">
                <?php
                foreach ($sizes as $size) {
                ?>
                    <option value="<?php echo $size['id'] ?>"><?php echo $size['text'] ?></option>
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