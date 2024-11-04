<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../bootstrap.php';

define('APPNAME', 'Trang web nội thất Qui Nhan');

$router = new \Bramus\Router\Router();

session_start();
require_once __DIR__ . '/../app/routes/admin.php';
require_once __DIR__ . '/../app/routes/product.php';
$router->get('/', function () {
    include __DIR__ . '/../app/views/user/homePage.php'; // Đường dẫn đến tệp trang chủ
});

$router->set404('\App\Controllers\Controller@sendNotFound');

$router->get(
    '/phongkhach/sofa',
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
$router->get(
    '/phongan',
    '\App\Controllers\UserController@showphongan'
);
$router->get(
    '/phongngu',
    '\App\Controllers\UserController@showphongngu'
);
$router->get(
    '/phonglamviec',
    '\App\Controllers\UserController@showphonglamviec'
);

$router->get(
    '/chitietsanpham/(\d+)', // Route với ID sản phẩm dạng số
    '\App\Controllers\UserController@showchitietsanpham'
);

$router->get(
    '/lienhe',
    '\App\Controllers\UserController@showlienhe'
);

$router->get(
    '/dangnhap',
    '\App\Controllers\UserController@showdangnhap'
);

$router->get(
    '/dangki',
    '\App\Controllers\UserController@showdangki'
);

$router->get(
    '/khoiphucmatkhau',
    '\App\Controllers\UserController@showkhoiphuc'
);
$router->run();
