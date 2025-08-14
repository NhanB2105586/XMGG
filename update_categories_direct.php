<?php
// Script để cập nhật tên các danh mục theo yêu cầu
// Chạy file này trực tiếp để cập nhật database

require_once __DIR__ . '/app/core/PDOFactory.php';
require_once __DIR__ . '/bootstrap.php';

try {
    $pdo = PDOFactory::getConnection();
    
    // Danh sách cập nhật
    $updates = [
        2 => 'Thanh Plank',
        3 => 'Thanh Lapsiding', 
        4 => 'Thanh Array',
        5 => 'Thanh Deck',
        6 => 'Thanh Mould'
    ];

    echo "<h2>Cập nhật tên danh mục</h2>";
    echo "<p>Bắt đầu cập nhật...</p>";

    $successCount = 0;
    $errorCount = 0;

    foreach ($updates as $categoryId => $newName) {
        try {
            // Kiểm tra xem category có tồn tại không
            $checkStmt = $pdo->prepare("SELECT category_name FROM categories WHERE category_id = ?");
            $checkStmt->execute([$categoryId]);
            $currentCategory = $checkStmt->fetch(PDO::FETCH_ASSOC);
            
            if ($currentCategory) {
                $oldName = $currentCategory['category_name'];
                
                // Cập nhật tên
                $updateStmt = $pdo->prepare("UPDATE categories SET category_name = ? WHERE category_id = ?");
                $result = $updateStmt->execute([$newName, $categoryId]);
                
                if ($result) {
                    echo "<p style='color: green;'>✓ Cập nhật thành công: ID {$categoryId} - '{$oldName}' → '{$newName}'</p>";
                    $successCount++;
                } else {
                    echo "<p style='color: red;'>✗ Lỗi cập nhật: ID {$categoryId}</p>";
                    $errorCount++;
                }
            } else {
                echo "<p style='color: orange;'>⚠ Category ID {$categoryId} không tồn tại</p>";
                $errorCount++;
            }
        } catch (Exception $e) {
            echo "<p style='color: red;'>✗ Lỗi: ID {$categoryId} - " . $e->getMessage() . "</p>";
            $errorCount++;
        }
    }

    echo "<hr>";
    echo "<h3>Kết quả:</h3>";
    echo "<p><strong>Cập nhật thành công:</strong> {$successCount} danh mục</p>";
    echo "<p><strong>Lỗi:</strong> {$errorCount} danh mục</p>";

    // Hiển thị danh sách categories sau khi cập nhật
    echo "<h3>Danh sách categories sau khi cập nhật:</h3>";
    $stmt = $pdo->query("SELECT category_id, category_name FROM categories ORDER BY category_id");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Tên danh mục</th></tr>";
    foreach ($categories as $category) {
        echo "<tr>";
        echo "<td>{$category['category_id']}</td>";
        echo "<td>{$category['category_name']}</td>";
        echo "</tr>";
    }
    echo "</table>";

} catch (Exception $e) {
    echo "<p style='color: red;'>Lỗi kết nối database: " . $e->getMessage() . "</p>";
}
?>
