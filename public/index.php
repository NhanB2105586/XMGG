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
require_once __DIR__ . '/../app/routes/home.php';
require_once __DIR__ . '/../app/routes/cart.php';
require_once __DIR__ . '/../app/routes/user.php';
require_once __DIR__ . '/../app/routes/orders.php';

$router->set404('\App\Controllers\Controller@sendNotFound');


$router->run();
