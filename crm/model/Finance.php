<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
connectDB();

class Finance
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
            $sql = "SELECT * FROM `Finance` ";
            $req = $this->pdo->query($sql);
            $rezult = $req->fetchAll();
            $this->close_db();
        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }

        return $rezult;
    }

    public function add($data,$expenses,$profit){
        try {
            $this->connect_db();
            $sql = "INSERT INTO `Finance` (`date_start`, `date_end`, `taxes`, `expenses`, `profit`) VALUES (:date_start, :date_end, :taxes, :expenses, :profit)";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'date_start' => $data['date_start'],
                'date_end' => $data['date_end'],
                'expenses' => $expenses,
                'profit' => $profit,
                'taxes' => $data['taxes'],
            ]);
            $count = $req->rowCount(); // количество добавленных работников
            $this->close_db();
        } catch (\Throwable $th) {
            die($th);
        }
        return $count;
    }

    public function expenses($start,$end){
        try {
            $this->connect_db();
            $sql = "SELECT pt.*, t.price, w.salary FROM purchase_tovar pt 
            JOIN tovars t 
            JOIN workers w 
            WHERE pt.tovar_id = t.id
            AND pt.date BETWEEN :start AND :end";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'start' => $start,
                'end' => $end,
            ]);
            $rezult = $req->fetchAll(); // количество добавленных работников
            $this->close_db();
        } catch (\Throwable $th) {
            die($th);
        }
        return $rezult;
    }

    public function profit($start,$end){
        try {
            $this->connect_db();
            $sql = "SELECT o.*, t.price FROM orders o
            JOIN tovars t WHERE o.tovar_id = t.id
            AND DATE(o.date_order) BETWEEN :start AND :end AND o.status_order = 1";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'start' => $start,
                'end' => $end,
            ]);
            $rezult = $req->fetchAll(); // количество добавленных работников
            $this->close_db();
        } catch (\Throwable $th) {
            die($th);
        }
        return $rezult;
    }

    
}
