<?php

namespace App\Models;

use PDO;

class OrderDetail extends Model
{
    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }
    public function getOrderById(int $orderId)
    {
        return $this->getByOrderId($orderId);
    }
    public function getUserByOrderDetail($orderId)
    {
        return $this->getUserByOrder($orderId);
    }
    
}