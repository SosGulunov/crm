<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
connectDB();

class Task
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

    public function get_all() // получить все товары
    {
        try {
            $this->connect_db();
            $sql = "SELECT t.*, w.first_name, w.second_name
                FROM tasks t 
                JOIN workers w ON t.responsible = w.id";
            $req = $this->pdo->query($sql);
            $rezult = $req->fetchAll();
            $this->close_db();

        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }

        return $rezult;
    }

    public function get_one_by_id($id) // получить 1 товар по id
    {
        try {
            $this->connect_db();
            $sql = "SELECT `name`, `price`, `season`, `count`, `category_id`, `size_id` FROM `tovars` WHERE `id` = :id";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'id' => $id
            ]);
            $rezult = $req->fetch();
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
            $sql = "UPDATE `tasks` SET `status` = :status  WHERE `id` = :id ";
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
            $sql = "UPDATE `tasks` SET `status` = :status  WHERE `id` = :id ";
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