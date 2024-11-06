<?php
$router->get('/admin/viewProducts', function () use ($PDO) {
    $productController = new App\Controllers\Admin\ManageProductController($PDO);
    $productController->index();
});

$router->get('/admin/addProducts', function () use ($PDO) {
    $productController = new App\Controllers\Admin\ManageProductController($PDO);
    $productController->create();
});

$router->post('/admin/addProducts', function () use ($PDO) {
    $productController = new App\Controllers\Admin\ManageProductController($PDO);
    $productController->create();
});

$router->get('/admin/editProducts', function () use ($PDO) {
        $productController = new App\Controllers\Admin\ManageProductController($PDO);
        $productController->edit($_GET['id']);
});
$router->post('/admin/editProducts', function () use ($PDO) {
        $productController = new App\Controllers\Admin\ManageProductController($PDO);
        $productController->edit($_POST['product_id']);
});

$router->post('/admin/deleteProducts', function () use ($PDO) {
    $productController = new App\Controllers\Admin\ManageProductController($PDO);
    $productController->delete($_POST['id']);
});