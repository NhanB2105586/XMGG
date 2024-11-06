<?php
$router->get('/admin/viewCustomer', function () use ($PDO) {
    $controller = new App\Controllers\Admin\ManageCustomerController($PDO);
    $controller->index();
});
$router->get('/admin/addCustomer', function () use ($PDO) {
    $controller = new App\Controllers\Admin\ManageCustomerController($PDO);
    $controller->showForm();
});
$router->post('/admin/addCustomer', function () use ($PDO) {
    $controller = new App\Controllers\Admin\ManageCustomerController($PDO);
    $controller->addCustomer();
});
$router->post('/admin/deleteCustomer', function () use ($PDO) {
    $controller = new App\Controllers\Admin\ManageCustomerController($PDO);
    $controller->deleteCustomer();
});
$router->post('/admin/editCustomer', function () use ($PDO) {
    $controller = new App\Controllers\Admin\ManageCustomerController($PDO);
    $controller->editCustomer($_POST['id']);
});
$router->get('/admin/editCustomer', function () use ($PDO) {
    $controller = new App\Controllers\Admin\ManageCustomerController($PDO);
    $controller->editCustomer($_GET['id']);
});