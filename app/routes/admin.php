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

// Route cho quản lý sản phẩm
$router->get('/admin/viewProduct', function() use ($PDO) {
$manageProductController = new App\Controllers\Admin\ManageProductController($PDO);
$manageProductController->viewProducts();
});

// Route cho thêm sản phẩm
$router->get('/admin/addProduct', function() use ($PDO) {
$manageProductController = new App\Controllers\Admin\ManageProductController($PDO);
$manageProductController->showAddProduct();
});

// Route để xử lý thêm sản phẩm
$router->post('/admin/addProduct', function() use ($PDO) {
$manageProductController = new App\Controllers\Admin\ManageProductController($PDO);
$manageProductController->addProduct();
});

// Route cho chỉnh sửa sản phẩm
$router->get('/admin/editProduct/(\d+)', function($productId) use ($PDO) {
$manageProductController = new App\Controllers\Admin\ManageProductController($PDO);
$manageProductController->showEditProduct($productId);
});

// Route để xử lý cập nhật sản phẩm
$router->post('/admin/editProduct/(\d+)', function($productId) use ($PDO) {
$manageProductController = new App\Controllers\Admin\ManageProductController($PDO);
$manageProductController->updateProduct($productId);
});

// Route để xóa sản phẩm
$router->post('/admin/deleteProduct/(\d+)', function($productId) use ($PDO) {
$manageProductController = new App\Controllers\Admin\ManageProductController($PDO);
$manageProductController->deleteProduct($productId);
});

// Route để lấy thông tin số lượng sản phẩm
$router->get('/get-product-stock/(\d+)', function($productId) use ($PDO) {
$manageProductController = new App\Controllers\Admin\ManageProductController($PDO);
$manageProductController->getProductStock($productId);
});

// Route để cập nhật số lượng sản phẩm khi mua
$router->post('/update-product-stock', function() use ($PDO) {
$manageProductController = new App\Controllers\Admin\ManageProductController($PDO);
$manageProductController->updateProductStock();
});

// Route cho quản lý hạng mục
$router->get('/admin/hangmuc', function() use ($PDO) {
$manageHangmucController = new App\Controllers\Admin\ManageHangmucController($PDO);
$manageHangmucController->index();
});

// Route để lấy dữ liệu hạng mục
$router->get('/admin/hangmuc/data/(\d+)', function($pageId) use ($PDO) {
$manageHangmucController = new App\Controllers\Admin\ManageHangmucController($PDO);
$manageHangmucController->getPageData($pageId);
});

// Route để cập nhật hạng mục
$router->post('/admin/hangmuc/update/(\d+)', function($pageId) use ($PDO) {
$manageHangmucController = new App\Controllers\Admin\ManageHangmucController($PDO);
$manageHangmucController->update($pageId);
});

// Route API để lấy hóa đơn theo tháng
$router->post('/admin/getOrdersByMonth', function() use ($PDO) {
$adminController = new App\Controllers\Admin\AdminController($PDO);
$adminController->getOrdersByMonth();
});
?>
