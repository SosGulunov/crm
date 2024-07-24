<?php

class DB
{
    // ДАННЫЕ ДЛЯ СОЕДИНЕНИЯ С БД
    private $host = '127.0.0.1';
    private $db   = 'crm_bd';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8';
    private $dsn;
    private $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    private $pdo;

    public function __construct()
    {
        $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
    }

    public function getConnect()
    {
        return $this->pdo;
    }

    public function closeConnect()
    {
        $this->pdo = NULL;
    }
}
