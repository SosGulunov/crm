<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
connectDB();

class Reviews
{
    private PDO|null $pdo;

    public function __construct()
    {
        $this->pdo = null;
    }

    private function connect_db()
    { //метод подключения к БД
        $db = new DB();
        $this->pdo = $db->getConnect();
    }

    private function close_db()
    { //метод отключения к БД
        $this->pdo = null;
    }

    public function get_all() // получить все отзывы
    {
        try {
            $this->connect_db();
            $sql = "SELECT r.*, c.first_name 
            FROM reviews r
            JOIN clients c ON r.id_client = c.id
            ORDER BY r.date_reviews DESC";
            $req = $this->pdo->query($sql);
            $rezult = $req->fetchAll();
            $this->close_db();
        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }

        return $rezult;
    }

    public function get_all_by_month() // получить все отзывы
{
    try {
        $this->connect_db();
        $sql = "SELECT SUM(rating) AS total_rating
                FROM reviews r
                WHERE r.date_reviews >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);"; // Используем DATE_SUB
        $req = $this->pdo->prepare($sql);
        $req->execute(); // Выполняем запрос
        $rezult = $req->fetchColumn(); // Получаем только первый столбец первой строки
        $this->close_db();
    } catch (\Throwable $th) {
        echo "Ошибка БД или SQL [!] <br>" . $th;
        die();
    }

    return $rezult ?: 0; // Возвращаем 0, если результат NULL
}
    
    public function delete($id)
    {
        try {
            $this->connect_db();
            $sql = "DELETE FROM `reviews` WHERE `id` = :id";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'id' => $id,
            ]);
            $rezult = $req->rowCount();
            $this->close_db();
        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }
        return $rezult;
    }

    public function reviews_count()
    {
        try {
            $this->connect_db();
            $sql = "SELECT COUNT(*) AS total_count
                FROM reviews r
                WHERE r.date_reviews >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);"; // Используем DATE_SUB
            $req = $this->pdo->prepare($sql);
            $req->execute(); // Выполняем запрос
            $rezult = $req->fetchColumn(); // Получаем только первый столбец первой строки
            $this->close_db();
        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }
        return $rezult; // Возвращаем результат
    }

    public function unreaded_count($login)
    {
        try {
            $this->connect_db();
            $sql = "SELECT COUNT(*) AS total_count
                FROM reviews r
                JOIN workers w 
                WHERE r.date_reviews > w.last_date_on_reviews and w.login = :login"; 
            $req = $this->pdo->prepare($sql);
            $req->execute(
                [
                    'login' => $login,
                ]
            ); // Выполняем запрос
            $rezult = $req->fetchColumn(); // Получаем только первый столбец первой строки
            $this->close_db();
        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }
        return $rezult; // Возвращаем результат
    }
}
