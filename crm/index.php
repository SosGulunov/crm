<?php
session_start();
require_once "functions.php";

onlyUser();


component('sidebar');

?>
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    section {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .orders-info,
    .purchase-info,
    .reviews-info {
        background: linear-gradient(to bottom right, #e0f7fa, #ffffff);
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        padding: 20px;
        overflow: hidden;
        position: relative;
        flex: 1 1 calc(30% - 20px);
        /* Сделаем их больше */
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .orders-info:hover,
    .purchase-info:hover,
    .reviews-info:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 30px rgba(0, 0, 0, 0.2);
    }

    h3 {
        color: #00796b;
        margin-bottom: 15px;
        font-size: 1.5em;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    #home li {
        padding: 10px 0;
        transition: color 0.2s;
    }

    li:last-child {
        border-bottom: none;
    }

    li:hover {
        color: #00796b;
    }

    .finance-info {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        padding: 20px;
        flex: 1 1 100%;
        /* Занимает всю ширину */
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .chart-container {
        display: flex;
        justify-content: space-between;
        width: 100%;
        height: 400px;
        margin-top: 20px;
    }

    /* Media query для адаптивности */
    @media (max-width: 768px) {

        .orders-info,
        .purchase-info,
        .finance-info,
        .reviews-info {
            flex: 1 1 100%;
            /* Одна колонка на маленьких экранах */
        }
    }
</style>

<div class="container">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <h1>Общие сводки</h1> -->
    <section id="home">

        <div class="finance-info">

            <div class="chart-container">
                <canvas id="financeChart"></canvas>
                <div>
                    <h3>Показатели:</h3>
                    <p>Общий доход: 1,500,000 ₽</p>
                    <p>Общие расходы: 1,200,000 ₽</p>
                    <p>Прибыль: 300,000 ₽</p>
                </div>

            </div>
        </div>

        <div class="orders-info">
            <h3>Актуальные Заказы</h3>
            <ul>
                <li>Заказ №001 - Товар X - 5 штук - Статус: В обработке</li>
                <li>Заказ №002 - Товар Y - 3 штуки - Статус: Доставлен</li>
                <li>Заказ №003 - Товар Z - 10 штук - Статус: В ожидании</li>
            </ul>
        </div>

        <div class="purchase-info">
            <h3>Последние Закупки Товаров</h3>
            <ul>
                <li>Товар A - Закуплено 50 штук - Дата: 2023-11-01</li>
                <li>Товар B - Закуплено 20 штук - Дата: 2023-10-30</li>
                <li>Товар C - Закуплено 100 штук - Дата: 2023-10-25</li>
            </ul>
        </div>


        <div class="reviews-info">
            <h3>Последние Отзывы</h3>
            <ul>
                <li>"Отличный сервис!" - Иван И.</li>
                <li>"Быстрая доставка!" - Анастасия П.</li>
                <li>"Качество товаров на высоте!" - Сергей К.</li>
            </ul>
        </div>
    </section>
</div>
<script>
    const ctx = document.getElementById('financeChart').getContext('2d');
    const financeChart = new Chart(ctx, {
        type: 'doughnut', // Тип графика
        data: {
            labels: ['Доход', 'Расходы', 'Прибыль'],
            datasets: [{
                label: 'Финансовые Показатели',
                data: [1500000, 1200000, 300000],
                backgroundColor: [
                    'rgba(76, 175, 80, 0.6)',
                    'rgba(255, 193, 7, 0.6)',
                    'rgba(255, 82, 82, 0.6)'
                ],
                borderColor: [
                    'rgba(76, 175, 80, 1)',
                    'rgba(255, 193, 7, 1)',
                    'rgba(255, 82, 82, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Финансовые Показатели (в ₽)'
                }
            }
        }
    });
</script>

<?php


component('footer');
