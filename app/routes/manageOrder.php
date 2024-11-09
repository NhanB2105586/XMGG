<?php

// Route xem danh sách đơn hàng
$router->get('/admin/viewOrders', function () use ($PDO) {
    $orderController = new App\Controllers\Admin\ManageOrderController();
    $orderController->index();
});
// Route cập nhật trạng thái đơn hàng
$router->post('/admin/update-statusOrders/{id}', function ($id) use ($PDO) {
    $orderController = new App\Controllers\Admin\ManageOrderController();
    $orderController->updateOrderStatus($id);
});
$router->post('/admin/deleteOrders/{id}', function ($id) use ($PDO) {
    $orderController = new App\Controllers\Admin\ManageOrderController();
    $orderController->deleteOrder($id);
});

// Route để xem chi tiết đơn hàng
$router->get('/admin/viewOrderDetail/{id}', function ($id) {
    $orderController = new App\Controllers\Admin\ManageOrderController();
    $orderController->viewOrder($id);
});