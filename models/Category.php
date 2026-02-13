<?php

require_once __DIR__ . '/../config/database.php';

class Category
{
    private PDO $conn;
    private string $table = 'categories';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAll(): array
    {
        $query = "SELECT id, name_category FROM {$this->table} ORDER BY name_category ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
