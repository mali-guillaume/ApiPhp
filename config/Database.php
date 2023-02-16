<?php
class Database
{
    // parametre de la DB
    private $host = 'mammouth-nas001.manakeen.local';
    private $db_name = 'manabees_test';
    private $username = "manabees_test";
    private $password = "&Manabees1";
    public $conn;





    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}
