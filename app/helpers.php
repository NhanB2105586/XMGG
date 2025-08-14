<?php

# redirect to specific page
function redirectTo(string $url, array $data = []): void
{
    setIntoSESSION($data);

    header('Location: ' . $url);
    exit;
}

# load page
function renderPage(string $page, array $data = []): void
{
    setIntoSESSION($data);
    require_once __DIR__ . '/views' . $page;
}

# get variable in SESSION and delete it
function getOnceSession(string $name, $default = null): mixed
{
    $value = $default;

    if (isset($_SESSION[$name])) {
        $value = $_SESSION[$name];
        unset($_SESSION[$name]);
    }

    return $value;
}

# set variable into SESSION
function setIntoSESSION(array $data): void
{
    foreach ($data as $key => $value) {
        $_SESSION[$key] = $value;
    }
}

# delete variable in SESSION
function purgeSESSION(string $key): void
{
    if (isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
}

# convert day to Vietnamese day
function retrieveDay(int $day): string
{
    $res = '';

    switch ($day) {
        case 0:
            $res = 'Chủ nhật';
            break;
        case 1:
            $res = 'Thứ hai';
            break;
        case 2:
            $res = 'Thứ ba';
            break;
        case 3:
            $res = 'Thứ tư';
            break;
        case 4:
            $res = 'Thứ năm';
            break;
        case 5:
            $res = 'Thứ sáu';
            break;
        case 6:
            $res = 'Thứ bảy';
            break;
    }
    return $res;
}

function formatMoney(int $money): string
{
    $strMoney = (string)$money;
    $moneyUnits = [];

    for ($i = strlen($strMoney) - 1; $i >= 0; $i -= 3) {
        $moneyUnit = '';
        for ($j = max(0, $i - 2); $j <= $i; ++$j) {
            $moneyUnit .= $strMoney[$j];
        }
        array_unshift($moneyUnits, $moneyUnit);
    }

    $result = join('.', $moneyUnits);
    return $result;
}


# retrieve type of items
function retrieveTypeItem(int $type): string
{
    $typeName = '';

    switch ($type) {
        case 1:
            $typeName = 'Nồi';
            break;
        case 2:
            $typeName = 'Bếp gas';
            break;
        case 3:
            $typeName = 'Trang trí nhà bếp';
            break;
        case 4:
            $typeName = 'Điện lạnh';
            break;
    };

    return $typeName;
}

# get image path for product images
function getImagePath(string $imageUrl): string
{
    // Nếu imageUrl đã có đường dẫn đầy đủ, trả về nguyên bản
    if (strpos($imageUrl, 'http') === 0) {
        return $imageUrl;
    }

    // Nếu imageUrl chỉ là tên file, thêm đường dẫn upload
    if (strpos($imageUrl, '/') !== 0) {
        return '/images/upload/' . $imageUrl;
    }

    // Trả về nguyên bản nếu đã có đường dẫn tương đối
    return $imageUrl;
}

# get main image for product display
function getMainImage($product): ?string
{
    // Nếu có main_image được set
    if (isset($product['main_image']) && $product['main_image']) {
        return getImagePath($product['main_image']['image_url']);
    }
    
    // Nếu có images array, lấy ảnh đầu tiên
    if (isset($product['images']) && !empty($product['images'])) {
        return getImagePath($product['images'][0]['image_url']);
    }
    
    // Trả về ảnh mặc định
    return '/images/upload/default.jpg';
}

# check if image is main image (ảnh đầu tiên)
function isMainImage($productId, $imageId): bool
{
    // Đơn giản: ảnh chính là ảnh đầu tiên trong danh sách
    // Logic này sẽ được xử lý trong Model, helper chỉ để tương thích
    return false; // Sẽ được override bởi Model
}
