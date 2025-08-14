<?php
/**
 * Test upload đơn giản
 */

// Kiểm tra upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['test_image'])) {
    $uploadDir = __DIR__ . '/images/upload/';
    
    // Tạo thư mục nếu chưa có
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $file = $_FILES['test_image'];
    
    echo "<h3>Thông tin file:</h3>";
    echo "Tên file: " . $file['name'] . "<br>";
    echo "Loại file: " . $file['type'] . "<br>";
    echo "Kích thước: " . $file['size'] . " bytes<br>";
    echo "Lỗi: " . $file['error'] . "<br>";
    echo "is_uploaded_file: " . (is_uploaded_file($file['tmp_name']) ? 'TRUE' : 'FALSE') . "<br>";
    
    if ($file['error'] === UPLOAD_ERR_OK && is_uploaded_file($file['tmp_name'])) {
        $name = $file['name'];
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $base = pathinfo($name, PATHINFO_FILENAME);
        $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);
        $uniqueName = $base . '_' . time() . '_' . uniqid() . '.' . $ext;
        $imagePath = $uploadDir . $uniqueName;
        
        echo "<h3>Xử lý:</h3>";
        echo "Tên file mới: " . $uniqueName . "<br>";
        echo "Đường dẫn: " . $imagePath . "<br>";
        
        if (move_uploaded_file($file['tmp_name'], $imagePath)) {
            echo "<h3 style='color: green;'>✅ Upload thành công!</h3>";
            echo "File đã được lưu tại: " . $imagePath . "<br>";
            echo "Tên file trong database: " . $uniqueName . "<br>";
            
            // Test hiển thị hình ảnh
            echo "<h3>Test hiển thị:</h3>";
            echo "<img src='/images/upload/" . $uniqueName . "' style='max-width: 300px; border: 1px solid #ccc;'>";
        } else {
            echo "<h3 style='color: red;'>❌ Lỗi khi upload</h3>";
        }
    } else {
        echo "<h3 style='color: red;'>❌ File không hợp lệ</h3>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Test Upload</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .upload-form { border: 2px dashed #ccc; padding: 20px; margin: 20px 0; }
        input[type="file"] { margin: 10px 0; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Test Upload Hình Ảnh</h1>
    
    <div class="upload-form">
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="test_image" accept="image/*" required>
            <br>
            <button type="submit">Upload Test</button>
        </form>
    </div>
    
    <div>
        <h3>Kiểm tra thư mục upload:</h3>
        <?php
        $uploadDir = __DIR__ . '/images/upload/';
        if (is_dir($uploadDir)) {
            $files = scandir($uploadDir);
            echo "<p>Số file: " . (count($files) - 2) . "</p>";
            echo "<ul>";
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    echo "<li>" . $file . "</li>";
                }
            }
            echo "</ul>";
        } else {
            echo "<p style='color: red;'>Thư mục không tồn tại!</p>";
        }
        ?>
    </div>
</body>
</html> 