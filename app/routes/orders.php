<?php
$router->get('/thanhtoan', 'App\Controllers\User\OrdersController@showCheckout');
$router->post('/thanhtoan', 'App\Controllers\User\OrdersController@showCheckout');
$router->post('/checkthanhtoan', 'App\Controllers\User\OrdersController@checkout');
$router->post('/send-otp', 'App\Controllers\User\OrdersController@sendOTP');
$router->post('/verify-otp', 'App\Controllers\User\OrdersController@verifyOTP');
$router->get('/donhang/{orderId}', 'App\Controllers\User\OrdersController@orderDetail');
$router->get('/showallorders', 'App\Controllers\User\OrdersController@showAllOrders');

?>
