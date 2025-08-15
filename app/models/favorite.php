<?php

namespace App\Models;

use PDO;
use PDOException;

class Favorite extends Model
{
    protected $table = 'favorites';

    public function addFavorite($userId, $productId)
    {
        try {
            $sql = "INSERT INTO favorites (user_id, product_id) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$userId, $productId]);
        } catch (PDOException $e) {
            // Nếu sản phẩm đã được yêu thích, trả về true
            if ($e->getCode() == 23000) {
                return true;
            }
            return false;
        }
    }

    public function removeFavorite($userId, $productId)
    {
        $sql = "DELETE FROM favorites WHERE user_id = ? AND product_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$userId, $productId]);
    }

    public function isFavorite($userId, $productId)
    {
        $sql = "SELECT COUNT(*) FROM favorites WHERE user_id = ? AND product_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $productId]);
        return $stmt->fetchColumn() > 0;
    }

    public function getUserFavorites($userId)
    {
        $sql = "SELECT p.*, f.created_at as favorited_at 
                FROM favorites f 
                JOIN products p ON f.product_id = p.product_id 
                WHERE f.user_id = ? 
                ORDER BY f.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFavoriteCount($userId)
    {
        $sql = "SELECT COUNT(*) FROM favorites WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }
<<<<<<< HEAD

    /**
     * Lấy danh sách sản phẩm yêu thích kèm ảnh đại diện (ảnh đầu tiên)
     * @param int $user_id
     * @return array
     */
    public function getFavoritesWithImage($user_id)
    {
        $sql = "SELECT f.*, p.product_name, p.price, 
                       (SELECT image_url FROM product_images WHERE product_id = p.product_id LIMIT 1) AS image_url
                FROM favorites f
                JOIN products p ON f.product_id = p.product_id
                WHERE f.user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
=======
} 
>>>>>>> 7c425505595b6e785662ce5f53f9fbc09bd1405b
