<?php

namespace App\Models;

use PDO;

class HangmucProducts
{
    protected $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getProductsByHangmucSlug($slug)
    {
        $sql = "SELECT * FROM hangmuc_products WHERE hangmuc_slug = :slug AND is_active = 1 ORDER BY sort_order ASC, id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        $sql = "SELECT * FROM hangmuc_products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createProduct($data)
    {
        $sql = "INSERT INTO hangmuc_products (hangmuc_slug, title, description, image_path, sort_order, is_active, created_at, updated_at) 
                VALUES (:hangmuc_slug, :title, :description, :image_path, :sort_order, :is_active, NOW(), NOW())";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':hangmuc_slug' => $data['hangmuc_slug'],
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':image_path' => $data['image_path'],
            ':sort_order' => $data['sort_order'] ?? 0,
            ':is_active' => $data['is_active'] ?? 1
        ]);
    }

    public function updateProduct($id, $data)
    {
        $sql = "UPDATE hangmuc_products SET 
                title = :title, 
                description = :description, 
                image_path = :image_path, 
                sort_order = :sort_order, 
                is_active = :is_active, 
                updated_at = NOW() 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':image_path' => $data['image_path'],
            ':sort_order' => $data['sort_order'] ?? 0,
            ':is_active' => $data['is_active'] ?? 1
        ]);
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM hangmuc_products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getAllProducts()
    {
        $sql = "SELECT * FROM hangmuc_products ORDER BY hangmuc_slug ASC, sort_order ASC, id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsByHangmucSlugForAdmin($slug)
    {
        $sql = "SELECT * FROM hangmuc_products WHERE hangmuc_slug = :slug ORDER BY sort_order ASC, id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateSortOrder($id, $sortOrder)
    {
        $sql = "UPDATE hangmuc_products SET sort_order = :sort_order, updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':sort_order' => $sortOrder
        ]);
    }

    public function swapProducts($productId1, $productId2)
    {
        try {
            $this->db->beginTransaction();
            
            // Get current sort orders
            $sql1 = "SELECT sort_order FROM hangmuc_products WHERE id = :id1";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->bindValue(':id1', $productId1, PDO::PARAM_INT);
            $stmt1->execute();
            $sortOrder1 = $stmt1->fetchColumn();
            
            $sql2 = "SELECT sort_order FROM hangmuc_products WHERE id = :id2";
            $stmt2 = $this->db->prepare($sql2);
            $stmt2->bindValue(':id2', $productId2, PDO::PARAM_INT);
            $stmt2->execute();
            $sortOrder2 = $stmt2->fetchColumn();
            
            if ($sortOrder1 === false || $sortOrder2 === false) {
                $this->db->rollBack();
                return false;
            }
            
            // Swap the sort orders
            $updateSql = "UPDATE hangmuc_products SET sort_order = :new_sort_order, updated_at = NOW() WHERE id = :id";
            
            $stmt = $this->db->prepare($updateSql);
            $stmt->execute([':id' => $productId1, ':new_sort_order' => $sortOrder2]);
            $stmt->execute([':id' => $productId2, ':new_sort_order' => $sortOrder1]);
            
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function toggleActive($id)
    {
        $sql = "UPDATE hangmuc_products SET is_active = NOT is_active, updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function checkTableExists()
    {
        $sql = "SHOW TABLES LIKE 'hangmuc_products'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function getNextSortOrder($hangmucSlug)
    {
        $sql = "SELECT MAX(sort_order) as max_order FROM hangmuc_products WHERE hangmuc_slug = :slug";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':slug', $hangmucSlug, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($result['max_order'] ?? 0) + 1;
    }
}
