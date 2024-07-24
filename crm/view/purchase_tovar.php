<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyUser();
model('Purchase');
$purchase_model = new Purchase();
$purchases = $purchase_model->get_all();

component('sidebar');
?>
<div class="container">
    <h1>Все закупки</h1>
    <div class="adverts">

        <?php
        if ($purchases) {
            foreach ($purchases as $purchase) {
        ?>
                <div class="advert">
                    <h4>Товар - <?php echo $purchase['name'] ?></h4>
                    <p>Дата - <?php echo $purchase['date'] ?> </p>
                    <p>Кол-во <?php echo $purchase['count'] ?> </p>
                </div>
            <?php
            }
        } else {
            ?>
            <p>Закупкок нет</p>
            <?php
        }
        if(isAdmin()){
            ?><a href="<?php echo view('new_purchase_tovar')?>">Добавить Закупку</a><?php
        }
        ?>

    </div>
</div>
<?php
component('footer');
?>