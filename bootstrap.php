<?php
define('ROOTDIR', __DIR__ . DIRECTORY_SEPARATOR);

require_once ROOTDIR . 'vendor/autoload.php';

// Kiểm tra file .env tồn tại trước khi load
if (file_exists(ROOTDIR . '.env')) {
    try {
        $dotenv = Dotenv\Dotenv::createImmutable(ROOTDIR);
        $dotenv->load();
    } catch (Exception $e) {
        // Nếu file .env lỗi, sử dụng giá trị mặc định
        $_ENV['DB_HOST'] = 'localhost';
        $_ENV['DB_NAME'] = 'project';
        $_ENV['DB_USER'] = 'root';
        $_ENV['DB_PASS'] = '';
        $_ENV['APP_ENV'] = 'development';
    }
} else {
    // Sử dụng giá trị mặc định nếu không có file .env
    $_ENV['DB_HOST'] = 'localhost';
    $_ENV['DB_NAME'] = 'project';
    $_ENV['DB_USER'] = 'root';
    $_ENV['DB_PASS'] = '';
    $_ENV['APP_ENV'] = 'development';
}

try {
  // Kết nối đến cơ sở dữ liệu
    $PDO = (new App\Core\PDOFactory())->create([
        'dbhost' => $_ENV['DB_HOST'],
        'dbname' => $_ENV['DB_NAME'],
        'dbuser' => $_ENV['DB_USER'],
        'dbpass' => $_ENV['DB_PASS'],
    ]);

    // Kiểm tra kết nối
    if (!$PDO) {
        throw new Exception('Không thể kết nối đến MySQL, kiểm tra lại username/password đến MySQL.');
    }
} catch (Exception $ex) {
    echo 'Lỗi: ' . $ex->getMessage() . '<br>';
}
