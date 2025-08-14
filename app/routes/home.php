
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

// Routes cho các hạng mục mới
$router->get('/vach', '\App\Controllers\User\UserController@showvach');
$router->get('/cua', '\App\Controllers\User\UserController@showcua');
$router->get('/hangrao', '\App\Controllers\User\UserController@showhangrao');
$router->get('/lam', '\App\Controllers\User\UserController@showlam');
$router->get('/san', '\App\Controllers\User\UserController@showsan');
$router->get('/tran', '\App\Controllers\User\UserController@showtran');
$router->get('/cauthang', '\App\Controllers\User\UserController@showcauthang');
$router->get('/bonhoa', '\App\Controllers\User\UserController@showbonhoa');

?>
