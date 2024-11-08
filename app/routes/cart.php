<?php
$router->get('/giohang', function () {
    $userId = $_SESSION['user_id'] ?? null;
    $cartController = new \App\Controllers\User\CartController();
    $cartController->showgiohang($userId);
});


$router->post('/cart/update', '\App\Controllers\User\CartController@updateCart');
$router->get('/cart/remove/{productId}', '\App\Controllers\User\CartController@removeFromCart');

$router->post('/cart/add', function () {
    $userId = $_SESSION['user_id'] ?? null;
    $productId = $_POST['product_id'] ?? null;
    $quantity = $_POST['quantity'] ?? 1; // Giá trị mặc định là 1 nếu không có quantity

    $cartController = new \App\Controllers\User\CartController();
    $cartController->addToCart($userId, $productId, $quantity);
});

$router->post('/cart/buynow', function () {
    $userId = $_SESSION['user_id'] ?? null;
    $productId = $_POST['product_id'] ?? null;
    $quantity = $_POST['quantity'] ?? 1;

    $cartController = new \App\Controllers\User\CartController();
    $cartController->buyNow($userId, $productId, $quantity);
});

?>