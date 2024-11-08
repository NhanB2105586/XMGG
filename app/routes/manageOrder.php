<?php

// Route xem danh sách đơn hàng
$router->get('/admin/viewOrders', function () use ($PDO) {
    $orderController = new App\Controllers\Admin\ManageOrderController();
    $orderController->index();
});
$router->get('/admin/viewOrders', function () use ($PDO) {
    $orderController = new App\Controllers\Admin\ManageOrderController();
    $orderController->viewOrder($_GET['id']);
});
// Route cập nhật trạng thái đơn hàng
$router->post('/admin/update-statusOrders/{id}', function ($id) use ($PDO) {
    $orderController = new App\Controllers\Admin\ManageOrderController();
    $orderController->updateOrderStatus($id);
});

$router->get('/admin/viewOrders', function ($orderId) {
    // Gọi phương thức xem chi tiết đơn hàng
    (new App\Controllers\Admin\ManageOrderController())->viewOrder($orderId);
});