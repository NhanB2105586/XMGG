<?php

namespace App\Models;

use PDO;

class OrderDetail extends Model
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }

    // Lấy tất cả các chi tiết của một đơn hàng theo order_id

    // Phương thức để lấy chi tiết đơn hàng
    public function getByOrderId(int $orderId): array
    {
        return $this->getByID('order_details', 'order_id', $orderId);
    }
}
