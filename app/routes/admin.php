<?php
$router->get('/admin/login', function() use ($PDO)  {
$adminController = new App\Controllers\Admin\AdminController($PDO);
$adminController->showLogin();
});

// Route để xử lý đăng nhập
$router->post('/admin/login', function() use ($PDO) {
$adminController = new App\Controllers\Admin\AdminController($PDO);
$adminController->login();
});

// Route cho trang admin (chỉ có thể truy cập nếu đã đăng nhập)
$router->get('/admin', function() use ($PDO) {
$adminController = new App\Controllers\Admin\AdminController($PDO);
$adminController->index();
});

// Route cho đăng xuất
$router->get('/admin/logout', function() use ($PDO) {
$adminController = new App\Controllers\Admin\AdminController($PDO);
$adminController->logout();
});