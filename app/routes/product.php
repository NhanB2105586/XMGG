<?php
$router->get('/products', function () use ($PDO) {
    $controller = new App\Controllers\User\ProductController($PDO);
    $controller->index();
});