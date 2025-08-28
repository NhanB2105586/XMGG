<?php
// Set UTF-8 encoding
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

define('ROOTDIR', __DIR__ . DIRECTORY_SEPARATOR);

require_once ROOTDIR . 'vendor/autoload.php';

// Load environment variables if .env file exists
if (file_exists(ROOTDIR . '.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(ROOTDIR);
    $dotenv->load();
} else {
    // Set default environment variables
    $_ENV['DB_HOST'] = 'localhost';
    $_ENV['DB_NAME'] = 'project';
    $_ENV['DB_USER'] = 'root';
    $_ENV['DB_PASS'] = '';
    $_ENV['APP_ENV'] = 'development';
}

try {
  // Kết nối đến cơ sở dữ liệu
    global $PDO;
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
