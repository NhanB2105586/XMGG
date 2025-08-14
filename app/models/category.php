<?php

namespace App\Models;

class Category extends Model
{
    public function __construct($pdo)
    {
        parent::__construct($pdo);
    }

    // Lấy tất cả danh mục
    public function getAllCategories()
    {
        return $this->getAll('categories');
    }

    // Lấy danh mục theo ID
    public function getCategoryById($id)
    {
        return $this->getByID('categories', 'category_id', $id);
    }

    // Tạo danh mục mới
    public function createCategory($data)
    {
        // Có thể thêm logic kiểm tra dữ liệu ở đây
        return $this->set('categories', $data);
    }

    // Cập nhật danh mục
    public function updateCategory($id, $data)
    {
        return $this->update('categories', 'category_id', $id, $data);
    }

    // Xóa danh mục
    public function deleteCategory($id)
    {
        return $this->delete('categories', 'category_id', $id);
    }
    
    public function getCategoriesSearch($limit, $offset, $searchTerm = '')
    {
        return $this->getItemsCategories('categories', $limit, $offset, $searchTerm);
    }

    public function getTotalCategoriesSearch($searchTerm = '')
    {
        return $this->getTotalItemsCategories('categories', $searchTerm);
    }

    // Kiểm tra xem danh mục đã tồn tại chưa
    public function categoryExists($categoryName, $excludeId = null)
    {
        $sql = "SELECT COUNT(*) FROM categories WHERE category_name = :category_name";
        $params = [':category_name' => $categoryName];
        
        if ($excludeId) {
            $sql .= " AND category_id != :exclude_id";
            $params[':exclude_id'] = $excludeId;
        }
        
        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        
        return $stmt->fetchColumn() > 0;
    }
}
