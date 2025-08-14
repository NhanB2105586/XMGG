<?php

namespace App\Models;

use PDO;
class Product extends Model
{
    protected string $table = 'products'; // Đặt tên bảng cho sản phẩm

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
    }
    
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
        // Xóa hình ảnh sản phẩm trước
        $sql = "DELETE FROM product_images WHERE product_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Xóa sản phẩm
        $sql = "DELETE FROM products WHERE product_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getProductSearch($limit, $offset, $searchTerm = '', $categoryId = null)
    {
        $whereConditions = [];
        $params = [];
        
        // Thêm điều kiện tìm kiếm
        if (!empty($searchTerm)) {
            $whereConditions[] = "(p.product_name LIKE :searchTerm 
                                  OR p.description LIKE :searchTerm 
                                  OR c.category_name LIKE :searchTerm
                                  OR p.product_id LIKE :searchTerm)";
            $params[':searchTerm'] = '%' . $searchTerm . '%';
        }
        
        // Thêm điều kiện lọc theo danh mục
        if (!empty($categoryId)) {
            $whereConditions[] = "p.category_id = :categoryId";
            $params[':categoryId'] = $categoryId;
        }
        
        $whereClause = '';
        if (!empty($whereConditions)) {
            $whereClause = 'WHERE ' . implode(' AND ', $whereConditions);
        }
        
        $sql = "SELECT p.*, c.category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.category_id 
                {$whereClause}
                ORDER BY p.product_id ASC 
                LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($sql);
        
        // Bind tất cả parameters
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_STR);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalProductSearch($searchTerm = '', $categoryId = null)
    {
        $whereConditions = [];
        $params = [];
        
        // Thêm điều kiện tìm kiếm
        if (!empty($searchTerm)) {
            $whereConditions[] = "(p.product_name LIKE :searchTerm 
                                  OR p.description LIKE :searchTerm 
                                  OR c.category_name LIKE :searchTerm
                                  OR p.product_id LIKE :searchTerm)";
            $params[':searchTerm'] = '%' . $searchTerm . '%';
        }
        
        // Thêm điều kiện lọc theo danh mục
        if (!empty($categoryId)) {
            $whereConditions[] = "p.category_id = :categoryId";
            $params[':categoryId'] = $categoryId;
        }
        
        if (!empty($whereConditions)) {
            $sql = "SELECT COUNT(DISTINCT p.product_id) as total 
                    FROM products p 
                    LEFT JOIN categories c ON p.category_id = c.category_id 
                    WHERE " . implode(' AND ', $whereConditions);
            $stmt = $this->db->prepare($sql);
            
            // Bind tất cả parameters
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value, PDO::PARAM_STR);
            }
        } else {
            $sql = "SELECT COUNT(*) as total FROM products";
            $stmt = $this->db->prepare($sql);
        }
        
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }


    // Tìm sản phẩm theo thuộc tính
    public function findProductByAttributes(array $attributes): array
    {
        return $this->getByProps($this->table, $attributes);
    }

    public function getNewProducts(int $limit = 8): array
    {
        $query = "SELECT * FROM products ORDER BY created_at DESC LIMIT :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getRelatedProducts($currentProductId, $limit = 4)
    {
        $query = "SELECT * FROM products WHERE product_id != :currentProductId ORDER BY RAND() LIMIT :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':currentProductId', $currentProductId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getProductsByCategory($categoryId, $excludeProductId = null, $limit = null)
    {
        $query = "
        SELECT p.*, pi.image_url 
        FROM products AS p 
        LEFT JOIN product_images AS pi ON p.product_id = pi.product_id 
        WHERE p.category_id = :category_id
    ";

        // Nếu có excludeProductId, thêm điều kiện loại trừ
        if ($excludeProductId) {
            $query .= " AND p.product_id != :exclude_product_id";
        }

        $query .= " ORDER BY p.product_id ASC";

        // Nếu có limit, thêm LIMIT
        if ($limit) {
            $query .= " LIMIT :limit";
        }

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        
        if ($excludeProductId) {
            $stmt->bindValue(':exclude_product_id', $excludeProductId, PDO::PARAM_INT);
        }
        
        if ($limit) {
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        }
        
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Tạo một mảng để nhóm hình ảnh theo sản phẩm
        $products = [];
        foreach ($results as $row) {
            // Sử dụng product_id làm khóa
            $productId = $row['product_id'];

            // Nếu sản phẩm chưa có trong mảng, thêm mới
            if (!isset($products[$productId])) {
                $products[$productId] = $row;
                $products[$productId]['images'] = []; // Khởi tạo mảng hình ảnh
            }

            // Thêm hình ảnh vào sản phẩm
            if (!empty($row['image_url'])) {
                $products[$productId]['images'][] = ['image_url' => $row['image_url']];
            }
        }

        return array_values($products); // Chuyển đổi từ mảng liên kết sang mảng số
    }


    public function searchProducts($query)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE product_name LIKE :query");
        $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm phương thức getBestSellers
    public function getBestSellers(int $limit = 8): array
    {
        $query = "
        SELECT p.*, SUM(od.quantity) AS total_sales
        FROM products p
        LEFT JOIN order_details od ON p.product_id = od.product_id
        GROUP BY p.product_id
        ORDER BY total_sales DESC
        LIMIT :limit
    ";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProducts($page = 1, $itemsPerPage = 12, $searchTerm = '', $filter = 'popular')
    {
        $offset = ($page - 1) * $itemsPerPage;
        $query = "SELECT * FROM products";
        
        if (!empty($searchTerm)) {
            $query .= " WHERE product_name LIKE :searchTerm";
        }

        // Thêm điều kiện sắp xếp dựa trên bộ lọc
        switch ($filter) {
            case 'low-to-high':
                $query .= " ORDER BY price ASC";
                break;
            case 'high-to-low':
                $query .= " ORDER BY price DESC";
                break;
            case 'popular':
            default:
                $query .= " ORDER BY created_at DESC"; // Hoặc một tiêu chí phổ biến khác
                break;
        }

        $query .= " LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($query);
        
        if (!empty($searchTerm)) {
            $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        }
        
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalProducts($searchTerm = '')
    {
        $query = "SELECT COUNT(*) as total FROM products";
        $params = [];

        if (!empty($searchTerm)) {
            $query .= " WHERE product_name LIKE :searchTerm";
            $params[':searchTerm'] = "%{$searchTerm}%";
        }

        $stmt = $this->db->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Method để cập nhật số lượng sản phẩm
    public function updateStock($productId, $newStock)
    {
        $query = "UPDATE products SET in_stock = :new_stock WHERE product_id = :product_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':new_stock', $newStock, PDO::PARAM_INT);
        $stmt->bindValue(':product_id', $productId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Method để kiểm tra sản phẩm có tồn tại trong bảng khác không
    public function existsInTable($table, $column, $value)
    {
        $query = "SELECT COUNT(*) as count FROM {$table} WHERE {$column} = :value";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':value', $value);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
}
