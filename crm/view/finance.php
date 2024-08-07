<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
onlyAdmin();
model('Finance');
component('sidebar');
?>

<!-- <div class="container">
    <h1>Редактирование:</h1>
    <a href="<?php echo view('finance') ?>">Вернуться</a>

    <form action="<?php echo middleware('finance', 'new') ?>" method="post" enctype="multipart/form-data">
        <label>
            начало счета финансов
            <input type="date" name="date_start" maxlength="" value="">
        </label>
        <label>
            конец ссчета финансов
            <input type="date" name="date_end" maxlength="" value="">
        </label>
        <label>
            Налоги
            <input type="int" name="taxes" maxlength="" value="">
        </label>
        <button>Добавить</button>

    </form>
</div> -->

<div class="containerrr">
    <h1>Финансы:</h1>
    <a href="<?php echo view('finance'); ?>">Очистить</a>

    <form action="<?php echo middleware('finance', 'new'); ?>" method="post" enctype="multipart/form-data">
        <label>
            начало счета финансов
            <input type="date" name="date_start" required>
        </label>
        <label>
            конец счета финансов
            <input type="date" name="date_end" required>
        </label>
        <label>
            Налоги
            <input type="number" name="taxes" required>
        </label>
        <button type="submit">Добавить</button>
    </form>

    <div id="charts" style="margin-top: 50px;">
        <h2>Графики финансовых данных</h2>
        <canvas id="financeChart" style="width: 100%; height: 400px;"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Загрузка данных после добавления новой записи  
        document.querySelector('form').onsubmit = function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    updateCharts(data);
                });
        };

        function updateCharts(data) {
            const ctx = document.getElementById('financeChart').getContext('2d');
            const financeChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Доходы', 'Расходы'],
                    datasets: [{
                        label: 'Финансовые данные',
                        data: [data.profit, data.expenses],
                        backgroundColor: ['rgba(75, 192, 192, 0.6)', 'rgba(255, 99, 132, 0.6)']
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>

</div>
<?php
component('footer');
?>