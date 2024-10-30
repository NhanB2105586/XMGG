<?php
define('ROOTDIR', __DIR__ . DIRECTORY_SEPARATOR);

require_once ROOTDIR . 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOTDIR);
$dotenv->load();

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