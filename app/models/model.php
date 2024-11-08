<?php

namespace App\Models;

use PDO;

class Model
{
    protected PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function getPDO(): PDO
    {
        return $this->db;
    }

    # set record into table
    public function set(string $table, array $record): bool
    {
        $keys = array_keys($record);
        $strKey = join(', ', $keys);
        $arrParams = array_map(fn($key) => (":$key"), $keys);
        $strParams = join(', ', $arrParams);

        $query = "insert into $table ($strKey) values ($strParams);";

        $stmt = $this->db->prepare($query);
        foreach ($keys as $key) {
            $stmt->bindValue(":$key", $record[$key]);
        }
        return $stmt->execute();
    }

    # get all records in a table
    public function getAll(string $tableName): array
    {
        $statement = $this->db->query("SELECT * FROM $tableName");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    # get record in a table by ID
    public function getByID($table, $column, $id)
    {
        $statement = $this->db->prepare("SELECT * FROM $table WHERE $column = :id");
        $statement->execute(['id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    # update record of table
    public function update(string $table, string $idName, int $id, array $newValue): bool
    {
        $keys = array_keys($newValue);
        $arrFields = array_map(fn($key) => ("$key = :$key"), $keys);
        $strFields = join(', ', $arrFields);
        $query = "update $table set $strFields where $idName = :$idName;";

        $stmt = $this->db->prepare($query);
        foreach ($keys as $key) {
            $stmt->bindValue(":$key", $newValue[$key]);
        }
        $stmt->bindValue(":$idName", $id);
        return $stmt->execute();
    }

    public function delete($table,$idName, $id)
    {
        $sql = "DELETE FROM cart_items WHERE cart_id IN (SELECT cart_id FROM carts WHERE user_id = :id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Xóa giỏ hàng
        $sql = "DELETE FROM carts WHERE user_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Xóa bản ghi từ bảng chính
        $sql = "DELETE FROM $table WHERE $idName = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getByProps(string $table, array $props): array
    {
        $keys = array_keys($props);
        $params = array_map(fn($key) => ("$key = :$key"), $keys);
        $strParams = join(' and ', $params);
        $query = "select * from $table where $strParams";

        $stmt = $this->db->prepare($query);
        foreach ($keys as $key) {
            $stmt->bindValue(":$key", $props[$key]);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function usernameExists($username)
    {
        $query = "SELECT COUNT(*) FROM users WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Trả về true nếu tồn tại
    }

    public function emailExists($email)
    {
        $query = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Trả về true nếu tồn tại
    }

    protected function getItems($table, $limit, $offset, $searchTerm = '')
    {
        $sql = "SELECT * FROM $table WHERE fullname LIKE :searchTerm LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getTotalItems($table, $searchTerm = '')
    {
        $sql = "SELECT COUNT(*) FROM $table WHERE fullname LIKE :searchTerm";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function existsInTable($table, $columnId, $id)
    {
        $sql = "SELECT COUNT(*) FROM $table WHERE $columnId = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); 
        $stmt->execute();

        return $stmt->fetchColumn() > 0; 
    }


    public function deleteOrdersByUserId($userId)
    {
        $sql = "DELETE FROM orders WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function countUsers()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM users");
        return $stmt->fetchColumn();
    }
    
    public function countOrders()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM orders");
        return $stmt->fetchColumn();
    }

    public function countSuccessfulOrders()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM orders WHERE status = 'completed'");
        return $stmt->fetchColumn();
    }

    public function calculateRevenue()
    {
        $stmt = $this->db->query("SELECT SUM(total_amount) FROM orders WHERE status = 'completed'");
        return $stmt->fetchColumn() ?: 0; // Trả về 0 nếu không có doanh thu
    }
    //Category
    protected function getItemsCategories($table, $limit, $offset, $searchTerm = '')
    {
        $sql = "SELECT * FROM $table WHERE category_name LIKE :searchTerm LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getTotalItemsCategories($table, $searchTerm = '')
    {
        $sql = "SELECT COUNT(*) FROM $table WHERE category_name LIKE :searchTerm";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn();
    }
    public function categoryExists($categoryName)
    {
        $sql = "SELECT COUNT(*) FROM categories WHERE category_name = :category_name";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':category_name', $categoryName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn() > 0; // Nếu có bản ghi, trả về true
    }

    //product
    protected function getItemsProduct($table, $limit, $offset, $searchTerm = '')
    {
        $sql = "SELECT * FROM $table WHERE product_name LIKE :searchTerm LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getTotalItemsProduct($table, $searchTerm = '')
    {
        $sql = "SELECT COUNT(*) FROM $table WHERE product_name LIKE :searchTerm";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn();
    }
    public function productExists($productName)
    {
        $sql = "SELECT COUNT(*) FROM products WHERE product_name = :product_name";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':product_name', $productName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn() > 0; // Nếu có bản ghi, trả về true
    }
    public function getNewProducts(int $limit = 4)
    {
        $query = "SELECT * FROM products ORDER BY created_at DESC LIMIT :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Lấy tất cả hình ảnh của một sản phẩm
    public function getImagesByProductId($productId)
    {
        $stmt = $this->db->prepare("SELECT * FROM product_images WHERE product_id = ?");
        $stmt->execute([$productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getImageById($image_id)
    {
        $stmt = $this->db->prepare('SELECT * FROM product_images WHERE image_id = :image_id');
        $stmt->execute(['image_id' => $image_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //Order
    protected function getItemsOrder($table, $limit, $offset, $searchTerm = ''){
    // Thực hiện JOIN giữa bảng orders và bảng users để lấy tên khách hàng
    $sql = "SELECT o.*, u.fullname AS customer_name 
            FROM $table o 
            JOIN users u ON o.user_id = u.user_id  -- Tham chiếu đúng cột user_id
            WHERE u.fullname LIKE :searchTerm 
            LIMIT :limit OFFSET :offset";

    // Chuẩn bị câu lệnh SQL
    $stmt = $this->db->prepare($sql);
    
    // Gán giá trị cho tham số searchTerm (tìm kiếm theo tên khách hàng)
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    
    // Gán giá trị cho các tham số limit và offset để phân trang
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
    // Thực thi câu lệnh
    $stmt->execute();

    // Trả về kết quả dưới dạng mảng
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    protected function getTotalItemsOrder($table, $searchTerm = '')
    {
        // Thực hiện JOIN giữa bảng orders và bảng users để tìm kiếm theo fullname
        $sql = "SELECT COUNT(*) 
            FROM $table o 
            JOIN users u ON o.user_id = u.user_id  -- Tham chiếu đúng cột user_id
            WHERE u.fullname LIKE :searchTerm";

        // Chuẩn bị câu lệnh SQL
        $stmt = $this->db->prepare($sql);

        // Gán giá trị cho tham số searchTerm (tìm kiếm theo tên khách hàng)
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);

        // Thực thi câu lệnh
        $stmt->execute();

        // Trả về kết quả dưới dạng một số (số lượng đơn hàng)
        return $stmt->fetchColumn();
    }

}