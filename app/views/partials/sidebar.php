<!-- Sidebar -->
<div class="sidebar" id="mySidebar">
    <div class="side-header">
        <div class="logo-container">
            <img src="/images/admin/logo.png" width="60" height="60" alt="Đại Quân Decor" class="logo-img">
            <div class="logo-text">
                <h5 class="mb-0 fw-bold" style="color:#222;">Admin Panel</h5>
                <small style="color:#666;">Đại Quân</small>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <div class="menu-section">
            <h6 class="menu-title" style="color:#888;">DASHBOARD</h6>
            <a href="/admin" class="menu-item">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </div>
        <div class="menu-section">
            <h6 class="menu-title" style="color:#888;">QUẢN LÝ</h6>
            <a href="/admin/viewCustomer" class="menu-item">
                <i class="fa fa-users"></i>
                <span>Khách hàng</span>
                <?php if (!empty($countNewCustomers)): ?>
                    <span class="badge badge-notify ms-auto"><?php echo $countNewCustomers; ?></span>
                <?php endif; ?>
            </a>
            <a href="/admin/viewProducts" class="menu-item">
                <i class="fa fa-th-large"></i>
                <span>Sản phẩm</span>
                <?php if (!empty($countNewProducts)): ?>
                    <span class="badge badge-notify ms-auto"><?php echo $countNewProducts; ?></span>
                <?php endif; ?>
            </a>
            <a href="/admin/viewCategory" class="menu-item">
                <i class="fa fa-th"></i>
                <span>Hạng mục</span>
                <?php if (!empty($countNewCategories)): ?>
                    <span class="badge badge-notify ms-auto"><?php echo $countNewCategories; ?></span>
                <?php endif; ?>
            </a>
            <a href="/admin/viewOrders" class="menu-item">
                <i class="fa fa-shopping-cart"></i>
                <span>Đơn hàng</span>
                <?php if (!empty($countNewOrders)): ?>
                    <span class="badge badge-notify ms-auto"><?php echo $countNewOrders; ?></span>
                <?php endif; ?>
            </a>
            <a href="/admin/contacts" class="menu-item">
                <i class="fa fa-envelope"></i>
                <span>Liên hệ</span>
                <?php if (!empty($countNewContacts)): ?>
                    <span class="badge badge-notify ms-auto"><?php echo $countNewContacts; ?></span>
                <?php endif; ?>
            </a>
        </div>
        <div class="menu-section">
            <h6 class="menu-title" style="color:#888;">HỆ THỐNG</h6>
            <a href="/logout" class="menu-item" style="color:#c0392b;">
                <i class="fa fa-sign-out"></i>
                <span>Đăng xuất</span>
            </a>
        </div>
    </div>
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
        <i class="fa fa-times"></i>
    </a>
</div>
<span id="main">
    <button class="openbtn" onclick="openNav()">
        <i class="fa fa-bars"></i>
    </button>
</span>
<style>
body.has-sidebar {
    overflow: hidden;
}
.sidebar {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1000;
    top: 0;
    left: 0;
    background: #fff;
    border-right: 1px solid #eee;
    overflow-x: hidden;
    transition: width 0.4s cubic-bezier(.77,0,.18,1);
    box-shadow: 2px 0 10px rgba(0,0,0,0.04);
}
.sidebar.open {
    width: 320px;
}
#main {
    transition: margin-left 0.4s cubic-bezier(.77,0,.18,1);
    margin-left: 0;
}
body.has-sidebar #main {
    margin-left: 320px;
}
@media (max-width: 900px) {
    .sidebar.open {
        width: 90vw;
        min-width: 220px;
        max-width: 100vw;
    }
    body.has-sidebar #main {
        margin-left: 0;
        filter: blur(2px);
    }
}
.side-header {
    padding: 30px 20px;
    border-bottom: 1px solid #eee;
    background: #fafbfc;
}
.logo-container {
    display: flex;
    align-items: center;
    gap: 15px;
}
.logo-img {
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.08);
}
.logo-text h5 {
    color: #222;
    font-size: 1.1rem;
    margin: 0;
}
.logo-text small {
    color: #666;
    font-size: 0.8rem;
}
.sidebar-menu {
    padding: 20px 0;
}
.menu-section {
    margin-bottom: 30px;
}
.menu-title {
    color: #888;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 0 25px;
    margin-bottom: 15px;
}
.menu-item {
    display: flex;
    align-items: center;
    padding: 12px 25px;
    color: #222;
    text-decoration: none;
    transition: all 0.2s;
    position: relative;
    font-size: 1rem;
    font-weight: 500;
    border-radius: 8px;
    background: none;
}
.menu-item:hover, .menu-item.active {
    background: #f3f4f6;
    color: #111;
    text-decoration: none;
}
.menu-item i {
    width: 20px;
    margin-right: 12px;
    font-size: 1.1rem;
    color: #444;
}
.menu-item span {
    flex: 1;
}
.badge-notify {
    background: #e74c3c;
    color: #fff;
    font-size: 0.8rem;
    padding: 4px 10px;
    border-radius: 12px;
    font-weight: 600;
}
.closebtn {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 20px;
    color: #888;
    text-decoration: none;
    transition: all 0.2s;
}
.closebtn:hover {
    color: #e74c3c;
    transform: scale(1.1);
}
.openbtn {
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1100;
    font-size: 22px;
    cursor: pointer;
    background: #fff;
    color: #222;
    padding: 10px 14px;
    border: 1px solid #eee;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    transition: all 0.2s;
}
.openbtn:hover {
    background: #f3f4f6;
    color: #111;
}
</style>
<script>
function openNav() {
    document.getElementById("mySidebar").classList.add("open");
    document.body.classList.add("has-sidebar");
}
function closeNav() {
    document.getElementById("mySidebar").classList.remove("open");
    document.body.classList.remove("has-sidebar");
}
window.addEventListener('click', function(e) {
    var sidebar = document.getElementById('mySidebar');
    if (sidebar.classList.contains('open')) {
        if (!sidebar.contains(e.target) && !e.target.closest('.openbtn')) {
            closeNav();
        }
    }
});
</script>