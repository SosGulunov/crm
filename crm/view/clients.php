<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyUser();
model('Client');
$client_model = new Clients();
$clients = $client_model->get_all();

component('sidebar');
?>
<div class="container">
    <h1>Все наши клиенты</h1>
    <div class="adverts">

        <?php
        if ($clients) {
            foreach ($clients as $client) {
        ?>
                <div class="advert">
                    <p>Аккаунт №<?php echo $client['id'] ?></p>
                    <p>Имя - <?php echo $client['first_name'] ?></p>
                    <p>Фамилия - <?php echo $client['second_name'] ?></p>
                    <p>Телефон - <?php echo $client['phone_number'] ?></p>
                    <p>Эл.почта - <?php echo $client['email'] ?></p>
                    <p>Адрес - <?php echo $client['address'] ?></p>
                    <p>День Рождения -
                        <?php
                        if ($client['birthday'] != null) {
                            echo $client['birthday'];
                        } else {
                            echo "Не указан";
                        }
                        ?></p>
                    <a href="<?php echo view('clientsHistory') . "?id=" . $client['id'] ?>">Посмотреть историю сделок</a>
                </div>
            <?php
            }
        } else {
            ?>
            <p>Клиентов нет</p>
        <?php
        }
        ?>

    </div>
</div>

<?php
component('footer');
?>