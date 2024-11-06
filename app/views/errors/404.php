<?php
include_once __DIR__ . '/../partials/header.php';
?>

<body>
    <!-- Navbar -->
    <div class="container mb-4"> <?php include_once __DIR__ . '/../partials/navbar.php'; ?></div>


    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center py-3 px-1">
                        <h1>Page Not Found</h1>
                        <div class="text-muted my-3">
                            Sorry, an error has occured.
                            The page you requested could not be found.
                        </div>
                        <div class="my-1">
                            <a href="/" class="btn btn-primary btn-lg me-1">
                                <i class="fa fa-home"></i> Quay về Trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Script-->
    <script src="/js/script.js"></script>
    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>