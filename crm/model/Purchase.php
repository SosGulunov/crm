<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
connectDB();

class Purchase
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
            $sql = "SELECT p.*, t.name
            FROM purchase_tovar p
            JOIN tovars t ON p.tovar_id = t.id";
            $req = $this->pdo->query($sql);
            $rezult = $req->fetchAll();
            $this->close_db();
        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }

        return $rezult;
    }

    public function add($data){
        try {
            $this->connect_db();
            $sql = "INSERT INTO `purchase_tovar` (`tovar_id`, `count`, `date`) VALUES (:tovar_id, :count, :date)";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'tovar_id' => $data['tovar_id'],
                'count' => $data['count'],
                'date' => $data['date'],
            ]);
            $count = $req->rowCount(); // количество добавленных работников
            $this->close_db();
        } catch (\Throwable $th) {
            die($th);
        }
        return $count;
    }

    
}