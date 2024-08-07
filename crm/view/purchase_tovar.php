<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyUser();
model('Purchase');
$purchase_model = new Purchase();
$purchases = $purchase_model->get_all();

component('sidebar');
?>
<!-- <div class="container">
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
        if (isAdmin()) {
            ?><a href="<?php echo view('new_purchase_tovar') ?>">Добавить Закупку</a><?php
                                                                                    }
                                                                                        ?>

    </div>
</div> -->

<div class='app'>
    <main class='project'>
        <div class='project-info'>
            <h1>Закупка товара</h1>
            <?php
            if (isAdmin()) {
            ?>
                <h3><a href="<?php echo view('new_purchase_tovar') ?>"><i class='bx bx-plus'></i></a></h3>
            <?php
            }
            ?>

        </div>
        <div class="products-container">
            <?php
            if ($purchases) {
                foreach ($purchases as $purchase) {
            ?>
                    <div class="product-card">
                        <div class="product-title"><?php echo $purchase['name'] ?></div>
                        <div class="product-number">Дата- <?php echo $purchase['date'] ?></div>
                        <div class="product-price">Кол-во: <?php echo $purchase['count'] ?> </div>
                        <div class="product-quantity" style="margin-top: 15px; display: flex; align-items: center; justify-content: center;">
                            <button style="background-color: #f44336; color: white; border: none; border-radius: 5px; padding: 5px 10px; font-size: 1.5em; cursor: pointer;">-</button>
                            <span style="font-size: 1.5em; margin: 0 10px;">1</span>
                            <button style="background-color: #4CAF50; color: white; border: none; border-radius: 5px; padding: 5px 10px; font-size: 1.5em; cursor: pointer;">+</button>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </main>
</div>



<?php
component('footer');
?>