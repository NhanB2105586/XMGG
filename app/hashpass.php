<?php
// Script này chỉ chạy một lần để mã hóa tất cả các mật khẩu hiện tại
include '../bootstrap.php'; // Đường dẫn tới kết nối database của bạn
$stmt = $PDO->query("SELECT user_id, password FROM users");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $hashedPassword = password_hash($row['password'], PASSWORD_DEFAULT);
    $updateStmt = $PDO->prepare("UPDATE users SET password = :password WHERE user_id = :user_id");
    $updateStmt->execute(['password' => $hashedPassword, 'user_id' => $row['user_id']]);
}
echo "Mật khẩu đã được mã hóa thành công.";
