<?php

// Admin routes
$router->get('/admin', function() use ($PDO) {
    $adminController = new \App\Controllers\Admin\AdminController($PDO);
    $adminController->index();
});

$router->get('/admin/login', function() use ($PDO) {
    $adminController = new \App\Controllers\Admin\AdminController($PDO);
$adminController->showLogin();
});

$router->post('/admin/login', function() use ($PDO) {
    $adminController = new \App\Controllers\Admin\AdminController($PDO);
$adminController->login();
});

$router->get('/admin/logout', function() use ($PDO) {
    $adminController = new \App\Controllers\Admin\AdminController($PDO);
$adminController->logout();
});

// Product management
$router->get('/admin/products', function() use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageProductController($PDO);
    $controller->viewProducts();
});

$router->get('/admin/addProduct', function() use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageProductController($PDO);
    $controller->showAddProduct();
});

$router->post('/admin/addProduct', function() use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageProductController($PDO);
    $controller->addProduct();
});

$router->get('/admin/editProduct/(\d+)', function($id) use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageProductController($PDO);
    $controller->edit($id);
});

$router->post('/admin/editProduct/(\d+)', function($id) use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageProductController($PDO);
    $controller->edit($id);
});

$router->post('/admin/deleteProduct/(\d+)', function($id) use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageProductController($PDO);
    $controller->deleteProduct($id);
});

$router->get('/admin/viewProduct', function() use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageProductController($PDO);
    $controller->viewProducts();
});

// Category management










// Hangmuc management
$router->get('/admin/hangmuc', function() use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageHangmucController($PDO);
    $controller->index();
});

$router->post('/admin/hangmuc/update/(\d+)', function($pageId) use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageHangmucController($PDO);
    $controller->update($pageId);
});

$router->get('/admin/hangmuc/data/(\d+)', function($pageId) use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageHangmucController($PDO);
    $controller->getPageData($pageId);
});

$router->post('/admin/hangmuc/delete/(\d+)', function($pageId) use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageHangmucController($PDO);
    $controller->delete($pageId);
});

$router->post('/admin/hangmuc/create', function() use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageHangmucController($PDO);
    $controller->create();
});

// Hangmuc Products management
$router->get('/admin/hangmuc-products', function() use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageHangmucProductsController();
    $controller->showHangmucProducts();
});

$router->get('/admin/hangmuc-products/get-product/(\d+)', function($id) use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageHangmucProductsController();
    $controller->getProduct($id);
});

$router->get('/admin/hangmuc-products/([a-zA-Z0-9-]+)', function($slug) use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageHangmucProductsController();
    $controller->showHangmucProducts($slug);
});

$router->post('/admin/hangmuc-products/create', function() use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageHangmucProductsController();
    $controller->createProduct();
});

$router->post('/admin/hangmuc-products/update/(\d+)', function($id) use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageHangmucProductsController();
    $controller->updateProduct($id);
});

$router->post('/admin/hangmuc-products/delete/(\d+)', function($id) use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageHangmucProductsController();
    $controller->deleteProduct($id);
});

$router->post('/admin/hangmuc-products/toggle/(\d+)', function($id) use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageHangmucProductsController();
    $controller->toggleActive($id);
});

$router->post('/admin/hangmuc-products/sort', function() use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageHangmucProductsController();
    $controller->updateSortOrder();
});

$router->post('/admin/hangmuc-products/swap', function() use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageHangmucProductsController();
    $controller->swapProducts();
});

// Order management




// User management






// Dashboard
$router->get('/admin/dashboard', function() use ($PDO) {
    $controller = new \App\Controllers\Admin\AdminController($PDO);
    $controller->index();
});

$router->get('/admin/statistics', function() use ($PDO) {
    $controller = new \App\Controllers\Admin\AdminController($PDO);
    $controller->getStatistics();
});

// API để lấy hóa đơn theo tháng
$router->post('/admin/getOrdersByMonth', function() use ($PDO) {
    $controller = new \App\Controllers\Admin\AdminController($PDO);
    $controller->getOrdersByMonth();
});

// Route để lấy thông tin số lượng sản phẩm
$router->get('/get-product-stock/(\d+)', function($productId) use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageProductController($PDO);
    $controller->getProductStock($productId);
});

// Route để cập nhật số lượng sản phẩm khi mua
$router->post('/update-product-stock', function() use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageProductController($PDO);
    $controller->updateProductStock();
});

// Route để xóa nhiều sản phẩm
$router->post('/admin/deleteMultipleProducts', function() use ($PDO) {
    $controller = new \App\Controllers\Admin\ManageProductController($PDO);
    $controller->deleteMultipleProducts();
});
?>
