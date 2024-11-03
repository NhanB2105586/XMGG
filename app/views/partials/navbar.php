<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white py-1 fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="/">
            <img src="/images/logo.jpg" alt="Logo" style="width: 70px;">
        </a>

        <div class="order-lg-2 nav-btns d-flex">
            <form class="d-flex " role="search" style="width: 220px;">
                <input class="form-control me-2" type="search" placeholder="Tìm sản phẩm" aria-label="Search">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <button type="button" class="btn position-relative">
                <a href="/giohang" class="text-black"><i class="fa fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">5</span></a>

            </button>
            <button type="button" class="btn position-relative">
                <a href="/dangnhap"><i class="fa fa-user text-black"></i> </a></button>


        </div>

        <button class="navbar-toggler border-0 order-lg-1" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                        href="/sanpham" id="productDropdown" role="button"  aria-expanded="false">
                        SẢN PHẨM
                    </a>
                    <ul class="dropdown-menu multi-column columns-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="multi-column-dropdown">
                                    <li><a href="/sanpham/sofa">Sofa</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/sanpham/ghethugian">Ghế thư giãn</a></li>
                                    <li><a href="/sanpham/ghean">Ghế ăn</a></li>
                                    <li><a href="/sanpham/ghelamviec">Ghế làm việc</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Kệ phòng khách</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Giường ngủ</a></li>
                                    <li><a href="#">Nệm</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="multi-column-dropdown">
                                    <li><a href="#">Bàn nước</a></li>
                                    <li><a href="#">Bàn ăn</a></li>
                                    <li><a href="#">Bàn trang điểm</a></li>
                                    <li><a href="#">Bàn làm việc </a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Tủ tivi</a></li>
                                    <li><a href="#">Tủ bếp</a></li>
                                    <li><a href="#">Tủ ly </a></li>
                                    <li><a href="#">Tủ áo</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="multi-column-dropdown">
                                    <li><a href="#">Bình trang trí</a></li>
                                    <li><a href="#">Đèn trang trí</a></li>
                                    <li><a href="#">Đồng hồ</a></li>
                                    <li><a href="#">Gối</a></li>
                                    <li><a href="#">Thảm</a></li>
                                    <li><a href="#">Mền</a></li>
                                    <li><a href="#">Tranh</a></li>
                                    <li><a href="#">Khung gương</a></li>
                                    <li><a href="#">Khung hình</a></li>
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
                            <div class="col-sm-4">
                                <ul class="multi-column-dropdown">
                                    <li><a href="#">Tủ bếp</a></li>
                                    <li><a href="#">Hàng trang trí</a></li>
                                </ul>
                            </div>
                        </div>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">BỘ SƯU TẬP</a></li>
                <li class="nav-item"><a class="nav-link" href="#">LIÊN HỆ CHÚNG TÔI</a></li>
            </ul>


        </div>
    </div>
</nav>