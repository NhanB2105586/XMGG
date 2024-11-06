<?php

$router->post('/checkuser', '\App\Controllers\User\UserController@handleLogin');

$router->get(
    '/hoso',
    '\App\Controllers\User\UserController@showhoso'
);

$router->get(
    '/logout',
    '\App\Controllers\User\UserController@logout'
);

$router->post(
    '/checkdangky',
    '\App\Controllers\User\UserController@handleRegistration'
);


?>