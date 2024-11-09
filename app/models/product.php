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


    // Tìm sản phẩm theo thuộc tính
    public function findProductByAttributes(array $attributes): array
    {
        return $this->getByProps($this->table, $attributes);
    }

    public function getNewProducts(int $limit = 8): array
    {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getRelatedProducts($currentProductId, $limit = 4)
    {
        $query = "SELECT * FROM {$this->table} WHERE product_id != :currentProductId ORDER BY RAND() LIMIT :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':currentProductId', $currentProductId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getProductsByCategory($categoryId)
    {
        $query = "
        SELECT p.*, pi.image_url 
        FROM {$this->table} AS p 
        LEFT JOIN product_images AS pi ON p.product_id = pi.product_id 
        WHERE p.category_id = :category_id
    ";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
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
        $stmt->execute(['query' => '%' . $query . '%']);
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
        $query = "SELECT * FROM products WHERE product_name LIKE :searchTerm";

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

        $query .= " LIMIT :offset, :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalProducts($searchTerm = '')
    {
        if (!empty($searchTerm)) {
            $sql = "SELECT COUNT(*) as total FROM products WHERE product_name LIKE :searchTerm";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        } else {
            $sql = "SELECT COUNT(*) as total FROM products";
            $stmt = $this->db->query($sql);
        }

        return $stmt->fetchColumn();
    }



}