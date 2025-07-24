<!-- nav -->
<style>
@media (max-width: 686px) {

    .navbar-text,
    .navbar-nav a {
        display: none;
    }
}

.navbar-text.active {
    margin-left: 74px;
    transition: margin-left 0.3s ease;
}

.nav-admin {
    height: 90px;
}
</style>
<nav class="navbar navbar-expand-lg navbar-light px-5 nav-admin" style="background-color: #3B3131;">
    <a class="navbar-brand" href="/admin">
        <img src="/images/admin/logo.png" width="60" height="60" alt="Swiss Collection">
    </a>
    <span class="navbar-text text-white active" style="font-size: 28px;">QUẢN TRỊ ĐẠI QUÂN - XI MĂNG GIẢ GỖ</span>

    <ul class="navbar-nav flex-grow-1"></ul>

    <a href="/admin/logout" style="text-decoration:none;">
        <i class="fa fa-sign-out" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
    </a>
</nav>
</script>