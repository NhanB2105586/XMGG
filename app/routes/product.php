<?php

$router->get(
    '/sanpham',
    '\App\Controllers\User\ProductController@showsanpham'
);

$router->get(
    '/xmgg/thanhlath',
    '\App\Controllers\User\ProductController@showthanhlath'
);

$router->get(
    '/chitietsanpham/(\d+)', // Route với ID sản phẩm dạng số
    '\App\Controllers\User\ProductController@showchitietsanpham'
);



$router->get(
    '/xmgg/plank',
    '\App\Controllers\User\ProductController@showplank'
);

$router->get(
    '/xmgg/lapsiding',
    '\App\Controllers\User\ProductController@showlapsiding'
);

$router->get(
    '/xmgg/array',
    '\App\Controllers\User\ProductController@showarray'
);

$router->get(
    '/xmgg/deck',
    '\App\Controllers\User\ProductController@showdeck'
);

$router->get(
    '/xmgg/mould',
    '\App\Controllers\User\ProductController@showmould'
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
    '/phongan/tuao',
    '\App\Controllers\User\ProductController@showtuao'
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

$router->get(
    '/tran',
    '\App\Controllers\User\ProductController@showtran'
);

$router->get(
    '/lam',
    '\App\Controllers\User\ProductController@showlam'
);

$router->get(
    '/san',
    '\App\Controllers\User\ProductController@showsan'
);

$router->get(
    '/tuong',
    '\App\Controllers\User\ProductController@showtuong'
);

$router->get(
    '/vach',
    '\App\Controllers\User\ProductController@showvach'
);

$router->get(
    '/cua',
    '\App\Controllers\User\ProductController@showcua'
);


