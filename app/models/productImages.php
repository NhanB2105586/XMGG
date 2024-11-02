<?php

namespace App\Models;
use PDO;
class ProductImage extends Model
{
    private PDO $db;
    public function __construct($PDO)
    {
        parent::__construct($PDO);
    }

    // Lấy tất cả hình ảnh của một sản phẩm
    public function getImagesByProductId($productId)
    {
        $stmt = $this->db->prepare("SELECT * FROM product_images WHERE product_id = ?");
        $stmt->execute([$productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm hình ảnh cho sản phẩm
    public function addImage($data)
    {
        return $this->set('product_images', $data);
    }

    // Cập nhật hình ảnh
    public function updateImage($id, $data)
    {
        return $this->update('product_images', 'image_id', $id, $data);
    }

    // Xóa hình ảnh
    public function deleteImage($id)
    {
        return $this->delete('product_images', 'image_id', $id);
    }
}