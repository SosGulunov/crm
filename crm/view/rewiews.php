<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyUser();
model('Reviews');
$review_model = new Reviews();
$reviews = $review_model->get_all();

component('header');
?>
<div class="container">
    <h1>Все отзывы</h1>
    <div class="adverts">

        <?php
        if ($reviews) {
            foreach ($reviews as $review) {
        ?>
                <div class="advert">
                    <p>Комментарий клиента - <?php echo $review['first_name'] ?></p>
                    <p>Оценка - <?php echo $review['rating'] ?></p>
                    <p>Коммент - <?php echo $review['comment'] ?></p>
                    <p>Время - <?php echo $review['date_reviews'] ?></p>
                    <a href="<?php echo middleware('review', 'delete') . "?id=" . $review['id'] ?>">Удалить данные</a>
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