<?php

namespace App\Models;

class Product extends Model
{
    public function createProduct(array $data)
    {
        return $this->set('products', $data);
    }

    public function updateProduct(int $id, array $data)
    {
        return $this->update('products', 'product_id', $id, $data);
    }

    public function getProductById($id)
    {
        return $this->getByID('products', 'product_id', $id);
    }

    public function getAllProducts()
    {
        return $this->getAll('products');
    }

    public function deleteProduct(int $id)
    {
        return $this->delete('products', 'product_id', $id);
    }

    public function getProductSearch($limit, $offset, $searchTerm = '')
    {
        return $this->getItemsProduct('Products', $limit, $offset, $searchTerm);
    }

    public function getTotalProductSearch($searchTerm = '')
    {
        return $this->getTotalItemsProduct('Products', $searchTerm);
    }

    
}