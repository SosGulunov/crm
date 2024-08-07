<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyUser();
model('Finance');
$finance_model = new Finance();
$finances = $finance_model->get_all();

component('sidebar');
?>
<!-- <div class="container">
    <h1>Финансы по промежуткам</h1>
    <div class="adverts">

        <?php
        if ($finances) {
            foreach ($finances as $finance) {
        ?>
                <div class="advert">
                    <p>С <?php echo $finance['date_start'] ?> по <?php echo $finance['date_end'] ?> </p>
                    <p>Расходы - <?php echo $finance['expenses'] ?></p>
                    <p>Доходы - <?php echo $finance['profit'] ?></p>
                    <p>Налоги - <?php echo $finance['taxes'] ?></p>
                    <h3>Итого: <?php echo $finance['profit'] - $finance['expenses'] - $finance['taxes'] ?></h3>
                </div>

            <?php

            }
        } else {
            ?>
            <p>Финансовых промежуток не найдено</p>
        <?php
        }
        ?>
        <a href="<?php echo view('new_finance') ?>">Добавить финансовый промежуток </a>
    </div>
</div> -->


<?php
component('footer');
?>