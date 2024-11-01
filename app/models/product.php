<?php

namespace App\Models;

class Product extends Model
{
    public function __construct($PDO)
    {
        parent::__construct($PDO);
    }

    public function getAllProducts()
    {
        return $this->getAll('products');
    }

    public function getProductById($id)
    {
        return $this->getByID('products', 'product_id', $id);
    }

    public function createProduct($data)
    {
        return $this->set('products', $data);
    }

    public function updateProduct($id, $data)
    {
        return $this->update('products', 'product_id', $id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->delete('products', 'product_id', $id);
    }
}