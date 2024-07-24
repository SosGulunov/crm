<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
connectDB();

class Order
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
            $sql = "SELECT o.*, c.first_name, t.name
            FROM orders o
            JOIN clients c ON o.client_id = c.id
            JOIN tovars t ON o.tovar_id = t.id";
            $req = $this->pdo->query($sql);
            $rezult = $req->fetchAll();
            $this->close_db();

        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }

        return $rezult;
    }

    public function get_one_by_id($id) 
    {
        try {
            $this->connect_db();
            $sql = "SELECT o.*, c.first_name, t.name
            FROM orders o
            JOIN clients c ON o.client_id = c.id
            JOIN tovars t ON o.tovar_id = t.id WHERE client_id = :id";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'id' => $id
            ]);
            $rezult = $req->fetchAll();
            $this->close_db();

        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }

        return $rezult;
    }

    public function readiness($id)
    {
        try {
            $this->connect_db();
            $sql = "UPDATE `orders` SET `status_order` = :status  WHERE `id` = :id ";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'id' => $id,
                'status' => 1,
            ]);
            $rezult = $req->rowCount();
            $this->close_db();
        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }
        return $rezult;
    }

    public function unreadiness($id)
    {
        try {
            $this->connect_db();
            $sql = "UPDATE `orders` SET `status_order` = :status  WHERE `id` = :id ";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'id' => $id,
                'status' => 0,
            ]);
            $rezult = $req->rowCount();
            $this->close_db();
        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }
        return $rezult;
    }


}