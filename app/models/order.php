<?php

namespace App\Models;

use PDO;

class Order extends Model
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Lấy danh sách đơn hàng
    public function getAllOrders(int $limit = 10, int $offset = 0, string $searchTerm = ''): array
    {
        return $this->getItemsOrder('orders', $limit, $offset, $searchTerm);
    }

    // Lấy tổng số đơn hàng
    public function getTotalOrders(string $searchTerm = ''): int
    {
        return $this->getTotalItemsOrder('orders', $searchTerm);
    }

    // Lấy đơn hàng theo ID
    public function getOrderById(int $orderId): array
    {
        return $this->getByID('orders', 'order_id', $orderId);
    }

    // Cập nhật trạng thái đơn hàng
    public function updateOrderStatus(int $orderId, string $status): bool
    {
        return $this->update('orders', 'order_id', $orderId, ['status' => $status]);
    }

    // Xóa đơn hàng
    public function deleteOrder(int $orderId): bool
    {
        return $this->delete('orders', 'order_id', $orderId);
    }

    // Tính tổng số tiền của một đơn hàng
    public function calculateOrderTotal(int $orderId): float
    {
        $stmt = $this->getPDO()->prepare("SELECT SUM(price * quantity) AS total FROM order_items WHERE order_id = :order_id");
        $stmt->bindValue(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (float) $result['total'] : 0;
    }

    // Kiểm tra nếu đơn hàng tồn tại
    public function orderExists(int $orderId): bool
    {
        return $this->getByID('orders', 'order_id', $orderId) !== false;
    }

    // Lấy tất cả các sản phẩm trong một đơn hàng
    public function getOrderItems(int $orderId): array
    {
        $stmt = $this->getPDO()->prepare("SELECT * FROM order_items WHERE order_id = :order_id");
        $stmt->bindValue(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($orderId, $status)
    {
        // Kiểm tra trạng thái hợp lệ
        $validStatuses = ['pending', 'completed', 'shipped', 'cancelled'];
        if (!in_array($status, $validStatuses)) {
            return false; // Nếu trạng thái không hợp lệ, không cập nhật
        }

        // Cập nhật trạng thái trong cơ sở dữ liệu
        $sql = "UPDATE orders SET status = :status WHERE order_id = :order_id";
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':order_id', $orderId, PDO::PARAM_INT);

        return $stmt->execute();
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

