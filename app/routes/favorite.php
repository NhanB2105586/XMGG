<?php

use App\Controllers\User\FavoriteController;
use App\Controllers\User\AjaxCartController;

$favoriteController = new FavoriteController();
$ajaxCartController = new AjaxCartController();

// Thêm sản phẩm vào yêu thích
$router->post('/add-favorite', function() use ($favoriteController) {
    $favoriteController->addFavorite();
});

// Xóa sản phẩm khỏi yêu thích
$router->post('/remove-favorite', function() use ($favoriteController) {
    $favoriteController->removeFavorite();
});

// Hiển thị danh sách yêu thích
$router->get('/favorites', function() use ($favoriteController) {
    $favoriteController->showFavorites();
});

// Kiểm tra trạng thái yêu thích
$router->get('/favorite-status', function() use ($favoriteController) {
    $favoriteController->getFavoriteStatus();
});

// Thêm sản phẩm vào giỏ hàng (AJAX)
$router->post('/ajax-add-to-cart', function() use ($ajaxCartController) {
    $ajaxCartController->addToCart();
<<<<<<< HEAD
}); 
=======
}); 
>>>>>>> 7c425505595b6e785662ce5f53f9fbc09bd1405b
