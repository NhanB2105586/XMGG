<!-- navbar -->
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
                <a href="/giohang" class="text-black"><i class="fa fa-shopping-cart"></i>
                    <?php if (isset($_SESSION['cart_product_count'])): ?>
                    <span
                        class="position-absolute top-0 start-100 translate-middle badge bg-primary"><?= $_SESSION['cart_product_count'] ?></span>
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

                <!-- Modal nhỏ chứa thông tin người dùng -->
                <div class="user-info-modal" id="user-info-modal">
                    <p style="font-style: italic;">Hi, <?= htmlspecialchars($_SESSION['username'] ?? 'Người dùng') ?>
                    </p>
                    <p class="divider"></p>
                    <p><a href="/hoso" style="color:black; ">Hồ sơ của bạn</a></p>
                    <p class="divider"></p>
                    <p class="divider"></p>
                    <p><a href="/showallorders" style="color:black; ">Đơn mua</a></p>
                    <a href="/logout" class="btn btn-danger btn-sm mt-2"> <i class="fas fa-sign-out-alt"></i></a>
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
                    <ul class="dropdown-menu multi-column columns-3 sanpham-style">
                        <div class="row w-100">
                            <div class="col-sm-4">
                                <ul class="multi-column-dropdown">
                                    <li><a href="/phongkhach/sofa">Thanh diềm mái </a></li>
                                    <li class="divider"></li>
                                    <li><a href="/phonglamviec/ghelamviec">Thanh trang trí trần</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/phongkhach/kephongkhach">Thanh ốp tường G-Series</a></li>
                                    <li><a href="/phonglamviec/kesach">Thanh ốp trang trí tường</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/phongngu/giuongngu">Tấm ốp trang trí tường</a></li>
                                    <li><a href="/phongngu/nem">Thanh ốp tường Siding</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4 ms-5">
                                <ul class="multi-column-dropdown">
                                    <li><a href="/phongkhach/bannuoc">Tấm ốp trang trí tường</a></li>
                                    <li><a href="/phongan/banan">Thanh lát sàn</a></li>
                                    <li><a href="/phonglamviec/banlamviec">Thanh trang trí sàn </a></li>
                                    <li class="divider"></li>
                                    <li><a href="/phongkhach/tutivi">Thanh trang trí cầu thang</a></li>
                                    <li><a href="/phongan/tubep">Thanh hàng rào</a></li>
                                    <li><a href="/phongan/tuly">Thanh trang trí  </a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="roomDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    HẠNG MỤC
                    </a>
                    <ul class="dropdown-menu hangmuc-style" aria-labelledby="roomDropdown">
                        <li><a href="/tran">Trần</a></li>
                        <li><a href="/lam">Lam</a></li>
                        <li><a href="/san">Sàn</a></li>
                        <li><a href="/tuong">Tường</a></li>
                        <li><a href="/vach">Vách</a></li>
                        <li><a href="/cua">Cửa</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="/bosuutap">TIN TỨC</a></li>
                <li class="nav-item"><a class="nav-link" href="/bosuutap">KHÁC</a></li>
                <li class="nav-item"><a class="nav-link" href="/lienhe">LIÊN HỆ CHÚNG TÔI</a></li>
            </ul>


        </div>
    </div>
</nav>

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