<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyUser();
model('Reviews');
model("Worker");

$user = new Worker();
$user->update_last_time($_SESSION['auth']['id']);


$review_model = new Reviews();
$reviews = $review_model->get_all();
$reviews_month = $review_model->get_all_by_month();
$reviews_count = $review_model->reviews_count();
$rating_sum = 0;
$rating_sum_by_month = 0;

component('sidebar');
?>



<div class='app'>
    <main class='project'>
        <div class='project-info'>
            <h1>Все Комментарии</h1>
        </div>
        <div class='project-column-heading'>
            <h2 class='project-column-heading__title'>Комментарии </h2><button class='project-column-heading__options'></button>
        </div>
        <div class='project-reviews'>
            <div class='project-reviews-column'>
                <?php
                foreach ($reviews as $review) {
                    $rating = $review['rating'];
                    $rating_sum = $rating_sum + $review['rating'];
                ?>
                    <div class='task' draggable='true'>
                        <div class='task__tags'><span class='task__tag task__tag--copyright'><?php echo $review['first_name'] ?></span>
                            <?php
                            if (isAdmin()) {
                            ?>
                                <button class='task__options'><a href="<?php echo middleware('review', 'delete') . "?id=" . $review['id'] ?>"><i class='bx bxs-comment-x'></i></a></button>
                            <?php
                            }
                            ?>
                        </div>

                        <p><?php echo $review['comment'] ?></p>
                        <div class='review__stats'>
                            <?php
                            if ($rating >= 1 && $rating <= 5) {
                                echo '<span class="rating">';
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $rating) {
                                        echo '<span class="filled">★</span>'; // Полная звезда
                                    } else {
                                        echo '<span class="empty">☆</span>'; // Пустая звезда
                                    }
                                }
                                echo '</span>';
                            } else {
                                echo 'Рейтинг должен быть от 1 до 5.';
                            }
                            ?>
                            <span><time datetime="2021-11-24T20:00:00"><i class="fas fa-flag"></i><?php echo $review['date_reviews'] ?></time></span>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </main>
    <aside class='task-details'>
        <div class='tag-progress'>
            <h2>За последние месяц пользователи оставили <?php echo $reviews_count ?>
                <?php
                $lastDigit = $reviews_count % 10;
                if ($lastDigit == 1) {
                    echo 'сообщение!';
                } else if ($lastDigit < 5 && $lastDigit > 0) {
                    echo "сообщения!";
                } else {
                    echo 'сообщений!';
                }
                ?>
            </h2>
            <h3>Средняя оценка была: <?php
                                        if (!$reviews_count) {
                                            echo 0;
                                        } else {
                                            echo $reviews_month / $reviews_count;
                                        }
                                        ?>
                </h2>
        </div>
    </aside>
</div>

<?php

component('footer');
?>