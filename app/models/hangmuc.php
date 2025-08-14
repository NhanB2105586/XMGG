<?php

namespace App\Models;

use PDO;

class Hangmuc extends Model
{
    public function __construct($pdo)
    {
        parent::__construct($pdo);
    }

    public function getAllHangmucPages()
    {
        $sql = "SELECT * FROM hangmuc_pages ORDER BY id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getHangmucPageBySlug($slug)
    {
        $sql = "SELECT * FROM hangmuc_pages WHERE slug = :slug";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getHangmucPageById($id)
    {
        $sql = "SELECT * FROM hangmuc_pages WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateHangmucPage($id, $title, $description, $content, $imagePath = null)
    {
        $sql = "UPDATE hangmuc_pages SET title = :title, description = :description, content = :content";
        $params = [
            ':id' => $id,
            ':title' => $title,
            ':description' => $description,
            ':content' => $content
        ];

        if ($imagePath) {
            $sql .= ", image_path = :image_path";
            $params[':image_path'] = $imagePath;
        }

        $sql .= ", updated_at = NOW() WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function createHangmucPage($slug, $title, $description, $content, $imagePath = null)
    {
        $sql = "INSERT INTO hangmuc_pages (slug, title, description, content, image_path, created_at, updated_at) 
                VALUES (:slug, :title, :description, :content, :image_path, NOW(), NOW())";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':slug' => $slug,
            ':title' => $title,
            ':description' => $description,
            ':content' => $content,
            ':image_path' => $imagePath
        ]);
    }

    public function deleteHangmucPage($id)
    {
        $sql = "DELETE FROM hangmuc_pages WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
