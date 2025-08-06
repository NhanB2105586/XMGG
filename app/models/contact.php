<?php

namespace App\Models;

use PDO;

class Contact extends Model {
    public function __construct(PDO $pdo) {
        parent::__construct($pdo);
    }

    // Thêm liên hệ mới
    public function addContact($fullname, $email, $phone, $message) {
        $sql = "INSERT INTO contacts (fullname, email, phone, message, created_at) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$fullname, $email, $phone, $message]);
    }

    // Lấy tất cả liên hệ
    public function getAllContacts() {
        $sql = "SELECT * FROM contacts ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Xóa liên hệ theo ID
    public function deleteContact($id) {
        $sql = "DELETE FROM contacts WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Đánh dấu đã liên hệ
    public function markAsContacted($id) {
        $sql = "UPDATE contacts SET contacted = 1 WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Lấy số lượng liên hệ chưa xử lý
    public function getUncontactedCount() {
        $sql = "SELECT COUNT(*) as count FROM contacts WHERE contacted = 0 OR contacted IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }
}
?> 