<?php
include_once __DIR__ . '/../partials/headerAdmin.php';
?>

<body>
    <?php
    require_once __DIR__ . "/../partials/headingAdmin.php";
    require_once __DIR__ . "/../partials/sidebar.php";
    ?>

    <div class="container-fluid mt-4" id="main-content">
        <div class="row">
            <div class="col-12">
                <!-- Modern Header -->
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div>
                        <h1 class="display-6 fw-bold text-gradient mb-2">
                            <i class="fas fa-cogs me-3"></i>Quản lý Hạng mục
                        </h1>
                        <p class="text-muted fs-5 mb-0">Cập nhật nội dung và hình ảnh cho các trang hạng mục</p>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Quản lý Hạng mục</h4>
                        <p class="card-subtitle">Cập nhật nội dung và hình ảnh cho các trang hạng mục</p>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['success_message'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['success_message']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php unset($_SESSION['success_message']); ?>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['error_message'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['error_message']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php unset($_SESSION['error_message']); ?>
                        <?php endif; ?>

                        <div class="row">
                            <?php if (isset($hangmucPages) && !empty($hangmucPages)): ?>
                                <?php foreach ($hangmucPages as $page): ?>
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo htmlspecialchars($page['title']); ?></h5>
                                                <p class="card-text text-muted"><?php echo htmlspecialchars($page['description']); ?></p>
                                                
                                                <?php if ($page['image_path']): ?>
                                                    <img src="<?php echo htmlspecialchars($page['image_path']); ?>" 
                                                         class="img-fluid mb-3" 
                                                         alt="<?php echo htmlspecialchars($page['title']); ?>"
                                                         style="max-height: 150px; object-fit: cover;">
                                                <?php endif; ?>
                                                
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="badge bg-primary"><?php echo htmlspecialchars($page['slug']); ?></span>
                                                    <button class="btn btn-sm btn-outline-primary" 
                                                            onclick="editHangmuc(<?php echo $page['id']; ?>)">
                                                        <i class="fa fa-edit"></i> Chỉnh sửa
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-cogs fa-3x mb-3"></i>
                                            <h5>Chưa có trang hạng mục nào</h5>
                                            <p>Dữ liệu sẽ được hiển thị sau khi tạo bảng hangmuc_pages</p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editHangmucModal" tabindex="-1" aria-labelledby="editHangmucModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editHangmucModalLabel">Chỉnh sửa Hạng mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editHangmucForm" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="pageId" name="pageId">
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả ngắn</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="content" class="form-label">Nội dung</label>
                            <textarea class="form-control" id="content" name="content" rows="6"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình ảnh mới (tùy chọn)</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <div id="currentImage" class="mt-2"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/../partials/footAdmin.php'; ?>

    <script>
    function editHangmuc(pageId) {
        // Fetch page data
        fetch(`/admin/hangmuc/data/${pageId}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert('Có lỗi xảy ra: ' + data.error);
                    return;
                }
                
                // Populate form
                document.getElementById('pageId').value = data.id;
                document.getElementById('title').value = data.title || '';
                document.getElementById('description').value = data.description || '';
                document.getElementById('content').value = data.content || '';
                
                // Show current image if exists
                const currentImageDiv = document.getElementById('currentImage');
                if (data.image_path) {
                    currentImageDiv.innerHTML = `
                        <p class="text-muted">Hình ảnh hiện tại:</p>
                        <img src="${data.image_path}" class="img-thumbnail" style="max-height: 100px;">
                    `;
                } else {
                    currentImageDiv.innerHTML = '<p class="text-muted">Chưa có hình ảnh</p>';
                }
                
                // Update form action
                document.getElementById('editHangmucForm').action = `/admin/hangmuc/update/${pageId}`;
                
                // Show modal
                $('#editHangmucModal').modal('show');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi tải dữ liệu');
            });
    }

    // Handle form submission
    document.getElementById('editHangmucForm').addEventListener('submit', function(e) {
        const formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
            } else {
                return response.text();
            }
        })
        .then(data => {
            if (data) {
                console.log('Response:', data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi cập nhật');
        });
    });
    </script>

    <style>
        .text-gradient {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</body>
</html>
