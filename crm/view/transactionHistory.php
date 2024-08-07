<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyUser();
model('Order');
$order_model = new Order();
$orders = $order_model->get_all();

component('sidebar');
?>
<!-- <div class="container">
    <h1>Все заказы клиентов</h1>
    <div class="adverts">
        
        <?php
        if ($orders) {
            foreach ($orders as $order) {
                ?>
                <?php
                if ($order['status_order'] == 1) {
                    
                    
                    ?>
                    <div class="advert">
                        <p>Закасчик - <?php echo $order['first_name'] ?></p>
                        <p>Товар - <?php echo $order['name'] ?></p>
                        <p>Дата заказа - <?php echo $order['date_order'] ?></p>
                        <p>кол-во - <?php echo $order['count'] ?></p>
                        <p>Адресс - <?php echo $order['adress_order'] ?></p>
                        <form action="<?php echo middleware('order', 'unreadiness') . '?id=' . $order['id'] ?>" method="post">
                            <button>Вернуть</button>
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
            <a href="<?php echo view('orders') ?>">Вернуться</a>
        </div>
    </div> -->
    
    
    <link rel="stylesheet" href="<?php echo assets() ?>css/orders.css">
    <div class="container-orders">
        <h1>История заказов</h1>
        
        <table>
            <thead>
                <tr>
                    <th>Заказчик</th>
                    <th>Товар</th>
                    <th>Дата заказа</th>
                    <th>Кол-во</th>
                    <th>Адрес</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($orders) {
                foreach ($orders as $order) {
            ?>
                    <?php
                    if ($order['status_order'] == 1) {
                    ?>
                        <tr>
                            <td><?php echo $order['first_name'] ?></td>
                            <td><?php echo $order['name'] ?></td>
                            <td><?php echo $order['date_order'] ?></td>
                            <td><?php echo $order['count'] ?></td>
                            <td><?php echo $order['adress_order'] ?></td>
                            <td>
                                <form action="<?php echo middleware('order', 'unreadiness') . '?id=' . $order['id'] ?>" method="post">
                                    <button class="button">Вернуть</button>
                                </form>
                            </td>
                        </tr>
            <?php
                    }
                }
            }
            ?>

            <!-- Добавьте сюда больше заказов по необходимости -->
        </tbody>
    </table>
</div>
<a href="<?php echo view('orders') ?>"><button class="history-button">Вернуться</button></a>

<?php
component('footer');
?>