<?php
$router->post('/thanhtoan', 'App\Controllers\User\OrdersController@showCheckout');
$router->post('/checkthanhtoan', 'App\Controllers\User\OrdersController@checkout');
$router->get('/donhang/{orderId}', 'App\Controllers\User\OrdersController@orderDetail');
$router->get('/showallorders', 'App\Controllers\User\OrdersController@showAllOrders');

?>