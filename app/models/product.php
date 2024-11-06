<?php

namespace App\Models;

use PDO;
class Product extends Model
{
    protected string $table = 'products'; // Đặt tên bảng cho sản phẩm

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }
    
    public function createProduct(array $data)
    {
        return $this->set('products', $data);
    }

    public function updateProduct(int $id, array $data)
    {
        return $this->update('products', 'product_id', $id, $data);
    }

    public function getProductById($id)
    {
        return $this->getByID('products', 'product_id', $id);
    }

    public function getAllProducts()
    {
        return $this->getAll('products');
    }

    public function deleteProduct(int $id)
    {
        return $this->delete('products', 'product_id', $id);
    }

    public function getProductSearch($limit, $offset, $searchTerm = '')
    {
        return $this->getItemsProduct('Products', $limit, $offset, $searchTerm);
    }

    public function getTotalProductSearch($searchTerm = '')
    {
        return $this->getTotalItemsProduct('Products', $searchTerm);
    }


    // Tìm sản phẩm theo thuộc tính
    public function findProductByAttributes(array $attributes): array
    {
        return $this->getByProps($this->table, $attributes);
    }

    public function getNewProducts(int $limit = 4): array
    {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getRelatedProducts($currentProductId, $limit = 4)
    {
        $query = "SELECT * FROM {$this->table} WHERE product_id != :currentProductId ORDER BY RAND() LIMIT :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':currentProductId', $currentProductId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getProductsByCategory($categoryId)
    {
        $query = "SELECT * FROM {$this->table} WHERE category_id = :category_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

