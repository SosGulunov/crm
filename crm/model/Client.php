<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
connectDB();

class Clients
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

    public function get_all() // получить всех пользователей
    {
        try {
            $this->connect_db();
            $sql = "SELECT * FROM `clients` ";
            $req = $this->pdo->query($sql);
            $rezult = $req->fetchAll();
            $this->close_db();
        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }

        return $rezult;
    }

    public function get_all_transaction_by_id($id)
    {
        try {
            $this->connect_db();
            $sql = 'SELECT th.id, c.first_name, th.id_tovar, t.name,  th.Date_of_purchase, th.count
        FROM transactionHistory th
        JOIN clients c ON th.id_client = c.id
        JOIN tovars t ON th.id_tovar = t.id
        WHERE c.id = :id';
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'id' => $id
            ]);
            $rezult = $req->fetchAll(); // Метод fetchAll() возвращает все строки результатов, а не только одну
            $this->close_db();
        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }
        return $rezult;
    }
}
