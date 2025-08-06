<?php

use App\Controllers\User\ProductController;

$router->get('/cauthang', [ProductController::class, 'showcauthang']);
$router->get('/hangrao', [ProductController::class, 'showhangrao']);
$router->get('/bonhoa', [ProductController::class, 'showbonhoa']);