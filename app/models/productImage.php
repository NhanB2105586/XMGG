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
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE product_id = :product_id ORDER BY image_id ASC");
        $stmt->bindValue(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy ảnh chính của sản phẩm (ảnh đầu tiên)
    public function getMainImageForDisplay($productId)
    {
        // Lấy ảnh đầu tiên làm ảnh chính
        $stmt = $this->db->prepare("SELECT image_url FROM {$this->table} WHERE product_id = :product_id ORDER BY image_id ASC LIMIT 1");
        $stmt->bindValue(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['image_url'] : 'default.jpg';
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

    // Lấy hình ảnh theo image_id
    public function getImageById($image_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE image_id = :image_id");
        $stmt->bindValue(':image_id', $image_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    // Lấy hình ảnh theo image_url để kiểm tra duplicate
    public function getImageByUrl($image_url)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE image_url = :image_url");
        $stmt->bindValue(':image_url', $image_url, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    // Lấy ảnh chính của sản phẩm (ảnh đầu tiên)
    public function getMainImageByProductId($productId)
    {
        return $this->getMainImageForDisplay($productId);
    }

    // MẸO: Đặt ảnh chính bằng cách di chuyển ảnh đó lên đầu
    public function setMainImage($productId, $imageId)
    {
        // Bước 1: Lấy thông tin ảnh được chọn
        $selectedImage = $this->getImageById($imageId);
        if (!$selectedImage || $selectedImage['product_id'] != $productId) {
            return false;
        }

        // Bước 2: Lấy tất cả ảnh của sản phẩm
        $allImages = $this->getImagesByProductId($productId);
        
        // Bước 3: Tìm ảnh được chọn và đưa lên đầu
        $reorderedImages = [];
        $reorderedImages[] = $selectedImage; // Ảnh được chọn lên đầu
        
        foreach ($allImages as $image) {
            if ($image['image_id'] != $imageId) {
                $reorderedImages[] = $image;
            }
        }
        
        // Bước 4: Xóa tất cả ảnh cũ và thêm lại theo thứ tự mới
        foreach ($allImages as $image) {
            $this->deleteImage($image['image_id']);
        }
        
        // Bước 5: Thêm lại theo thứ tự mới
        foreach ($reorderedImages as $image) {
            $this->addImage([
                'product_id' => $productId,
                'image_url' => $image['image_url']
            ]);
        }
        
        return true;
    }

    // Đảm bảo sản phẩm luôn có ảnh chính
    public function ensureMainImage($productId)
    {
        // Kiểm tra xem sản phẩm có ảnh nào không
        $images = $this->getImagesByProductId($productId);
        
        if (empty($images)) {
            // Nếu không có ảnh nào, thêm ảnh mặc định
            $this->addImage([
                'product_id' => $productId,
                'image_url' => 'default.jpg'
            ]);
        }
    }

    // Kiểm tra xem ảnh có phải là ảnh chính không (ảnh đầu tiên)
    public function isMainImage($productId, $imageId)
    {
        $mainImage = $this->getMainImageForDisplay($productId);
        return $mainImage && $mainImage['image_id'] == $imageId;
    }
}


    
