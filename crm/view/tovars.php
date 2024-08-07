<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyUser();
model('Tovar');
$tovar_model = new Tovar();
$tovars = $tovar_model->get_all();

component('sidebar');
?>
<!-- <div class="container">
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
</div> -->

<div class='app'>
    <main class='project'>
        <div class='project-info'>
            <h1>Все Товары</h1>
            <?php
            if (isAdmin()) {
            ?>
                
            <?php
            }
            ?>

        </div>
        <div class="products-container">
            <?php
            if ($tovars) {
                foreach ($tovars as $tovar) {
            ?>
                    <div class="product-card">
                        <div class="product-title"><?php echo $tovar['name'] ?></div>
                        <div class="product-number">№ <?php echo $tovar['id'] ?></div>
                        <div class="product-price">Цена: <?php echo $tovar['price'] ?> руб.</div>
                        <div class="product-details">
                            <div class="product-season">Сезон: <?php echo $tovar['season'] ?></div>
                            <div class="product-category">Категория: <?php echo $tovar['name_2'] ?></div>
                            <div class="product-size">Размер: <?php echo $tovar['text'] ?></div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>


            <!-- Вы можете добавить больше карточек товаров здесь -->

        </div>
    </main>
</div>

<?php
component('footer');
?>