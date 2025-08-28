<?php
// Lấy thông tin user từ session
$user = null;
if (isset($_SESSION['user_id']) && isset($_SESSION['user_fullname'])) {
    $user = [
        'user_id' => $_SESSION['user_id'],
        'fullname' => $_SESSION['user_fullname'],
        'avatar' => $_SESSION['user_avatar'] ?? '/images/avatar.jpg'
    ];
}

// Lấy danh mục từ database
try {
    $pdo = new PDO('mysql:host=localhost;dbname=project;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Lấy danh mục xi măng giả gỗ - sắp xếp theo ID (tạo trước lên trên)
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE category_type = 'ximang' ORDER BY category_id ASC");
    $stmt->execute();
    $ximangCategories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Lấy danh mục nội thất - sắp xếp theo ID (tạo trước lên trên)
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE category_type = 'noithat' ORDER BY category_id ASC");
    $stmt->execute();
    $noithatCategories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (Exception $e) {
    // Fallback data nếu database không kết nối được
    $ximangCategories = [
        ['category_name' => 'Thanh Lath', 'slug' => 'thanhlath'],
        ['category_name' => 'Lapsiding', 'slug' => 'lapsiding'],
        ['category_name' => 'Array', 'slug' => 'array'],
        ['category_name' => 'Deck', 'slug' => 'deck'],
        ['category_name' => 'Mould', 'slug' => 'mould'],
        ['category_name' => 'Plank', 'slug' => 'plank']
    ];
    $noithatCategories = [
        ['category_name' => 'Tủ ly', 'slug' => 'tuly'],
        ['category_name' => 'Tủ áo', 'slug' => 'tuao'],
        ['category_name' => 'Tủ bếp', 'slug' => 'tubep'],
        ['category_name' => 'Bàn ăn', 'slug' => 'banan'],
        ['category_name' => 'Tủ tivi', 'slug' => 'tutivi'],
        ['category_name' => 'Bàn nước', 'slug' => 'bannuoc'],
        ['category_name' => 'Bàn làm việc', 'slug' => 'banlamviec'],
        ['category_name' => 'Nệm', 'slug' => 'nem'],
        ['category_name' => 'Gối', 'slug' => 'goi'],
        ['category_name' => 'Mền', 'slug' => 'men'],
        ['category_name' => 'Đèn', 'slug' => 'den'],
        ['category_name' => 'Bình', 'slug' => 'binh'],
        ['category_name' => 'Tranh', 'slug' => 'tranh'],
        ['category_name' => 'Hộp', 'slug' => 'hp']
    ];
}

// Hàm tạo URL đúng cho từng danh mục
function getCategoryUrl($slug) {
    // Danh sách các slug đặc biệt cần URL riêng
    $specialUrls = [
        // Xi măng giả gỗ - có URL riêng
        'thanhlath' => '/xmgg/thanhlath',
        'lapsiding' => '/xmgg/lapsiding',
        'array' => '/xmgg/array',
        'deck' => '/xmgg/deck',
        'mould' => '/xmgg/mould',
        'plank' => '/xmgg/plank',
        
        // Nội thất - Phòng ăn (có URL riêng)
        'tuly' => '/phongan/tuly',
        'tuao' => '/phongan/tuao',
        'tubep' => '/phongan/tubep',
        'banan' => '/phongan/banan',
        
        // Nội thất - Phòng khách (có URL riêng)
        'tutivi' => '/phongkhach/tutivi',
        'bannuoc' => '/phongkhach/bannuoc',
        
        // Nội thất - Phòng làm việc (có URL riêng)
        'banlamviec' => '/phonglamviec/banlamviec',
        
        // Nội thất - Phòng ngủ (có URL riêng)
        'nem' => '/phongngu/nem',
        'goi' => '/phongngu/goi',
        'men' => '/phongngu/men',
        
        // Nội thất - Hàng trang trí (có URL riêng)
        'den' => '/hangtrangtri/den',
        'binh' => '/hangtrangtri/binh',
        'tranh' => '/hangtrangtri/tranh',
        'hp' => '/hangtrangtri/hp'
    ];
    
    // Nếu slug có trong danh sách đặc biệt, trả về URL tương ứng
    if (isset($specialUrls[$slug])) {
        return $specialUrls[$slug];
    }
    
    // TỰ ĐỘNG: Tạo URL dựa trên loại danh mục từ database
    global $ximangCategories, $noithatCategories;
    
    // Kiểm tra trong danh mục xi măng giả gỗ
    if (is_array($ximangCategories)) {
        foreach ($ximangCategories as $category) {
            if ($category['slug'] === $slug) {
                return "/xmgg/{$slug}";
            }
        }
    }
    
    // Kiểm tra trong danh mục nội thất
    if (is_array($noithatCategories)) {
        foreach ($noithatCategories as $category) {
            if ($category['slug'] === $slug) {
                return "/hangtrangtri/{$slug}";
            }
        }
    }
    
    // Nếu không tìm thấy trong danh sách, kiểm tra database
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=project;charset=utf8mb4', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare("SELECT category_type FROM categories WHERE slug = ?");
        $stmt->execute([$slug]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($category) {
            return $category['category_type'] === 'ximang' ? "/xmgg/{$slug}" : "/hangtrangtri/{$slug}";
        }
    } catch (Exception $e) {
        // Nếu có lỗi database, mặc định nội thất
    }
    
    // Mặc định cho danh mục nội thất (nếu không tìm thấy)
    return "/hangtrangtri/{$slug}";
}

// Phân loại danh mục nội thất
$mainNoithatCategories = [];
$subNoithatCategories = [];

if (is_array($noithatCategories)) {
    foreach ($noithatCategories as $category) {
        $slug = $category['slug'];
        // Danh mục chính (có URL riêng)
        if (in_array($slug, ['tuly', 'tuao', 'tubep', 'banan', 'tutivi', 'bannuoc', 'banlamviec'])) {
            $mainNoithatCategories[] = $category;
        } else {
            // Danh mục phụ (dùng URL chung)
            $subNoithatCategories[] = $category;
        }
    }
}

// Sắp xếp danh mục nội thất chính
$knownMainOrder = ['tuly', 'tuao', 'tubep', 'banan', 'tutivi', 'bannuoc', 'banlamviec'];
usort($mainNoithatCategories, function($a, $b) use ($knownMainOrder) {
    $posA = array_search($a['slug'], $knownMainOrder);
    $posB = array_search($b['slug'], $knownMainOrder);
    
    if ($posA !== false && $posB !== false) {
        return $posA - $posB;
    }
    if ($posA !== false) return -1;
    if ($posB !== false) return 1;
    // Danh mục mới: sắp xếp theo ID (tạo trước lên trên)
    return $a['category_id'] - $b['category_id'];
});

// Sắp xếp danh mục nội thất phụ
$priorityOrder = ['nem', 'goi', 'men', 'den', 'binh', 'tranh', 'hp'];
usort($subNoithatCategories, function($a, $b) use ($priorityOrder) {
    $posA = array_search($a['slug'], $priorityOrder);
    $posB = array_search($b['slug'], $priorityOrder);
    
    if ($posA !== false && $posB !== false) {
        return $posA - $posB;
    }
    if ($posA !== false) return -1;
    if ($posB !== false) return 1;
    // Danh mục mới: sắp xếp theo ID (tạo trước lên trên)
    return $a['category_id'] - $b['category_id'];
});
?>

<!-- navbar -->
<style>
    /* CSS cho modal thông tin khách hàng - Thiết kế tối giản */
    .user-info-modal {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        padding: 12px 0;
        width: 200px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        z-index: 99999;
        margin-top: 5px;
        font-size: 14px;
        transition: opacity 0.2s ease;
        opacity: 0;
    }

    .user-info-modal::before {
        content: '';
        position: absolute;
        top: -6px;
        right: 15px;
        width: 0;
        height: 0;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-bottom: 6px solid #fff;
    }

    .user-info-modal .user-greeting {
        padding: 12px 16px;
        color: #333;
        font-size: 14px;
        font-weight: 600;
        border-bottom: 1px solid #f0f0f0;
        margin-bottom: 8px;
        background-color: #f8f8f8;
    }

    .user-info-modal .menu-item {
        display: block;
        padding: 8px 16px;
        color: #333;
        text-decoration: none;
        transition: background-color 0.2s ease;
        font-size: 14px;
    }

    .user-info-modal .menu-item:hover {
        background-color: #f5f5f5;
        color: #000;
    }

    .user-info-modal .logout-btn {
        display: block;
        width: calc(100% - 32px);
        margin: 8px 16px 0 16px;
        padding: 8px 12px;
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        border-radius: 4px;
        color: #666;
        text-decoration: none;
        text-align: center;
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .user-info-modal .logout-btn:hover {
        background-color: #e9e9e9;
        color: #333;
    }

    /* Responsive cho mobile */
    @media (max-width: 768px) {
        .user-info-modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 280px;
            z-index: 10000;
            margin-top: 0;
            border-radius: 8px;
        }
        
        .user-info-modal::before {
            display: none;
        }

        .user-info-modal .user-greeting {
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 600;
            background-color: #f8f8f8;
        }

        .user-info-modal .menu-item {
            padding: 10px 16px;
            font-size: 15px;
        }

        .user-info-modal .logout-btn {
            margin: 10px 16px 0 16px;
            padding: 10px 12px;
            font-size: 14px;
        }

        /* Overlay cho mobile */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 9999;
            display: none;
            transition: opacity 0.2s ease;
        }
    }

    /* Ẩn CSS hover cũ */
    #avatar:hover + .user-info-modal,
    .user-info-modal:hover {
        display: none;
    }

    /* Overlay cho desktop (ẩn) */
    .modal-overlay {
        display: none;
    }

    /* Đảm bảo navbar hoạt động trên homepage */
    .navbar {
        z-index: 10001 !important;
    }
    
    .navbar .dropdown-menu {
        z-index: 10002 !important;
    }
    
    /* Đảm bảo link SẢN PHẨM có thể click được */
    .nav-link.dropdown-toggle {
        pointer-events: auto !important;
        cursor: pointer !important;
    }
    
    /* Đảm bảo dropdown menu hoạt động tốt */
    .dropdown-menu {
        pointer-events: auto !important;
    }
    
    .dropdown-item {
        pointer-events: auto !important;
        cursor: pointer !important;
    }
    
    /* Đảm bảo các nút icon hoạt động */
    .icon-btn {
        pointer-events: auto !important;
    }
    
    .icon-btn a {
        pointer-events: auto !important;
        display: block;
        width: 100%;
        height: 100%;
    }
    
    /* CSS cho dropdown header */
    .dropdown-header {
        color: #333 !important;
        font-size: 13px !important;
        font-weight: normal !important;
        padding: 8px 16px !important;
        margin-bottom: 5px !important;
        border-bottom: 1px solid #e9ecef !important;
        background-color: #f8f9fa !important;
        text-transform: none !important;
        letter-spacing: normal !important;
    }
    
    .dropdown-header strong {
        color: #333 !important;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-white py-0 fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="/">
            <img src="/images/logo2.jpg" alt="Logo" style="width: 70px;">
        </a>

        <div class="order-lg-2 nav-btns d-flex">
            <form class="d-flex" role="search" style="width: 220px;" action="/sanpham" method="GET">
                <input class="form-control me-2" type="search" name="query" placeholder="Tìm sản phẩm"
                    aria-label="Search" required>
                <button class="btn btn-outline-dark" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <button type="button" class="btn icon-btn position-relative">
                <a href="/favorites" class="text-black"><i class="fa fa-heart"></i>
                    <?php 
                    if (isset($_SESSION['user_id'])) {
                        try {
                            $pdo = new PDO('mysql:host=localhost;dbname=project', 'root', '');
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $favoriteModel = new \App\Models\Favorite($pdo);
                            $favoriteCount = $favoriteModel->getFavoriteCount($_SESSION['user_id']);
                            if ($favoriteCount > 0): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge bg-danger favorite-badge"><?= $favoriteCount ?></span>
                            <?php endif;
                        } catch (Exception $e) {
                            // Nếu có lỗi, không hiển thị badge
                        }
                    }
                    ?>
                </a>
            </button>
            <button type="button" class="btn icon-btn position-relative">
                <a href="/giohang" class="text-black"><i class="fa fa-shopping-cart"></i>
                    <?php if (isset($_SESSION['cart_product_count']) && $_SESSION['cart_product_count'] > 0): ?>
                    <span
                        class="position-absolute top-0 start-100 translate-middle badge bg-primary cart-badge"><?= $_SESSION['cart_product_count'] ?></span>
                <?php endif; ?>
                </a>
            </button>
            <button type="button" class="btn icon-btn position-relative">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Hiển thị ảnh đại diện nếu người dùng đã đăng nhập -->
                    <a href="/hoso" class="text-black position-relative" id="avatar">
                        <img src="<?= $_SESSION['avatar'] ?? '/images/avatar.jpg' ?>" alt="User Avatar"
                            style="width: 30px; height: 30px; border-radius: 50%;">
                    </a>

                    <!-- Modal thông tin khách hàng - Thiết kế tối giản -->
                    <div class="modal-overlay" id="modal-overlay"></div>
                    <div class="user-info-modal" id="user-info-modal">
                        <div class="user-greeting">
                            Hi, <?= htmlspecialchars($_SESSION['username'] ?? 'Người dùng') ?>
                        </div>
                        
                        <a href="/hoso" class="menu-item">Hồ sơ</a>
                        <a href="/showallorders" class="menu-item">Đơn hàng</a>
                        <a href="/favorites" class="menu-item">Yêu thích</a>
                        <a href="/logout" class="logout-btn">Đăng xuất</a>
                    </div>
                <?php else: ?>
                    <a href="/dangnhap" class="text-black"><i class="fa fa-user"></i></a>
                <?php endif; ?>
            </button>
        </div>

        <button class="navbar-toggler border-0 order-lg-1" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/sanpham" id="productDropdown" role="button"
                        aria-expanded="false">
                        SẢN PHẨM
                    </a>
                    <ul class="dropdown-menu multi-column columns-1 sanpham-style">
                        <div class="row w-100">
                            <!-- Cột 1: Xi măng giả gỗ -->
                            <div class="col-sm-4">
                                <ul class="multi-column-dropdown">
                                    <li class="dropdown-header"><strong>Xi măng giả gỗ</strong></li>
                                    <?php if (is_array($ximangCategories) && !empty($ximangCategories)): ?>
                                        <?php 
                                        $knownXimangOrder = ['thanhlath', 'lapsiding', 'array', 'deck', 'mould', 'plank'];
                                        usort($ximangCategories, function($a, $b) use ($knownXimangOrder) {
                                            $posA = array_search($a['slug'], $knownXimangOrder);
                                            $posB = array_search($b['slug'], $knownXimangOrder);
                                            
                                            if ($posA !== false && $posB !== false) {
                                                return $posA - $posB;
                                            }
                                            if ($posA !== false) return -1;
                                            if ($posB !== false) return 1;
                                            // Danh mục mới: sắp xếp theo ID (tạo trước lên trên)
                                            return $a['category_id'] - $b['category_id'];
                                        });
                                        
                                        foreach ($ximangCategories as $category): ?>
                                        <li><a href="<?= getCategoryUrl($category['slug']) ?>"><?= htmlspecialchars($category['category_name']) ?></a></li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <!-- Cột 2: Nội thất chính -->
                            <div class="col-sm-4">
                                <ul class="multi-column-dropdown">
                                    <li class="dropdown-header"><strong>Nội thất</strong></li>
                                    <?php if (!empty($mainNoithatCategories)): ?>
                                        <?php foreach ($mainNoithatCategories as $category): ?>
                                        <li><a href="<?= getCategoryUrl($category['slug']) ?>"><?= htmlspecialchars($category['category_name']) ?></a></li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <!-- Cột 3: Nội thất phụ -->
                            <div class="col-sm-4">
                                <ul class="multi-column-dropdown">
                                    <li style="height: 40px;"></li>
                                    <?php if (!empty($subNoithatCategories)): ?>
                                        <?php foreach ($subNoithatCategories as $category): ?>
                                        <li><a href="<?= getCategoryUrl($category['slug']) ?>"><?= htmlspecialchars($category['category_name']) ?></a></li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/bosuutap" id="productDropdown" role="button"
                        aria-expanded="false">
                        HẠNG MỤC
                    </a>
                    <ul class="dropdown-menu hangmuc-style" aria-labelledby="roomDropdown">
                        <li><a href="/tran">Trần</a></li>
                        <li><a href="/lam">Lam</a></li>
                        <li><a href="/san">Sàn</a></li>
                        <li><a href="/vach">Vách</a></li>
                        <li><a href="/cua">Cửa</a></li>
                        <li><a href="/cauthang">Cầu thang</a></li>
                        <li><a href="/hangrao">Hàng rào</a></li>
                        <li><a href="/bonhoa">Bồn hoa, bàn, ghế</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="/tintuc">TIN TỨC</a></li>
                <li class="nav-item"><a class="nav-link" href="/khac">KHÁC</a></li>
                <li class="nav-item"><a class="nav-link" href="/lienhe">LIÊN HỆ CHÚNG TÔI</a></li>
            </ul>
        </div>
    </div>
</nav>

<script>
    // Cải thiện xử lý modal thông tin khách hàng
    document.addEventListener('DOMContentLoaded', function() {
        // Đảm bảo link SẢN PHẨM hoạt động
        const productLink = document.getElementById('productDropdown');
        if (productLink) {
            // Thêm event listener cho click
            productLink.addEventListener('click', function(e) {
                // Nếu không phải mobile và không có dropdown menu hiển thị, cho phép chuyển hướng
                if (window.innerWidth > 768) {
                    const dropdownMenu = this.nextElementSibling;
                    if (!dropdownMenu || !dropdownMenu.classList.contains('show')) {
                        console.log('Navigating to /sanpham');
                        window.location.href = '/sanpham';
                    }
                }
            });
            
            // Đảm bảo href hoạt động
            productLink.style.pointerEvents = 'auto';
            productLink.style.cursor = 'pointer';
        }
        
        // Đảm bảo tất cả các link trong navbar hoạt động
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        navLinks.forEach(link => {
            link.style.pointerEvents = 'auto';
            link.style.cursor = 'pointer';
        });
        
        // Đảm bảo dropdown items hoạt động
        const dropdownItems = document.querySelectorAll('.dropdown-item');
        dropdownItems.forEach(item => {
            item.style.pointerEvents = 'auto';
            item.style.cursor = 'pointer';
        });
        const avatar = document.getElementById('avatar');
        const modal = document.getElementById('user-info-modal');
        const overlay = document.getElementById('modal-overlay');
        
        if (avatar && modal) {
            let isModalOpen = false;
            let timeoutId = null;

            // Hiển thị modal khi click vào avatar
            avatar.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                if (isModalOpen) {
                    hideModal();
                } else {
                    showModal();
                }
            });

            // Hiển thị modal khi hover (desktop)
            avatar.addEventListener('mouseenter', function() {
                if (window.innerWidth > 768) {
                    clearTimeout(timeoutId);
                    showModal();
                }
            });

            // Ẩn modal khi rời khỏi (desktop)
            avatar.addEventListener('mouseleave', function() {
                if (window.innerWidth > 768) {
                    timeoutId = setTimeout(hideModal, 200);
                }
            });

            modal.addEventListener('mouseenter', function() {
                if (window.innerWidth > 768) {
                    clearTimeout(timeoutId);
                }
            });

            modal.addEventListener('mouseleave', function() {
                if (window.innerWidth > 768) {
                    timeoutId = setTimeout(hideModal, 200);
                }
            });

            // Tắt modal khi click ra ngoài hoặc click overlay
            document.addEventListener('click', function(event) {
                if (!avatar.contains(event.target) && !modal.contains(event.target)) {
                    hideModal();
                }
            });

            // Tắt modal khi click overlay
            if (overlay) {
                overlay.addEventListener('click', function() {
                    hideModal();
                });
            }

            // Tắt modal khi nhấn ESC
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && isModalOpen) {
                    hideModal();
                }
            });

            function showModal() {
                if (window.innerWidth <= 768 && overlay) {
                    overlay.style.display = 'block';
                }
                modal.style.display = 'block';
                modal.style.opacity = '0';
                setTimeout(() => {
                    modal.style.opacity = '1';
                }, 10);
                isModalOpen = true;
            }

            function hideModal() {
                modal.style.opacity = '0';
                setTimeout(() => {
                    modal.style.display = 'none';
                    if (overlay) {
                        overlay.style.display = 'none';
                    }
                }, 200);
                isModalOpen = false;
            }

            // Xử lý responsive
            window.addEventListener('resize', function() {
                if (window.innerWidth <= 768 && isModalOpen) {
                    hideModal();
                }
            });
        }
    });
</script>