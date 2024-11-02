<?php

namespace App\Models;

class OrderDetail extends Model
{
    public function __construct($PDO)
    {
        parent::__construct($PDO);
    }

    public function getAllOrderDetails()
    {
        return $this->getAll('order_details');
    }

    public function getOrderDetailById($id)
    {
        return $this->getByID('order_details', 'order_detail_id', $id);
    }

    public function createOrderDetail($data)
    {
        return $this->set('order_details', $data);
    }

    public function updateOrderDetail($id, $data)
    {
        return $this->update('order_details', 'order_detail_id', $id, $data);
    }

    public function deleteOrderDetail($id)
    {
        return $this->delete('order_details', 'order_detail_id', $id);
    }
}