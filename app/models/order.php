<?php

namespace App\Models;

use PDO;

class Order extends Model
{
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

    // Lấy đơn hàng của người dùng theo user_id
    public function getOrdersByUserId(int $userId): array
    {
        return $this->getByProps('orders', ['user_id' => $userId]);
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

}