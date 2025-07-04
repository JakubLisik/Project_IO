<?php
class Database
{
    private static ?self $instance = null;
    private mysqli $conn;

    private function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'parking_app');
        if ($this->conn->connect_error) {
            throw new RuntimeException($this->conn->connect_error);
        }
        $this->conn->set_charset('utf8mb4');
    }

    public static function getInstance(): self
    {
        return self::$instance ??= new self();
    }

    public function getConnection(): mysqli
    {
        return $this->conn;
    }

    private function __clone() {}
    public function __wakeup() { throw new \Exception('Cannot unserialize singleton'); }
}
