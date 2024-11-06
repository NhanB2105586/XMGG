<?php

$router->get(
    '/sanpham',
    '\App\Controllers\User\ProductController@showsanpham'
);

$router->get(
    '/phongkhach/sofa',
    '\App\Controllers\User\ProductController@showsofa'
);

$router->get(
    '/chitietsanpham/(\d+)', // Route với ID sản phẩm dạng số
    '\App\Controllers\User\ProductController@showchitietsanpham'
);

