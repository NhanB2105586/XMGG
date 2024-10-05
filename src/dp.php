<?php
// db.php - file để kết nối tới cơ sở dữ liệu

$servername = "localhost";  // Tên máy chủ
$username = "root";     // Tên người dùng
$password = "nhan12345678";     // Mật khẩu của cơ sở dữ liệu
$dbname = "project";  // Tên cơ sở dữ liệu

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>