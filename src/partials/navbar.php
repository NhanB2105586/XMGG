<div class="container sticky-top ">
  <div class="row">
    <div class="col-12">
      <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container-fluid">
          <!-- Menu 3 gạch và Logo -->
          <div class="d-flex align-items-center">
            <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Logo -->
            <a class="navbar-brand" href="/">
              <img src="/logo/logo.png" alt="Logo" style="height: 50px;">
            </a>
          </div>

          <!-- Navbar Links -->
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'sanpham.php') echo 'active'; ?>" href="/" id="productDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  SẢN PHẨM
                </a>
                <ul class="dropdown-menu multi-column columns-3">
                  <div class="row">
                    <div class="col-sm-4">
                      <ul class="multi-column-dropdown">
                        <li><a href="#">Sofa</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Ghế thư giãn</a></li>
                        <li><a href="#">Ghế ăn</a></li>
                        <li><a href="#">Ghế làm việc</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Kệ trưng bày</a></li>
                        <li><a href="#">Kệ phòng khách</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Giường ngủ</a></li>
                        <li><a href="#">Nệm</a></li>
                    </div>
                    <div class="col-sm-4">
                      <ul class="multi-column-dropdown">
                        <li><a href="#">Bàn nước</a></li>
                        <li><a href="#">Bàn ăn</a></li>
                        <li><a href="#">Bàn trang điểm</a></li>
                        <li><a href="#">Bàn làm việc </a></li>
                        <li class="divider"></li>
                        <li><a href="#">Tủ tivi</a></li>
                        <li><a href="#">Tủ giày</a></li>
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
                <a class="nav-link dropdown-toggle" href="#" id="roomDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  PHÒNG
                </a>
                <ul class="dropdown-menu multi-column columns-3">
                  <div class="row">
                    <div class="col-sm-4">
                      <ul class="multi-column-dropdown">
                        <li><a href="#">Phòng khách</a></li>
                        <li><a href="#">Phòng ăn</a></li>
                        <li><a href="#">Phòng ngủ</a></li>
                        <li><a href="#">Phòng làm việc</a></li>
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

            <!-- Search Bar -->
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Tìm sản phẩm" aria-label="Search">
              <button class="btn btn-outline-primary" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </form>

            <!-- Icons for Cart and User -->
            <ul class="navbar-nav ms-3">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="fas fa-shopping-cart"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="fas fa-user"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
</div>