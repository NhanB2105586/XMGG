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

    // Lấy tất cả sản phẩm
    public function getAllProducts(): array
    {
        return $this->getAll($this->table);
    }

    // Lấy sản phẩm theo ID
    public function getProductById($id)
    {
        return $this->getByID('products', 'product_id', $id);
    }

    public function getProductImages($productId)
    {
        return $this->getByProps('product_images', ['product_id' => $productId]);
    }

    // Lấy danh sách chi tiết từ bảng `product_details` cho một sản phẩm cụ thể
    public function getProductDetails($productId)
    {
        return $this->getByProps('product_details', ['product_id' => $productId]);
    }
    // Thêm sản phẩm mới
    public function addProduct(array $productData): bool
    {
        return $this->set($this->table, $productData);
    }

    // Cập nhật thông tin sản phẩm
    public function updateProduct(int $id, array $newData): bool
    {
        return $this->update($this->table, 'id', $id, $newData);
    }

    // Xóa sản phẩm theo ID
    public function deleteProduct(int $id): bool
    {
        return $this->delete($this->table, 'id', $id);
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
