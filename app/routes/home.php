
<?php
$router->get('/',
    '\App\Controllers\User\UserController@showindex'); // Đường dẫn đến tệp trang chủ;


$router->get(
'/phongkhach',
'\App\Controllers\User\UserController@showphongkhach'
);
$router->get(
'/phongan',
'\App\Controllers\User\UserController@showphongan'
);
$router->get(
'/phongngu',
'\App\Controllers\User\UserController@showphongngu'
);
$router->get(
'/phonglamviec',
    '\App\Controllers\User\UserController@showphonglamviec'
);

$router->get(
    '/lienhe',
    '\App\Controllers\User\UserController@showlienhe'
);

$router->get(
    '/dangnhap',
    '\App\Controllers\User\UserController@showdangnhap'
);

$router->get(
    '/dangki',
    '\App\Controllers\User\UserController@showdangki'
);

$router->get(
    '/khoiphucmatkhau',
    '\App\Controllers\User\UserController@showkhoiphuc'
);

$router->get(
    '/bosuutap',
    '\App\Controllers\User\UserController@showbosuutap'
);


?>