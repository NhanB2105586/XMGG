<?php
include_once __DIR__ . '/../src/partials/header.php';
?>

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../src/partials/navbar.php'; ?>

    <!-- Thêm CSS để phần nội dung chính chiếm 100% chiều ngang -->
    <style>
    .main-content {
        width: 100vw;
        /* Chiều rộng toàn màn hình */
        padding: 0;
        margin: 0;
    }
    </style>

    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-3">
        <!-- Nội dung của bạn sẽ nằm ở đây -->
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <img src="/images/slider/Home.png" class="d-block w-100 img-fluid" alt="Home Slide">
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                    <img src="/images/slider/Our Story.png" class="d-block w-100 img-fluid" alt="Story Slide">
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <img src="/images/slider/Our Collections.png" class="d-block w-100 img-fluid"
                        alt="Collections Slide">
                </div>

                <!-- Slide 4 -->
                <div class="carousel-item">
                    <img src="/images/slider/Our Clients.png" class="d-block w-100 img-fluid" alt="Clients Slide">
                </div>
                <!-- Slide 5 -->
                <div class="carousel-item">
                    <img src="/images/slider/Contact Details.png" class="d-block w-100 img-fluid" alt="Contact Slide">
                </div>
            </div>

            <!-- Controls (Previous/Next buttons) -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="row">
            <!-- Hình lớn đầu tiên -->
            <div class="col-lg-6 col-md-12 mb-4 mt-3">
                <div class="position-relative">
                    <img src="/images/White and Yellow Furniture Sale Instagram Post.png" class="img-fluid" alt="Sofa">
                </div>
            </div>

            <!-- Các hình nhỏ bên cạnh -->
            <div class="">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="position-relative">
                            <img src="/images/ban-an-grace-11.jpg" class="img-fluid" alt="Bàn Ăn">
                            <h3 class="position-absolute text-light" style="bottom: 10px; left: 20px;">BÀN ĂN</h3>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="position-relative">
                            <img src="/images/giuong.png" class="img-fluid" alt="Giường">
                            <h3 class="position-absolute text-light" style="bottom: 10px; left: 20px;">GIƯỜNG</h3>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="position-relative">
                            <img src="/images/tu-quan-ao-wddct05.jpg" class="img-fluid" alt="Arm Chair">
                            <h3 class="position-absolute text-light" style="bottom: 10px; left: 20px;">TỦ</h3>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="position-relative">
                            <img src="/images/ghe-an-hien-dai-ga22-5-.jpg" class="img-fluid" alt="Ghế Ăn">
                            <h3 class="position-absolute text-light" style="bottom: 10px; left: 20px;">GHẾ ĂN</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../src/partials/app.php'; ?>
    <?php include_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>

</html>