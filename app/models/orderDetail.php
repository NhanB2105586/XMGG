<?php

namespace App\Models;

use PDO;

class OrderDetail extends Model
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }
    // Phương thức để lấy chi tiết đơn hàng
    public function getByOrderId(int $orderId)
    {
        return $this->getByID('order_details', 'order_id', $orderId);
    }
}