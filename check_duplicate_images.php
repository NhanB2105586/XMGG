<?php
// Script kiểm tra ảnh duplicate trong database
$host = 'localhost';
$dbname = 'project';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>Kiểm tra ảnh duplicate trong database</h2>";
    
    // Kiểm tra ảnh duplicate theo image_url
    $stmt = $pdo->query("
        SELECT image_url, COUNT(*) as count, GROUP_CONCAT(image_id) as image_ids, GROUP_CONCAT(product_id) as product_ids
        FROM product_images 
        GROUP BY image_url 
        HAVING COUNT(*) > 1
        ORDER BY count DESC
    ");
    $duplicates = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($duplicates)) {
        echo "<p style='color: green;'>✅ Không có ảnh duplicate nào trong database!</p>";
    } else {
        echo "<h3>🔍 Tìm thấy " . count($duplicates) . " ảnh duplicate:</h3>";
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>Ảnh</th><th>URL</th><th>Số lần xuất hiện</th><th>Image IDs</th><th>Product IDs</th><th>Hành động</th></tr>";
        
        foreach ($duplicates as $duplicate) {
            echo "<tr>";
            echo "<td>";
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/images/upload/" . $duplicate['image_url'])) {
                echo "<img src='/images/upload/{$duplicate['image_url']}' style='width: 50px; height: 50px; object-fit: cover;'>";
            } else {
                echo "<span style='color: red;'>File không tồn tại</span>";
            }
            echo "</td>";
            echo "<td>{$duplicate['image_url']}</td>";
            echo "<td>{$duplicate['count']}</td>";
            echo "<td>{$duplicate['image_ids']}</td>";
            echo "<td>{$duplicate['product_ids']}</td>";
            echo "<td>";
            echo "<button onclick='fixDuplicate(\"{$duplicate['image_url']}\")' style='background: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;'>Xóa duplicate</button>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        echo "<script>
        function fixDuplicate(imageUrl) {
            if (confirm('Bạn có chắc chắn muốn xóa các ảnh duplicate này?')) {
                fetch('fix_duplicate_images.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'image_url=' + encodeURIComponent(imageUrl)
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload();
                })
                .catch(error => {
                    alert('Lỗi: ' + error);
                });
            }
        }
        </script>";
    }
    
    // Hiển thị thống kê tổng quan
    echo "<hr>";
    echo "<h3>📊 Thống kê tổng quan:</h3>";
    
    $stmt = $pdo->query("SELECT COUNT(*) as total_images FROM product_images");
    $totalImages = $stmt->fetch(PDO::FETCH_ASSOC)['total_images'];
    
    $stmt = $pdo->query("SELECT COUNT(DISTINCT image_url) as unique_images FROM product_images");
    $uniqueImages = $stmt->fetch(PDO::FETCH_ASSOC)['unique_images'];
    
    $stmt = $pdo->query("SELECT COUNT(DISTINCT product_id) as total_products FROM product_images");
    $totalProducts = $stmt->fetch(PDO::FETCH_ASSOC)['total_products'];
    
    echo "<ul>";
    echo "<li><strong>Tổng số ảnh:</strong> {$totalImages}</li>";
    echo "<li><strong>Số ảnh unique:</strong> {$uniqueImages}</li>";
    echo "<li><strong>Số sản phẩm có ảnh:</strong> {$totalProducts}</li>";
    echo "<li><strong>Số ảnh duplicate:</strong> " . ($totalImages - $uniqueImages) . "</li>";
    echo "</ul>";

} catch (Exception $e) {
    echo "<p style='color: red;'>Lỗi: " . $e->getMessage() . "</p>";
}
?>
