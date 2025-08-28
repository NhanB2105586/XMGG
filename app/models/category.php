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

    // Lấy danh mục theo loại (ximang hoặc noithat)
    public function getCategoriesByType($type)
    {
        // Kiểm tra cột category_type có tồn tại không
        if (!$this->columnExists('categories', 'category_type')) {
            return [];
        }
        
        $sql = "SELECT * FROM categories WHERE category_type = :type ORDER BY category_name";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':type', $type, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Lấy tất cả danh mục có phân loại
    public function getAllCategoriesWithType()
    {
        // Kiểm tra cột category_type có tồn tại không
        if (!$this->columnExists('categories', 'category_type')) {
            return $this->getAllCategories();
        }
        
        $sql = "SELECT * FROM categories ORDER BY category_type, category_name";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Tạo danh mục mới
    public function createCategory($data)
    {
        // Tạo slug từ tên danh mục nếu cột slug tồn tại
        if ($this->columnExists('categories', 'slug') && !isset($data['slug']) && isset($data['category_name'])) {
            $data['slug'] = $this->createSlug($data['category_name']);
        }
        
        return $this->set('categories', $data);
    }

    // Cập nhật danh mục
    public function updateCategory($id, $data)
    {
        // Tạo slug từ tên danh mục nếu cột slug tồn tại
        if ($this->columnExists('categories', 'slug') && !isset($data['slug']) && isset($data['category_name'])) {
            $data['slug'] = $this->createSlug($data['category_name']);
        }
        
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

    // Kiểm tra slug đã tồn tại chưa
    public function slugExists($slug, $excludeId = null)
    {
        // Kiểm tra cột slug có tồn tại không
        if (!$this->columnExists('categories', 'slug')) {
            return false;
        }
        
        $sql = "SELECT COUNT(*) FROM categories WHERE slug = :slug";
        $params = [':slug' => $slug];
        
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

    // Tạo slug từ tên danh mục
    private function createSlug($name)
    {
        // Chuyển về chữ thường
        $slug = strtolower($name);
        
        // Thay thế các ký tự đặc biệt
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        
        // Thay thế khoảng trắng bằng dấu gạch ngang
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        
        // Loại bỏ dấu gạch ngang ở đầu và cuối
        $slug = trim($slug, '-');
        
        // Nếu slug rỗng, tạo slug mặc định
        if (empty($slug)) {
            $slug = 'category-' . time();
        }
        
        // Kiểm tra slug đã tồn tại chưa
        $originalSlug = $slug;
        $counter = 1;
        while ($this->slugExists($slug)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }

    // Lấy danh mục theo slug
    public function getCategoryBySlug($slug)
    {
        // Kiểm tra cột slug có tồn tại không
        if (!$this->columnExists('categories', 'slug')) {
            return null;
        }
        
        $sql = "SELECT * FROM categories WHERE slug = :slug";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':slug', $slug, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Kiểm tra cột có tồn tại trong bảng không
    private function columnExists($table, $column)
    {
        try {
            $sql = "SHOW COLUMNS FROM {$table} LIKE :column";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':column', $column, \PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (\Exception $e) {
            return false;
        }
    }
}
