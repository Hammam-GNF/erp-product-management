<?php

require_once __DIR__ . '/../config/database.php';

class Product
{
    private PDO $conn;
    private string $table = 'products';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAll(): array
    {
        $query = "
            SELECT 
                p.id,
                p.name_product,
                p.price,
                p.stock,
                c.name_category
            FROM {$this->table} p
            JOIN categories c ON p.category_id = c.id
            ORDER BY p.id DESC
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function create(array $data): bool
    {
        if (
            !isset($data['category_id'], $data['name_product'], $data['price'], $data['stock'])
        ) {
            throw new Exception("Incomplete data");
        }

        if (!is_numeric($data['stock']) || $data['stock'] < 0) {
            throw new Exception("Stock must be a non-negative number");
        }

        if (!is_numeric($data['price']) || $data['price'] < 0) {
            throw new Exception("Price must be a non-negative number");
        }

        $query = "
            INSERT INTO {$this->table}
            (category_id, name_product, price, stock)
            VALUES
            (:category_id, :name_product, :price, :stock)
        ";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':category_id' => $data['category_id'],
            ':name_product' => htmlspecialchars(strip_tags($data['name_product'])),
            ':price' => $data['price'],
            ':stock' => $data['stock']
        ]);
    }
}
