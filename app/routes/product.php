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



$router->get(
    '/phongan/ghean',
    '\App\Controllers\User\ProductController@showghean'
);

$router->get(
    '/phonglamviec/ghelamviec',
    '\App\Controllers\User\ProductController@showghelamviec'
);

$router->get(
    '/phongkhach/kephongkhach',
    '\App\Controllers\User\ProductController@showkephongkhach'
);

$router->get(
    '/phonglamviec/kesach',
    '\App\Controllers\User\ProductController@showkesach'
);

$router->get(
    '/phongngu/giuongngu',
    '\App\Controllers\User\ProductController@showgiuongngu'
);

$router->get(
    '/phongngu/nem',
    '\App\Controllers\User\ProductController@shownem'
);

$router->get(
    '/phongkhach/bannuoc',
    '\App\Controllers\User\ProductController@showbannuoc'
);

$router->get(
    '/phongan/banan',
    '\App\Controllers\User\ProductController@showbanan'
);

$router->get(
    '/phonglamviec/banlamviec',
    '\App\Controllers\User\ProductController@showbanlamviec'
);

$router->get(
    '/phongkhach/tutivi',
    '\App\Controllers\User\ProductController@showtivi'
);

$router->get(
    '/phongan/tubep',
    '\App\Controllers\User\ProductController@showtubep'
);

$router->get(
    '/phongan/tuly',
    '\App\Controllers\User\ProductController@showtuly'
);

$router->get(
    '/phongngu/tuao',
    '\App\Controllers\User\ProductController@showtuao'
);

$router->get(
    '/phongngu/goi',
    '\App\Controllers\User\ProductController@showgoi'
);

$router->get(
    '/hangtrangtri/binh',
    '\App\Controllers\User\ProductController@showbinh'
);

$router->get(
    '/hangtrangtri/den',
    '\App\Controllers\User\ProductController@showden'
);

$router->get(
    '/hangtrangtri/tranh',
    '\App\Controllers\User\ProductController@showtranh'
);

$router->get(
    '/phongngu/men',
    '\App\Controllers\User\ProductController@showmen'
);


