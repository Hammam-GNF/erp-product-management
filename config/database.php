<?php

class Database
{
    private string $host = 'localhost';
    private string $db_name = 'erp_product_management';
    private string $username = 'root';
    private string $password = 'gonjil777';
    private ?PDO $conn = null;

    public function connect(): PDO
    {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $exception) {
            die(json_encode([
                'status' => 'error',
                'message' => 'Database connection failed'
            ]));
        }

        return $this->conn;
    }
}
