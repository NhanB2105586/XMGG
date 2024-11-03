<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../bootstrap.php';

define('APPNAME', 'Trang web nội thất Qui Nhan');

$router = new \Bramus\Router\Router();

session_start();
require_once __DIR__ . '/../app/routes/admin.php';
require_once __DIR__ . '/../app/routes/manageCustomer.php';
require_once __DIR__ . '/../app/routes/product.php';

$router->get('/', function () {
    include __DIR__ . '/../app/views/user/homePage.php'; // Đường dẫn đến tệp trang chủ
});

$router->set404('\App\Controllers\Controller@sendNotFound');

$router->get(
    '/sanpham/sofa',
    '\App\Controllers\UserController@showsofa'
);
$router->get(
    '/sanpham',
    '\App\Controllers\UserController@showsanpham'
);
$router->get(
    '/phongkhach',
    '\App\Controllers\UserController@showphongkhach'
);
$router->run();
