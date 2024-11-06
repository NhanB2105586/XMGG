<?php

namespace App\Models;

use PDO;

class Admin
{
    private PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    // Hàm để kiểm tra thông tin đăng nhập
    public function login(string $email, string $password): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra nếu có admin và mật khẩu đúng
        if ($admin && password_verify($password, $admin['password'])) {
            return $admin; // Trả về thông tin admin
        }

        return null; // Không thành công
    }
}