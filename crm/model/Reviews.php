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
            JOIN clients c ON r.id_client = c.id";
            $req = $this->pdo->query($sql);
            $rezult = $req->fetchAll();
            $this->close_db();

        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }

        return $rezult;
    }

    public function delete($id){
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

}
