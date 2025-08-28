<?php

// Route xem danh sách đơn hàng
$router->get('/admin/viewOrders', function () use ($PDO) {
    $orderController = new App\Controllers\Admin\ManageOrderController();
    $orderController->index();
});
// Route cập nhật trạng thái đơn hàng
$router->post('/admin/update-statusOrders/(\d+)', function ($id) use ($PDO) {
    $orderController = new App\Controllers\Admin\ManageOrderController();
    $orderController->updateOrderStatus($id);
});
$router->post('/admin/deleteOrders/(\d+)', function ($id) use ($PDO) {
    $orderController = new App\Controllers\Admin\ManageOrderController();
    $orderController->deleteOrder($id);
});

// Route để xem chi tiết đơn hàng
$router->get('/admin/viewOrderDetail/(\d+)', function ($id) {
    $orderController = new App\Controllers\Admin\ManageOrderController();
    $orderController->viewOrder($id);
});
