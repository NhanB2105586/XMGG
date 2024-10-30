<?php

require_once __DIR__ . '/../bootstrap.php';

define('APPNAME', 'Trang web nội thất Qui Nhan');

$router = new \Bramus\Router\Router();

session_start();
require_once __DIR__ . '/../app/routes/admin.php';
require_once __DIR__ . '/../app/routes/product.php';

$router->get('/', function () {
    echo '404 Không tìm thấy trang.';
});
$router->run();
