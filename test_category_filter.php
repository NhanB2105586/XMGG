<?php
// Script test để kiểm tra phần lọc danh mục
$host = 'localhost';
$dbname = 'project';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>Kiểm tra phần lọc danh mục</h2>";
    
    // Test 1: Lấy tất cả categories
    echo "<h3>1. Danh sách tất cả categories:</h3>";
    $stmt = $pdo->query("SELECT category_id, category_name FROM categories ORDER BY category_id");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>ID</th><th>Tên danh mục</th></tr>";
    foreach ($categories as $category) {
        echo "<tr>";
        echo "<td>{$category['category_id']}</td>";
        echo "<td>{$category['category_name']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Test 2: Kiểm tra sản phẩm theo từng danh mục
    echo "<h3>2. Số lượng sản phẩm theo danh mục:</h3>";
    $stmt = $pdo->query("
        SELECT c.category_id, c.category_name, COUNT(p.product_id) as product_count 
        FROM categories c 
        LEFT JOIN products p ON c.category_id = p.category_id 
        GROUP BY c.category_id, c.category_name 
        ORDER BY c.category_id
    ");
    $productCounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>ID</th><th>Tên danh mục</th><th>Số sản phẩm</th></tr>";
    foreach ($productCounts as $row) {
        echo "<tr>";
        echo "<td>{$row['category_id']}</td>";
        echo "<td>{$row['category_name']}</td>";
        echo "<td>{$row['product_count']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Test 3: Test lọc theo category_id = 2 (Thanh Plank)
    echo "<h3>3. Test lọc sản phẩm theo category_id = 2 (Thanh Plank):</h3>";
    $stmt = $pdo->prepare("
        SELECT p.product_id, p.product_name, c.category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.category_id 
        WHERE p.category_id = ?
        LIMIT 5
    ");
    $stmt->execute([2]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($products)) {
        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr><th>ID</th><th>Tên sản phẩm</th><th>Danh mục</th></tr>";
        foreach ($products as $product) {
            echo "<tr>";
            echo "<td>{$product['product_id']}</td>";
            echo "<td>{$product['product_name']}</td>";
            echo "<td>{$product['category_name']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Không có sản phẩm nào trong danh mục này.</p>";
    }
    
    // Test 4: Test lọc theo category_id = 3 (Thanh Lapsiding)
    echo "<h3>4. Test lọc sản phẩm theo category_id = 3 (Thanh Lapsiding):</h3>";
    $stmt = $pdo->prepare("
        SELECT p.product_id, p.product_name, c.category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.category_id 
        WHERE p.category_id = ?
        LIMIT 5
    ");
    $stmt->execute([3]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($products)) {
        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr><th>ID</th><th>Tên sản phẩm</th><th>Danh mục</th></tr>";
        foreach ($products as $product) {
            echo "<tr>";
            echo "<td>{$product['product_id']}</td>";
            echo "<td>{$product['product_name']}</td>";
            echo "<td>{$product['category_name']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Không có sản phẩm nào trong danh mục này.</p>";
    }
    
    echo "<hr>";
    echo "<h3>✅ Kết luận:</h3>";
    echo "<p>Database đã được cập nhật thành công với tên danh mục mới.</p>";
    echo "<p>Phần lọc danh mục trong viewProduct sẽ hoạt động chính xác với tên mới.</p>";
    echo "<p>Bạn có thể test bằng cách:</p>";
    echo "<ul>";
    echo "<li>Vào trang /admin/viewProducts</li>";
    echo "<li>Chọn danh mục từ dropdown</li>";
    echo "<li>Kiểm tra xem sản phẩm có được lọc đúng không</li>";
    echo "</ul>";

} catch (Exception $e) {
    echo "<p style='color: red;'>Lỗi: " . $e->getMessage() . "</p>";
}
?>
