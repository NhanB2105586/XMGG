<?php

namespace App\Models;

class Categorie extends Model
{
    public function __construct($PDO)
    {
        parent::__construct($PDO);
    }

    public function getAllCategories()
    {
        return $this->getAll('categories');
    }

    public function getCategoryById($id)
    {
        return $this->getByID('categories', 'category_id', $id);
    }

    public function createCategory($data)
    {
        return $this->set('categories', $data);
    }

    public function updateCategory($id, $data)
    {
        return $this->update('categories', 'category_id', $id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->delete('categories', 'category_id', $id);
    }
}