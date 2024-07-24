<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyUser();
model('Tovar');
$tovar_model = new Tovar();
$tovars = $tovar_model->get_all();

component('sidebar');
?>
<div class="container">
    <h1>Все товары</h1>
    <div class="adverts">

        <?php
        if ($tovars) {
            foreach ($tovars as $tovar) {
        ?>
                <div class="advert">
                    <p>Товар №<?php echo $tovar['id'] ?></p>
                    <p>Название - <?php echo $tovar['name'] ?></p>
                    <p>Цена - <?php echo $tovar['price'] ?></p>
                    <p>Сезон - <?php echo $tovar['season'] ?></p>
                    <p>Категория товара - <?php echo $tovar['name_2'] ?></p>
                    <p>Размер товара - <?php echo $tovar['text'] ?></p>
                    <?php
                    if (isAdmin()) {
                    ?>
                    <a href="<?php echo view('update_tovar') . "?id=" . $tovar['id'] ?>">Изменить</a>
                    <?php } ?>
                    
                </div>
            <?php
            }
        } else {
            ?>
            <p>Товаров нет</p>
        <?php
        }
        ?>

    </div>
</div>

<?php
component('footer');
?>