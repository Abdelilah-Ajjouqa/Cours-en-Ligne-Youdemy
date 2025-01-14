<?php

class Database {
    private $host = 'localhost';
    private $dbname = 'youdemy';
    private $user = 'root';
    private $password = '123';
    private $conn;

    public function __construct(){
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->password);
            echo 'Connected successfully';
        } catch (PDOException $e){
            echo 'Connection failed: ' . $e->getMessage();
            exit();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

$database = new Database();
$pdo = $database->getConnection();