<?php

// Route cho trang tin tức
$router->get('/tintuc', function() {
    require_once __DIR__ . '/../views/user/tintuc.php';
});

// Route cho trang khác
$router->get('/khac', function() {
    require_once __DIR__ . '/../views/user/khac.php';
});

// Route cho trang chính sách bảo hành
$router->get('/chinhsachbaohanh', function() {
    require_once __DIR__ . '/../views/user/chinhsachbaohanh.php';
});

// Route cho trang thông tin sản phẩm
$router->get('/thongtinsanpham', function() {
    require_once __DIR__ . '/../views/user/thongtinsanpham.php';
});

// Route cho trang quy trình thi công
$router->get('/quytrinhthicong', function() {
    require_once __DIR__ . '/../views/user/quytrinhthicong.php';
});

// Route cho trang trần
$router->get('/tran', function() {
    require_once __DIR__ . '/../views/user/tran.php';
});

// Route cho trang lam
$router->get('/lam', function() {
    require_once __DIR__ . '/../views/user/lam.php';
});

// Route cho trang sàn
$router->get('/san', function() {
    require_once __DIR__ . '/../views/user/san.php';
});

// Route cho trang tường
$router->get('/tuong', function() {
    require_once __DIR__ . '/../views/user/tuong.php';
});

// Route cho trang vách
$router->get('/vach', function() {
    require_once __DIR__ . '/../views/user/vach.php';
});

// Route cho trang cửa
$router->get('/cua', function() {
    require_once __DIR__ . '/../views/user/cua.php';
}); 
