<?php

namespace App\Models;

use PDO;

class Order
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Tạo đơn hàng mới
    public function createOrder($userId, $totalAmount, $status = 'Đang xử lý')
    {
        $stmt = $this->db->prepare("INSERT INTO orders (user_id, order_date, total_amount, status) VALUES (:user_id, NOW(), :total_amount, :status)");
        $stmt->execute([
            'user_id' => $userId,
            'total_amount' => $totalAmount,
            'status' => $status
        ]);
        return $this->db->lastInsertId(); // Trả về ID của đơn hàng mới
    }

    // Thêm chi tiết sản phẩm vào đơn hàng
    public function addOrderDetail($orderId, $productId, $quantity, $price)
    {
        $stmt = $this->db->prepare("INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)");
        $stmt->execute([
            'order_id' => $orderId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'price' => $price
        ]);
    }



    public function getOrderDetails($orderId)
    {
        $stmt = $this->db->prepare("
        SELECT od.*, p.product_name, 
            (SELECT pi.image_url FROM product_images pi WHERE pi.product_id = p.product_id LIMIT 1) AS image_url
        FROM order_details od
        JOIN products p ON od.product_id = p.product_id
        WHERE od.order_id = :order_id
    ");
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    // Lấy trạng thái đơn hàng
    public function getOrderStatus($orderId)
    {
        $stmt = $this->db->prepare("SELECT status FROM orders WHERE order_id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->fetchColumn(); // Trả về trạng thái đơn hàng
    }

    public function getOrdersByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
