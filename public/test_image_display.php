<?php
/**
 * Test hiển thị hình ảnh
 */

require_once '../bootstrap.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=project", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Lấy một số sản phẩm có hình ảnh
    $stmt = $pdo->query("
        SELECT p.product_id, p.product_name, pi.image_url 
        FROM products p 
        INNER JOIN product_images pi ON p.product_id = pi.product_id 
        ORDER BY p.product_id DESC 
        LIMIT 10
    ");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage() . "\n";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Test Hiển Thị Hình Ảnh</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
        .product-card { border: 1px solid #ddd; border-radius: 8px; padding: 15px; }
        .product-image { width: 100%; height: 200px; object-fit: cover; border-radius: 4px; }
        .product-name { font-weight: bold; margin: 10px 0; }
        .image-path { font-size: 12px; color: #666; word-break: break-all; }
        .status { padding: 5px 10px; border-radius: 4px; font-size: 12px; }
        .status.success { background: #d4edda; color: #155724; }
        .status.error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <h1>Test Hiển Thị Hình Ảnh</h1>
    
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <?php
                         $imagePath = '/images/upload/' . $product['image_url'];
            $fileExists = file_exists(__DIR__ . '/images/upload/' . $product['image_url']);
            ?>
            <div class="product-card">
                <div class="product-name"><?= htmlspecialchars($product['product_name']) ?></div>
                <div class="image-path">File: <?= htmlspecialchars($product['image_url']) ?></div>
                <div class="status <?= $fileExists ? 'success' : 'error' ?>">
                    <?= $fileExists ? '✅ File tồn tại' : '❌ File không tồn tại' ?>
                </div>
                
                <?php if ($fileExists): ?>
                    <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($product['product_name']) ?>" class="product-image">
                <?php else: ?>
                    <div style="width: 100%; height: 200px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; border-radius: 4px;">
                        <span style="color: #666;">Hình ảnh không tồn tại</span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div style="margin-top: 30px; padding: 20px; background: #f8f9fa; border-radius: 8px;">
        <h3>Thông tin:</h3>
                 <ul>
             <li>Đường dẫn hình ảnh: <code>/images/upload/</code></li>
             <li>Số sản phẩm test: <?= count($products) ?></li>
             <li>Thời gian: <?= date('Y-m-d H:i:s') ?></li>
         </ul>
    </div>
</body>
</html> 