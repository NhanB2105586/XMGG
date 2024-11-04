<?php
use App\Controllers\Admin\CategoryController;

// Route để hiển thị danh sách danh mục
$router->get('/admin/viewCategory', function () use ($PDO) {
    $categoryController = new App\Controllers\Admin\ManageCategoryController($PDO);
    $categoryController->index();
});
$router->get('/admin/addCategory', function () use ($PDO) {
    $categoryController = new App\Controllers\Admin\ManageCategoryController($PDO);
    $categoryController->create();
});
$router->post('/admin/addCategory', function () use ($PDO) {
    $categoryController = new App\Controllers\Admin\ManageCategoryController($PDO);
    $categoryController->store();
});

// Route để hiển thị form chỉnh sửa danh mục
$router->get('/admin/editCategory/{id}', function($id) use ($PDO) {
$categoryController = new App\Controllers\Admin\ManageCategoryController($PDO);
$categoryController->edit($id);
});

// Route để xử lý cập nhật danh mục
$router->post('/admin/editCategory/{id}', function($id) use ($PDO) {
$categoryController = new App\Controllers\Admin\ManageCategoryController($PDO);
$categoryController->edit($id);
});

//Xóa
$router->post('/admin/deleteCategory', function () use ($PDO) {
    $categoryController = new App\Controllers\Admin\ManageCategoryController($PDO);
    $categoryController->deletecategory();
});