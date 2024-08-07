<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
connectDB();

class Tovar
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
            $sql = "SELECT t.*, c.name as name_2, s.text 
                FROM tovars t 
                LEFT JOIN categorys c ON t.category_id = c.id 
                LEFT JOIN size s ON t.size_id = s.id";
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

    public function update($data, $id)
    {
        try {
            $this->connect_db();
            $sql = "UPDATE `tovars` SET `name` = :name, `price` = :price, `season` = :season, `count` = :count, `category_id` = :category_id, `size_id` = :size_id  WHERE `id` = :id ";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'id' => $id,
                'name' => $data['name'],
                'price' => $data['price'],
                'season' => $data['season'],
                'count' => $data['count'],
                'category_id' => $data['category_id'],
                'size_id' => $data['size_id'],
            ]);
            $rezult = $req->rowCount();
            $this->close_db();
        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }
        return $rezult;
    }

    public function get_all_by_size_id(){
        try {
            $this->connect_db();
            $sql = "SELECT * FROM `size` ";
            $req = $this->pdo->query($sql);
            $rezult = $req->fetchAll();
            $this->close_db();
        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }

        return $rezult;
    }

    public function get_all_by_categories_id(){
        try {
            $this->connect_db();
            $sql = "SELECT * FROM `categorys` ";
            $req = $this->pdo->query($sql);
            $rezult = $req->fetchAll();
            $this->close_db();
        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }

        return $rezult;
    }


}
