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
            <div class='project-reviews-column' id="reviews-container">

            </div>
            <div class="pagination-container">
                <div class="pagination" id="pagination">
                    <!-- Кнопки для навигации по страницам будут созданы здесь -->
                </div>
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
                                            echo bcdiv(($reviews_month / $reviews_count), 1, 2);;
                                        }
                                        ?>
                </h2>
        </div>
    </aside>
</div>
<script>
    const reviews = <?php echo json_encode($reviews); ?>; // Получаем отзывы из PHP
    const itemsPerPage = 4; // Количество отзывов на странице
    let currentPage = 1; // Текущая страница

    // Функция для отображения отзывов на текущей странице
    function displayReviews(page) {
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const paginatedReviews = reviews.slice(start, end);

        const reviewsContainer = document.getElementById('reviews-container');
        reviewsContainer.innerHTML = ''; // Очищаем контейнер перед добавлением отзывов

        paginatedReviews.forEach(review => {
            reviewsContainer.innerHTML += `
                <div class='task' draggable='true'>
                    <div class='task__tags'>
                        <span class='task__tag task__tag--copyright'>${review.first_name}</span>
                    </div>
                    <p>${review.comment}</p>
                    <div class='review__stats'>
                        <span class="rating">${'★'.repeat(review.rating)}${'☆'.repeat(5 - review.rating)}</span>
                        <span><time datetime="${review.date_reviews}"><i class="fas fa-flag"></i>${review.date_reviews}</time></span>
                    </div>
                </div>
            `;
        });
    }

    // Функция для создания кнопок навигации
    function setupPagination() {
        const paginationContainer = document.getElementById('pagination');
        paginationContainer.innerHTML = '';

        const totalPages = Math.ceil(reviews.length / itemsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement('button');
            button.innerText = i;
            button.className = 'page-button';
            button.onclick = () => {
                currentPage = i; // Устанавливаем текущую страницу
                displayReviews(currentPage); // Обновляем отображение отзывов
                highlightActiveButton(); // Обновляем выделение активной кнопки
            };
            paginationContainer.appendChild(button);
        }
        highlightActiveButton(); // Выделяем активную кнопку при первой инициализации
    }

    // Функция для выделения активной кнопки
    function highlightActiveButton() {
        const buttons = document.querySelectorAll('.page-button');
        buttons.forEach(button => {
            button.classList.remove('active'); // Убираем класс у всех
        });
        buttons[currentPage - 1].classList.add('active'); // Добавляем класс активной странице
    }

    // Инициализация
    displayReviews(currentPage);
    setupPagination();
</script>

<?php

component('footer');
?>