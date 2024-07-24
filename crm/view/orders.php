<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyUser();
model('Order');
$order_model = new Order();
$orders = $order_model->get_all();

component('sidebar');
?>
<div class="container">
    <h1>Все активные заказы</h1>
    <div class="adverts">

        <?php
        if ($orders) {
            foreach ($orders as $order) {
        ?>
                <?php
                if ($order['status_order'] == 0) {
                ?>
                    <div class="advert">
                        <p>Заказчик - <?php echo $order['first_name'] ?></p>
                        <p>Товар - <?php echo $order['name'] ?></p>
                        <p>Дата заказа - <?php echo $order['date_order'] ?></p>
                        <p>Кол-во - <?php echo $order['count'] ?></p>
                        <p>Адресс - <?php echo $order['adress_order'] ?></p>
                        <form action="<?php echo middleware('order', 'readiness') . '?id=' . $order['id'] ?>" method="post">
                            <button>Готово</button>
                        </form>
                    <?php
                }
                    ?>

                    </div>
                <?php
            }
        } else {
                ?>
                <p>Товаров нет</p>
            <?php
        }
            ?>

            <a href="<?php echo view('transactionHistory') ?>">История заказов</a>
    </div>
</div>
<?php
component('footer');
?>