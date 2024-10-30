<?php
include_once __DIR__ . '/../partials/header.php';
include_once __DIR__ . '/../../core/PDOFactory.php';
?>

<div id="warpper" class="nav-fixed">
    <nav class="topnav shadow navbar-light bg-white d-flex">
        <div class="navbar-brand"><a href="?">QUINHAN ADMIN</a></div>
        <div class="nav-right ">
            <div class="btn-group mr-auto">
                <button type="button" class="btn dropdown" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="plus-icon fas fa-plus-circle"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="?view=add-post">Thêm bài viết</a>
                    <a class="dropdown-item" href="?view=add-product">Thêm sản phẩm</a>
                    <a class="dropdown-item" href="?view=list-order">Thêm đơn hàng</a>
                </div>
            </div>
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    PHAN CƯƠNG
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Tài khoản</a>
                    <a class="dropdown-item" href="#">Thoát</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- end nav  -->
    <div id="page-body" class="d-flex">
        <div id="sidebar" class="bg-white">
            <ul id="sidebar-menu">
                <li class="nav-link">
                    <a href="?view=dashboard">
                        <div class="nav-link-icon d-inline-flex">
                            <i class="far fa-folder"></i>
                        </div>
                        Dashboard
                    </a>
                    <i class="arrow fas fa-angle-right"></i>
                </li>
                <li class="nav-link">
                    <a href="?view=list-post">
                        <div class="nav-link-icon d-inline-flex">
                            <i class="far fa-folder"></i>
                        </div>
                        Trang
                    </a>
                    <i class="arrow fas fa-angle-right"></i>

                    <ul class="sub-menu">
                        <li><a href="?view=add-post">Thêm mới</a></li>
                        <li><a href="?view=list-post">Danh sách</a></li>
                    </ul>
                </li>
                <li class="nav-link">
                    <a href="?view=list-post">
                        <div class="nav-link-icon d-inline-flex">
                            <i class="far fa-folder"></i>
                        </div>
                        Bài viết
                    </a>
                    <i class="arrow fas fa-angle-right"></i>
                    <ul class="sub-menu">
                        <li><a href="?view=add-post">Thêm mới</a></li>
                        <li><a href="?view=list-post">Danh sách</a></li>
                        <li><a href="?view=cat">Danh mục</a></li>
                    </ul>
                </li>
                <li class="nav-link active">
                    <a href="?view=list-product">
                        <div class="nav-link-icon d-inline-flex">
                            <i class="far fa-folder"></i>
                        </div>
                        Sản phẩm
                    </a>
                    <i class="arrow fas fa-angle-down"></i>
                    <ul class="sub-menu">
                        <li><a href="?view=add-product">Thêm mới</a></li>
                        <li><a href="?view=list-product">Danh sách</a></li>
                        <li><a href="?view=cat-product">Danh mục</a></li>
                    </ul>
                </li>
                <li class="nav-link">
                    <a href="?view=list-order">
                        <div class="nav-link-icon d-inline-flex">
                            <i class="far fa-folder"></i>
                        </div>
                        Bán hàng
                    </a>
                    <i class="arrow fas fa-angle-right"></i>
                    <ul class="sub-menu">
                        <li><a href="?view=list-order">Đơn hàng</a></li>
                    </ul>
                </li>
                <li class="nav-link">
                    <a href="?view=list-user">
                        <div class="nav-link-icon d-inline-flex">
                            <i class="far fa-folder"></i>
                        </div>
                        Users
                    </a>
                    <i class="arrow fas fa-angle-right"></i>

                    <ul class="sub-menu">
                        <li><a href="?view=add-user">Thêm mới</a></li>
                        <li><a href="?view=list-user">Danh sách</a></li>
                    </ul>
                </li>

                <!-- <li class="nav-link"><a>Bài viết</a>
                        <ul class="sub-menu">
                            <li><a>Thêm mới</a></li>
                            <li><a>Danh sách</a></li>
                            <li><a>Thêm danh mục</a></li>
                            <li><a>Danh sách danh mục</a></li>
                        </ul>
                    </li>
                    <li class="nav-link"><a>Sản phẩm</a></li>
                    <li class="nav-link"><a>Đơn hàng</a></li>
                    <li class="nav-link"><a>Hệ thống</a></li> -->

            </ul>
        </div>
    </div>


</div>
<?php
include_once __DIR__ . '/../partials/foot.php';
?>