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

    public function get_all_by_priority() // получить все товары
    {
        try {
            $this->connect_db();
            $sql = "SELECT t.*, w.first_name, w.second_name
                FROM tasks t 
                JOIN workers w ON t.responsible = w.id
                ORDER BY t.priority DESC";
            $req = $this->pdo->query($sql);
            $rezult = $req->fetchAll();
            $this->close_db();

        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }

        return $rezult;
    }

    public function get_all_by_date() // получить все товары
    {
        try {
            $this->connect_db();
            $sql = "SELECT t.*, w.first_name, w.second_name
                FROM tasks t 
                JOIN workers w ON t.responsible = w.id
                ORDER BY t.deadline DESC";
            $req = $this->pdo->query($sql);
            $rezult = $req->fetchAll();
            $this->close_db();

        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }

        return $rezult;
    }

    public function new($data)
    {

        try {
            $this->connect_db();
            $sql = "INSERT INTO `tasks` (`name_task`, `description_task`, `deadline`, `priority`, `responsible`) VALUES (:name_task, :description_task, :deadline, :priority, :responsible)";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'name_task' => $data['name_task'],
                'description_task' => $data['description_task'],
                'deadline' => $data['deadline'],
                'priority' => $data['priority'],
                'responsible' => $data['responsible'],
            ]);
            $count = $req->rowCount(); // количество добавленных работников
            $this->close_db();
        } catch (\Throwable $th) {
            die($th);
        }
        return $count;
    }

    public function readiness($id)
    {
        try {
            $this->connect_db();
            $sql = "UPDATE `tasks` SET `status` = :status, `deadline` = DATE_ADD(`deadline` , INTERVAL 10 YEAR) WHERE `id` = :id ";
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
            $sql = "UPDATE `tasks` SET `status` = :status, `deadline` = DATE_SUB(`deadline` , INTERVAL 10 YEAR)  WHERE `id` = :id ";
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

    public function unreaded_count($login)
    {
        try {
            $this->connect_db();
            $sql = "SELECT COUNT(*) AS total_count
                FROM tasks r
                JOIN workers w 
                WHERE r.date_start > w.last_date_on_tasks and w.login = :login"; 
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