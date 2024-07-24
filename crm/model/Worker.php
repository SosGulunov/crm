<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
connectDB();

class Worker
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

    public function get_all() // получить всех работников
    {
        try {
            $this->connect_db();
            $sql = "SELECT * FROM `workers` ";
            $req = $this->pdo->query($sql);
            $rezult = $req->fetchAll();
            $this->close_db();
        } catch (\Throwable $th) {
            echo "Ошибка БД или SQL [!] <br>" . $th;
            die();
        }

        return $rezult;
    }

    public function get_one_by_id($id) // получить 1 работника по id
    {
        try {
            $this->connect_db();
            $sql = "SELECT `id`, `first_name`, `second_name`, `start_work_date`, `salary`, `contact_information`, `date_of_birth`, `login`, `password`, `isAdminRoot`, `id_position` FROM `workers` WHERE `id` = :id";
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

    public function new($data)
    {

        try {
            $this->connect_db();
            $sql = "INSERT INTO `workers` (`first_name`, `second_name`, `start_work_date`, `salary`, `contact_information`, `date_of_birth`, `login`, `password`, `isAdminRoot`, `id_position` ) VALUES (:first_name, :second_name, :start_work_date, :salary, :contact_information, :date_of_birth, :login, :password, :isAdminRoot, :id_position)";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'first_name' => $data['first_name'],
                'second_name' => $data['second_name'],
                'start_work_date' => $data['start_work_date'],
                'salary' => $data['salary'],
                'contact_information' => $data['contact_information'],
                'date_of_birth' => $data['date_of_birth'],
                'login' => $data['login'],
                'password' => md5($data['password']),
                'isAdminRoot' => $data['isAdminRoot'],
                'id_position' => $data['id_position']
            ]);
            $count = $req->rowCount(); // количество добавленных работников
            $this->close_db();
        } catch (\Throwable $th) {
            die($th);
        }
        return $count;
    }
    
    public function authtorize($login, $password)
    {
        try {
            $password = md5($password);
            $this->connect_db();
            $sql = "SELECT `id` FROM `workers` WHERE `login` = :login AND `password` = :password ";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'login' => $login,
                'password' => $password
            ]);
            $users = $req->fetch();
            $count = $req->rowCount();
            $this->close_db();
        } catch (\Throwable $th) {
            die($th);
        }
        if ($count == 1) {
            return $users['id'];
        } else {
            return false;
        }

    }

    

    public function auto($login, $password)
    {
        try {
            $password = $password;
            $this->connect_db();
            $sql = "SELECT `id` FROM `workers` WHERE `login` = :login AND `password` = :password ";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'login' => $login,
                'password' => $password
            ]);
            $users = $req->fetch();
            $count = $req->rowCount();
            $this->close_db();
        } catch (\Throwable $th) {
            die($th);
        }
        if ($count == 1) {
            return $users['id'];
        } else {
            return false;
        }
    }

    
    


    public function update($data, $id)
    {
        try {
            $this->connect_db();
            $sql = "UPDATE `workers` SET `first_name` = :first_name, `second_name` = :second_name, `salary` = :salary, `contact_information` = :contact_information, `date_of_birth` = :date_of_birth, `id_position` = :id_position WHERE `id` = :id ";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'id' => $id,
                'first_name' => $data['first_name'],
                'second_name' => $data['second_name'],
                'salary' => $data['salary'],
                'contact_information' => $data['contact_information'],
                'date_of_birth' => $data['date_of_birth'],
                'id_position' => $data['id_position'],
            ]);
            $rezult = $req->rowCount();
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
            $sql = "DELETE FROM `workers` WHERE `id` = :id";
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

    public function get_id($login, $password)
    {
        try {
            $this->connect_db();
            $sql = "SELECT `id` FROM `workers` WHERE `login` = :login AND `password` = :password ";
            $req = $this->pdo->prepare($sql);
            $req->execute([
                'login' => $login,
                'password' => $password
            ]);
            $users = $req->fetch();
            $this->close_db();
        } catch (\Throwable $th) {
            die($th);
        }
        return $users['id'];
    }

    public function update_last_time($id){
        try {
            $this->connect_db();
            $sql = "UPDATE `workers` SET `last_date_on_reviews` = NOW() WHERE `id` = :id ";
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

    public function update_last_time_tasks($id){
        try {
            $this->connect_db();
            $sql = "UPDATE `workers` SET `last_date_on_tasks` = NOW() WHERE `id` = :id ";
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
