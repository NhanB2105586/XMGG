<?php
?>
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white py-1 fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="/">
            <img src="/images/logo.jpg" alt="Logo" style="width: 70px;">
        </a>

        <div class="order-lg-2 nav-btns d-flex">
            <form class="d-flex" role="search" style="width: 220px;" action="/sanpham" method="GET">
                <input class="form-control me-2" type="search" name="query" placeholder="Tìm sản phẩm" aria-label="Search" required>
                <button class="btn btn-outline-dark" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <button type="button" class="btn icon-btn position-relative">
                <a href="/giohang" class="text-black"><i class="fa fa-shopping-cart"></i>
                    <?php if (isset($_SESSION['cart_product_count'])): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge bg-primary"><?= $_SESSION['cart_product_count'] ?></span>
                    <?php endif; ?>
                </a>
            </button>
            <button type="button" class="btn icon-btn position-relative">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Hiển thị ảnh đại diện nếu người dùng đã đăng nhập -->
                    <a href="/hoso" class="text-black position-relative" id="avatar">
                        <img src="<?= $_SESSION['avatar'] ?? '/images/avatar.jpg' ?>" alt="User Avatar" style="width: 30px; height: 30px; border-radius: 50%;">
                    </a>

                    <!-- Modal nhỏ chứa thông tin người dùng -->
                    <div class="user-info-modal" id="user-info-modal">
                        <p style="font-style: italic;">Hi, <?= htmlspecialchars($_SESSION['username'] ?? 'Người dùng') ?></p>
                        <p class="divider"></p>
                        <p><a href="/hoso" style="color:black; ">Hồ sơ của bạn</a></p>
                        <p class="divider"></p>
                        <p class="divider"></p>
                        <p><a href="/showallorders" style="color:black; ">Đơn mua</a></p>
                        <a href="/logout" class="btn btn-danger btn-sm mt-2"> <i class="fas fa-sign-out-alt"></i></a>
                    </div>
                <?php else: ?>
                    <!-- Hiển thị icon người dùng nếu chưa đăng nhập -->
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
                    <a class="nav-link dropdown-toggle"
                        href="/sanpham" id="productDropdown" role="button" aria-expanded="false">
                        SẢN PHẨM
                    </a>
                    <ul class="dropdown-menu multi-column columns-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="multi-column-dropdown">
                                    <li><a href="/phongkhach/sofa">Sofa</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/phongan/ghean">Ghế ăn</a></li>
                                    <li><a href="/phonglamviec/ghelamviec">Ghế làm việc</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/phongkhach/kephongkhach">Kệ phòng khách</a></li>
                                    <li><a href="/phonglamviec/kesach">Kệ sách</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/phongngu/giuongngu">Giường ngủ</a></li>
                                    <li><a href="/phongngu/nem">Nệm</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="multi-column-dropdown">
                                    <li><a href="/phongkhach/bannuoc">Bàn nước</a></li>
                                    <li><a href="/phongan/banan">Bàn ăn</a></li>
                                    <li><a href="/phonglamviec/banlamviec">Bàn làm việc </a></li>
                                    <li class="divider"></li>
                                    <li><a href="/phongkhach/tutivi">Tủ tivi</a></li>
                                    <li><a href="/phongan/tubep">Tủ bếp</a></li>
                                    <li><a href="/phongan/tuly">Tủ ly </a></li>
                                    <li><a href="/phongngu/tuao">Tủ áo</a></li>
                                </ul>
                            </div>  
                            <div class="col-sm-4">
                                <ul class="multi-column-dropdown">
                                    <li><a href="/phongngu/goi">Gối</a></li>
                                    <li><a href="/phongngu/men">Mền</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/hangtrangtri/binh">Bình trang trí</a></li>
                                    <li><a href="/hangtrangtri/den">Đèn trang trí</a></li>
                                    <li><a href="/hangtrangtri/tranh">Tranh</a></li>
                                </ul>
                            </div>
                        </div>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/phongkhach" id="roomDropdown" role="button"
                        aria-expanded="false">
                        PHÒNG
                    </a>
                    <ul class="dropdown-menu multi-column columns-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="multi-column-dropdown">
                                    <li><a href="/phongkhach">Phòng khách</a></li>
                                    <li><a href="/phongan">Phòng ăn</a></li>
                                    <li><a href="/phongngu">Phòng ngủ</a></li>
                                    <li><a href="/phonglamviec">Phòng làm việc</a></li>
                                </ul>
                            </div>
                        </div>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="/bosuutap">BỘ SƯU TẬP</a></li>
                <li class="nav-item"><a class="nav-link" href="/lienhe">LIÊN HỆ CHÚNG TÔI</a></li>
            </ul>


        </div>
    </div>
</nav>
<style>
    /* CSS cho modal nhỏ */
    .user-info-modal {
        display: none;
        position: absolute;
        top: 40px;
        left: -20px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        width: 200px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .user-info-modal p {
        margin: 5px 0;
    }

    /* Hiển thị modal khi hover vào avatar */
    #avatar:hover+.user-info-modal,
    .user-info-modal:hover {
        color: black;
        display: block;
    }
</style>
<script>
    // Tắt modal khi rê chuột ra ngoài
    document.addEventListener('click', function(event) {
        var avatar = document.getElementById('avatar');
        var modal = document.getElementById('user-info-modal');
        if (!avatar.contains(event.target) && !modal.contains(event.target)) {
            modal.style.display = 'none';
        }
    });

    // Hiển thị modal khi hover vào avatar
    document.getElementById('avatar').addEventListener('mouseenter', function() {
        document.getElementById('user-info-modal').style.display = 'block';
    });

    document.getElementById('user-info-modal').addEventListener('mouseleave', function() {
        document.getElementById('user-info-modal').style.display = 'none';
    });
</script>