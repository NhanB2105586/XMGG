<?php

namespace App\Models;
use PDO;
class ProductImage extends Model
{
    protected string $table = 'product_images'; // Đặt tên bảng cho hình ảnh sản phẩm

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    // Lấy tất cả hình ảnh của một sản phẩm theo `product_id`
    public function getImagesByProductId($productId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE product_id = :product_id");
        $stmt->bindValue(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm hình ảnh mới cho sản phẩm
    public function addImage(array $data): bool
    {
        return $this->set($this->table, $data);
    }

    // Cập nhật thông tin hình ảnh
    public function updateImage(int $imageId, array $data): bool
    {
        return $this->update($this->table, 'image_id', $imageId, $data);
    }

    // Xóa hình ảnh của sản phẩm theo `image_id`
    public function deleteImage(int $imageId): bool
    {
        return $this->delete($this->table, 'image_id', $imageId);
    }
}
