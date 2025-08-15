<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../bootstrap.php';

// Sử dụng biến môi trường để kiểm soát việc báo lỗi.
// Đặt APP_ENV=development trong tệp .env của bạn cho chế độ phát triển.
if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'development') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
}

// Khởi động session. Nên kiểm tra xem session đã được bắt đầu chưa.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('APPNAME', 'Trang web nội thất Qui Nhan');

$router = new \Bramus\Router\Router();

// Một cách gọn gàng hơn để tải tất cả các tệp route
// Lệnh này sẽ tự động tải bất kỳ tệp .php nào từ thư mục routes.
$routeFiles = glob(__DIR__ . '/../app/routes/*.php');
foreach ($routeFiles as $routeFile) {
    require_once $routeFile;
}

$router->set404('\App\Controllers\Controller@sendNotFound');
$router->run();
