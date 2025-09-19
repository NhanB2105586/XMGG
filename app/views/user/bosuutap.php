<?php
include_once __DIR__ . '/../partials/header.php';
?>

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-3">
        <!-- Phần hình ảnh trên cùng -->
        <div class="top-banner-phongkhach">
            <div class="banner-text">
                Công trình đã thi công
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/bosuutap"> <strong class="current-page">Hạng mục</strong></a>
                </div>
            </div>
        </div>

        <!-- Sidebar danh mục sản phẩm -->
        <div class="row mt-4 nd">
            <div class="col-md-3">
                <div class="category-sidebar p-4 bg-light border rounded shadow-sm">
                    <h4 class="fw-bold mb-3">Đại Quân</h4>
                    <ul class="list-group">
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">2022</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">2023</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">2024</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">2025</a></li>
                        <!-- Thêm các mục khác nếu cần -->
                    </ul>
                </div>
            </div>

            <!-- Nội dung chính - Các sản phẩm -->
            <div class="col-md-9">
                
                <div class="row">
                    <?php if (!empty($hangmucPages)): ?>
                        <?php foreach ($hangmucPages as $hangmuc): ?>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                                    <a href="/<?php echo htmlspecialchars($hangmuc['slug']); ?>" class="text-decoration-none d-block">
                                        <?php if ($hangmuc['image_path']): ?>
                                            <img src="<?php echo htmlspecialchars($hangmuc['image_path']); ?>" 
                                                 alt="<?php echo htmlspecialchars($hangmuc['title']); ?>" 
                                                 class="img-fluid rounded">
                                        <?php else: ?>
                                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                                                <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                                        <?php endif; ?>
                                        
                                        <h6 class="mt-3 fw-bold text-dark">
                                            Những công trình mà Đại Quân đã thi công - Hạng mục <?php echo htmlspecialchars($hangmuc['title']); ?>
                                        </h6>
                                    </a>
                                    
                                    <!-- Description nằm bên ngoài link, màu rõ ràng hơn -->
                                    <div class="card-body p-3">
                                        <p class="text-dark mb-0" style="font-size: 0.95rem; line-height: 1.5;">
                                            <?php echo htmlspecialchars($hangmuc['description']); ?> [...]
                                        </p>
                                        <?php if (!empty($hangmuc['content'])): ?>
                                            <div class="content-preview mt-2">
                                                <p class="text-muted small">
                                                    <?php 
                                                    // Hiển thị 150 ký tự đầu của content
                                                    $content = strip_tags($hangmuc['content']);
                                                    echo htmlspecialchars(mb_substr($content, 0, 150)) . (mb_strlen($content) > 150 ? '...' : '');
                                                    ?>
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                        </div>
                    </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-boxes fa-4x mb-4"></i>
                                    <h4>Chưa có hạng mục nào</h4>
                                    <p class="mb-4">Hãy thêm hạng mục đầu tiên từ trang quản trị</p>
                        </div>
                    </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <style>
        .product-card {
            transition: all 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            background: white;
            border: 1px solid #e9ecef;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        
        .product-card a {
            color: inherit;
            text-decoration: none;
        }
        
        .product-card a:hover {
            color: inherit;
            text-decoration: none;
        }
        
        .product-card img {
            transition: transform 0.3s ease;
        }
        
        .product-card:hover img {
            transform: scale(1.05);
        }
        
        .card-body {
            background: white;
            border-top: 1px solid #f8f9fa;
        }
        
        .card-body p {
            color: #333 !important;
            font-weight: 500;
        }
    </style>
    
    <script>
        // Simple hover effects
        document.addEventListener('DOMContentLoaded', function() {
            const productCards = document.querySelectorAll('.product-card');
            
            productCards.forEach((card) => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.transition = 'transform 0.3s ease';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>

</html>
lam