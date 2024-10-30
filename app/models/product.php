<?php

namespace App\Models;

use PDO;

class Product extends Model
{
    private string $tableName = 'products';
    private PDO $db;

    public int $id = -1;
    public string $name;
    public string $description;
    public float $price;
    public string $stock_status;
    public string $color;
    public int $category_id;
    public string $created_at;

    public function __construct(PDO $db)
    {
        parent::__construct($db);
    }

    public function all(): array
    {
        return parent::getAll($this->tableName);
    }

    public function find(int $id): ?Product
    {
        $statement = $this->db->prepare('SELECT * FROM products WHERE product_id = :id');
        $statement->execute(['id' => $id]);

        if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            return $this->fillFromDbRow($row);
        }

        return null;
    }

    private function fillFromDbRow(array $row): Product
    {
        $this->id = $row['product_id'];
        $this->name = $row['product_name'];
        $this->description = $row['description'];
        $this->price = $row['price'];
        $this->stock_status = $row['stock_status'];
        $this->color = $row['color'];
        $this->category_id = $row['category_id'];
        $this->created_at = $row['created_at'];
        return $this;
    }
}
