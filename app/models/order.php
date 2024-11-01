<?php

namespace App\Models;

class Order extends Model
{
    public function __construct($PDO)
    {
        parent::__construct($PDO);
    }

    public function getAllOrders()
    {
        return $this->getAll('orders');
    }

    public function getOrderById($id)
    {
        return $this->getByID('orders', 'order_id', $id);
    }

    public function createOrder($data)
    {
        return $this->set('orders', $data);
    }

    public function updateOrder($id, $data)
    {
        return $this->update('orders', 'order_id', $id, $data);
    }

    public function deleteOrder($id)
    {
        return $this->delete('orders', 'order_id', $id);
    }
}