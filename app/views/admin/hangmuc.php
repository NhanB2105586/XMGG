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
                    <div>
                        <button class="btn btn-primary btn-lg" onclick="createNewHangmuc()">
                            <i class="fas fa-plus me-2"></i>Tạo hạng mục mới
                        </button>
                    </div>
                </div>

                <!-- Alert Messages -->
                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <?php echo $_SESSION['success_message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?php echo $_SESSION['error_message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <!-- Main Content -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title mb-1">Danh sách Hạng mục</h4>
                                <p class="card-subtitle text-muted mb-0">Quản lý nội dung và hình ảnh cho các trang hạng mục</p>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="input-group" style="width: 300px;">
                                    <input type="text" class="form-control" id="searchHangmuc" placeholder="Tìm kiếm hạng mục...">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <?php if (isset($hangmucPages) && !empty($hangmucPages)): ?>
                                <?php foreach ($hangmucPages as $page): ?>
                                    <div class="col-md-6 col-lg-4 hangmuc-item" data-slug="<?php echo htmlspecialchars($page['slug']); ?>">
                                        <div class="card h-100 border-0 rounded-0 border-end border-bottom">
                                            <div class="card-body p-4">
                                                <!-- Image Preview -->
                                                <div class="image-preview mb-3">
                                                    <?php if ($page['image_path']): ?>
                                                        <img src="<?php echo htmlspecialchars($page['image_path']); ?>" 
                                                             class="img-fluid rounded shadow-sm" 
                                                             alt="<?php echo htmlspecialchars($page['title']); ?>"
                                                             style="width: 100%; height: 200px; object-fit: cover;">
                                                    <?php else: ?>
                                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                             style="width: 100%; height: 200px;">
                                                            <i class="fas fa-image fa-3x text-muted"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                
                                                <!-- Content -->
                                                <div class="content-preview">
                                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                                        <h5 class="card-title mb-1 fw-bold text-truncate" style="max-width: 200px;">
                                                            <?php echo htmlspecialchars($page['title']); ?>
                                                        </h5>
                                                        <span class="badge bg-primary fs-6"><?php echo htmlspecialchars($page['slug']); ?></span>
                                                    </div>
                                                    
                                                    <p class="card-text text-muted small mb-3" style="height: 60px; overflow: hidden;">
                                                        <?php echo htmlspecialchars($page['description'] ?: 'Chưa có mô tả'); ?>
                                                    </p>
                                                    
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">
                                                            <i class="fas fa-clock me-1"></i>
                                                            <?php echo date('d/m/Y', strtotime($page['updated_at'])); ?>
                                                        </small>
                                                        <div class="btn-group" role="group">
                                                            <button class="btn btn-sm btn-outline-primary" 
                                                                    onclick="editHangmuc(<?php echo $page['id']; ?>)"
                                                                    title="Chỉnh sửa">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-info" 
                                                                    onclick="previewHangmuc('<?php echo htmlspecialchars($page['slug']); ?>')"
                                                                    title="Xem trước">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <a href="/admin/hangmuc-products/<?php echo htmlspecialchars($page['slug']); ?>" 
                                                               class="btn btn-sm btn-outline-success"
                                                               title="Quản lý sản phẩm">
                                                                <i class="fas fa-boxes"></i>
                                                            </a>
                                                            <button class="btn btn-sm btn-outline-danger" 
                                                                    onclick="deleteHangmuc(<?php echo $page['id']; ?>, '<?php echo htmlspecialchars($page['title']); ?>')"
                                                                    title="Xóa hạng mục">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-cogs fa-4x mb-4"></i>
                                            <h4>Chưa có trang hạng mục nào</h4>
                                            <p class="mb-4">Dữ liệu sẽ được hiển thị sau khi tạo bảng hangmuc_pages</p>
                                            <button class="btn btn-primary" onclick="createNewHangmuc()">
                                                <i class="fas fa-plus me-2"></i>Tạo hạng mục đầu tiên
                                            </button>
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
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editHangmucModalLabel">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa Hạng mục
                    </h5>
                    <button type="button" class="btn-close btn-close-white" onclick="closeModal()" aria-label="Close"></button>
                </div>
                <form id="editHangmucForm" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="pageId" name="pageId">
                        
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Basic Information -->
                                <div class="mb-4">
                                    <h6 class="fw-bold mb-3">
                                        <i class="fas fa-info-circle me-2"></i>Thông tin cơ bản
                                    </h6>
                                    
                                    <div class="mb-3">
                                        <label for="title" class="form-label fw-bold">Tiêu đề <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" id="title" name="title" required
                                               placeholder="Nhập tiêu đề hạng mục...">
                                        <div class="form-text">Tiêu đề sẽ hiển thị trên trang web chính</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="description" class="form-label fw-bold">Mô tả ngắn</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"
                                                  placeholder="Mô tả ngắn gọn về hạng mục..."></textarea>
                                        <div class="form-text">Mô tả ngắn sẽ hiển thị trong danh sách</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="content" class="form-label fw-bold">Nội dung chi tiết <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="content" name="content" rows="8"
                                                  placeholder="Nội dung chi tiết về hạng mục..." required></textarea>
                                        <div class="form-text">Nội dung chi tiết sẽ hiển thị trên trang web chính</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <!-- Image Upload -->
                                <div class="mb-4">
                                    <h6 class="fw-bold mb-3">
                                        <i class="fas fa-image me-2"></i>Hình ảnh
                                    </h6>
                                    
                                    <div class="mb-3">
                                        <label for="image" class="form-label fw-bold">Chọn hình ảnh</label>
                                        <input type="file" class="form-control" id="image" name="image" 
                                               accept="image/*" onchange="previewImage(this)">
                                        <div class="form-text">Hỗ trợ: JPG, PNG, GIF (Max: 5MB)</div>
                                    </div>
                                    
                                    <div id="imagePreview" class="mb-3" style="display: none;">
                                        <label class="form-label fw-bold">Xem trước</label>
                                        <div class="border rounded p-2">
                                            <img id="previewImg" src="" alt="Preview" class="img-fluid rounded">
                                        </div>
                                    </div>
                                    
                                    <div id="currentImage" class="mb-3">
                                        <label class="form-label fw-bold">Hình ảnh hiện tại</label>
                                        <div class="border rounded p-2">
                                            <img id="currentImg" src="" alt="Current" class="img-fluid rounded">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Preview Section -->
                                <div class="mb-4">
                                    <h6 class="fw-bold mb-3">
                                        <i class="fas fa-eye me-2"></i>Xem trước
                                    </h6>
                                    <div class="border rounded p-3 bg-light">
                                        <h6 id="previewTitle" class="fw-bold mb-2">Tiêu đề</h6>
                                        <p id="previewDesc" class="text-muted small mb-2">Mô tả</p>
                                        <p id="previewContent" class="text-muted small">Nội dung</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" onclick="closeModal()">
                        <i class="fas fa-times me-2"></i>Hủy
                    </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div class="modal fade" id="previewHangmucModal" tabindex="-1" aria-labelledby="previewHangmucModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="previewHangmucModalLabel">
                        <i class="fas fa-eye me-2"></i>Xem trước trang hạng mục
                    </h5>
                    <button type="button" class="btn-close btn-close-white" onclick="closePreviewModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="previewContent">
                        <!-- Preview content will be loaded here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closePreviewModal()">Đóng</button>
                    <a id="viewLiveLink" href="#" target="_blank" class="btn btn-primary">
                        <i class="fas fa-external-link-alt me-2"></i>Xem trang thật
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Create New Hangmuc Modal -->
    <div class="modal fade" id="createHangmucModal" tabindex="-1" aria-labelledby="createHangmucModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="createHangmucModalLabel">
                        <i class="fas fa-plus me-2"></i>Tạo Hạng mục Mới
                    </h5>
                    <button type="button" class="btn-close btn-close-white" onclick="closeCreateModal()" aria-label="Close"></button>
                </div>
                <form id="createHangmucForm" method="POST" action="/admin/hangmuc/create" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Basic Information -->
                                <div class="mb-4">
                                    <h6 class="fw-bold mb-3">
                                        <i class="fas fa-info-circle me-2"></i>Thông tin cơ bản
                                    </h6>
                                    
                                    <div class="mb-3">
                                        <label for="create_title" class="form-label fw-bold">Tiêu đề <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" id="create_title" name="title" required
                                               placeholder="Nhập tiêu đề hạng mục...">
                                        <div class="form-text">Tiêu đề sẽ hiển thị trên trang web chính</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="create_slug" class="form-label fw-bold">Slug <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="create_slug" name="slug" required
                                               placeholder="nhap-slug-hang-muc">
                                        <div class="form-text">URL sẽ là: /nhap-slug-hang-muc</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="create_description" class="form-label fw-bold">Mô tả ngắn</label>
                                        <textarea class="form-control" id="create_description" name="description" rows="3"
                                                  placeholder="Mô tả ngắn gọn về hạng mục..."></textarea>
                                        <div class="form-text">Mô tả ngắn sẽ hiển thị trong danh sách</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="create_content" class="form-label fw-bold">Nội dung chi tiết <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="create_content" name="content" rows="8"
                                                  placeholder="Nội dung chi tiết về hạng mục..." required></textarea>
                                        <div class="form-text">Nội dung chi tiết sẽ hiển thị trên trang web chính</div>
                                    </div>
                                    
                                    <!-- Debug: Trường này phải hiển thị -->
                                    <div class="alert alert-info">
                                        <strong>Debug:</strong> Trường "Nội dung chi tiết" đã được thêm vào form!
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <!-- Image Upload -->
                                <div class="mb-4">
                                    <h6 class="fw-bold mb-3">
                                        <i class="fas fa-image me-2"></i>Hình ảnh
                                    </h6>
                                    
                                    <div class="mb-3">
                                        <label for="create_image" class="form-label fw-bold">Chọn hình ảnh</label>
                                        <input type="file" class="form-control" id="create_image" name="image" 
                                               accept="image/*" onchange="previewCreateImage(this)">
                                        <div class="form-text">Hỗ trợ: JPG, PNG, GIF (Max: 5MB)</div>
                                    </div>
                                    
                                    <div id="create_image_preview" class="text-center" style="display: none;">
                                        <img id="create_preview_img" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                    </div>
                                </div>
                                
                                <!-- Preview -->
                                <div class="mb-4">
                                    <h6 class="fw-bold mb-3">
                                        <i class="fas fa-eye me-2"></i>Xem trước
                                    </h6>
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 id="create_preview_title">Tiêu đề</h6>
                                            <p id="create_preview_description" class="text-muted small">Mô tả</p>
                                            <p class="text-muted small">URL: <span id="create_preview_url">/slug</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeCreateModal()">Hủy</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>Tạo hạng mục
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/../partials/footAdmin.php'; ?>

    <script>
    // Force reload to clear cache
    if (performance.navigation.type === 1) {
        console.log('Page reloaded - cache cleared');
    }
    
    // Search functionality
    document.getElementById('searchHangmuc').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const items = document.querySelectorAll('.hangmuc-item');
        
        items.forEach(item => {
            const title = item.querySelector('.card-title').textContent.toLowerCase();
            const slug = item.dataset.slug.toLowerCase();
            
            if (title.includes(searchTerm) || slug.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Edit hangmuc function
    function editHangmuc(pageId) {
        fetch(`/admin/hangmuc/data/${pageId}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert('Không tìm thấy dữ liệu hạng mục');
                    return;
                }
                
                // Fill form data
                document.getElementById('pageId').value = data.id;
                document.getElementById('title').value = data.title || '';
                document.getElementById('description').value = data.description || '';
                document.getElementById('content').value = data.content || '';
                
                // Update form action
                document.getElementById('editHangmucForm').action = `/admin/hangmuc/update/${data.id}`;
                
                // Show current image if exists
                const currentImg = document.getElementById('currentImg');
                const currentImageDiv = document.getElementById('currentImage');
                if (data.image_path) {
                    currentImg.src = data.image_path;
                    currentImageDiv.style.display = 'block';
                } else {
                    currentImageDiv.style.display = 'none';
                }
                
                // Update preview
                updatePreview();
                
                // Show modal using jQuery
                $('#editHangmucModal').modal('show');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi tải dữ liệu');
            });
    }

    // Preview image function
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }

    // Update preview function
    function updatePreview() {
        const title = document.getElementById('title').value;
        const description = document.getElementById('description').value;
        const content = document.getElementById('content').value;
        
        document.getElementById('previewTitle').textContent = title || 'Tiêu đề';
        document.getElementById('previewDesc').textContent = description || 'Mô tả';
        document.getElementById('previewContent').textContent = content || 'Nội dung';
    }

    // Add event listeners for preview updates
    document.getElementById('title').addEventListener('input', updatePreview);
    document.getElementById('description').addEventListener('input', updatePreview);
    document.getElementById('content').addEventListener('input', updatePreview);

    // Preview hangmuc function
    function previewHangmuc(slug) {
        const modalElement = document.getElementById('previewHangmucModal');
        const previewContent = document.getElementById('previewContent');
        const viewLiveLink = document.getElementById('viewLiveLink');
        
        // Set live link
        viewLiveLink.href = `/${slug}`;
        
        // Show loading
        previewContent.innerHTML = '<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x"></i><p class="mt-2">Đang tải...</p></div>';
        
        // Use jQuery to show modal
        $(modalElement).modal('show');
        
        // Load preview content (you can implement this later)
        setTimeout(() => {
            previewContent.innerHTML = `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Tính năng xem trước sẽ được cập nhật trong phiên bản tiếp theo.
                </div>
            `;
        }, 1000);
    }

    // Delete hangmuc function
    function deleteHangmuc(id, title) {
        if (confirm(`Bạn có chắc chắn muốn xóa hạng mục "${title}"?\n\nHành động này sẽ:\n- Xóa hạng mục khỏi database\n- Xóa tất cả sản phẩm liên quan\n- Xóa trang web tương ứng\n\nHành động này không thể hoàn tác!`)) {
            // Show loading
            const deleteBtn = event.target.closest('button');
            const originalHTML = deleteBtn.innerHTML;
            deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            deleteBtn.disabled = true;
            
            fetch(`/admin/hangmuc/delete/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove the item from DOM
                    const hangmucItem = deleteBtn.closest('.hangmuc-item');
                    if (hangmucItem) {
                        hangmucItem.remove();
                    }
                    
                    // Show success message
                    alert('Xóa hạng mục thành công!');
                    location.reload(); // Reload to update the list
                } else {
                    alert('Có lỗi xảy ra khi xóa hạng mục: ' + (data.error || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi xóa hạng mục');
            })
            .finally(() => {
                deleteBtn.innerHTML = originalHTML;
                deleteBtn.disabled = false;
            });
        }
    }

    // Create new hangmuc function
    function createNewHangmuc() {
        // Clear form
        document.getElementById('createHangmucForm').reset();
        document.getElementById('create_image_preview').style.display = 'none';
        updateCreatePreview();
        
        // Show modal
        $('#createHangmucModal').modal('show');
    }
    
    // Close create modal
    function closeCreateModal() {
        $('#createHangmucModal').modal('hide');
    }
    
    // Preview create image
    function previewCreateImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('create_preview_img').src = e.target.result;
                document.getElementById('create_image_preview').style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    // Update create preview
    function updateCreatePreview() {
        const title = document.getElementById('create_title').value || 'Tiêu đề';
        const description = document.getElementById('create_description').value || 'Mô tả';
        const slug = document.getElementById('create_slug').value || 'slug';
        
        document.getElementById('create_preview_title').textContent = title;
        document.getElementById('create_preview_description').textContent = description;
        document.getElementById('create_preview_url').textContent = '/' + slug;
    }

    // Handle form submission
    document.getElementById('editHangmucForm').addEventListener('submit', function(e) {
        const formData = new FormData(this);
        
        // Show loading
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang lưu...';
        submitBtn.disabled = true;
        
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
        })
        .finally(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });

    // Close modal functions
    function closeModal() {
        const modalElement = document.getElementById('editHangmucModal');
        if (modalElement) {
            // Use jQuery for better compatibility
            $(modalElement).modal('hide');
        }
    }

    function closePreviewModal() {
        const modalElement = document.getElementById('previewHangmucModal');
        if (modalElement) {
            $(modalElement).modal('hide');
        }
    }

    // Add event listeners for create form
    document.getElementById('create_title').addEventListener('input', updateCreatePreview);
    document.getElementById('create_description').addEventListener('input', updateCreatePreview);
    document.getElementById('create_slug').addEventListener('input', updateCreatePreview);
    
    // Handle create form submission
    document.getElementById('createHangmucForm').addEventListener('submit', function(e) {
        const formData = new FormData(this);
        
        // Show loading
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang tạo...';
        submitBtn.disabled = true;
        
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
            alert('Có lỗi xảy ra khi tạo hạng mục');
        })
        .finally(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });

    // Add event listeners for modal close buttons
    document.addEventListener('DOMContentLoaded', function() {
        // Close modal when clicking outside
        const editModal = document.getElementById('editHangmucModal');
        if (editModal) {
            editModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });
        }

        const previewModal = document.getElementById('previewHangmucModal');
        if (previewModal) {
            previewModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closePreviewModal();
                }
            });
        }
    });
    </script>

    <style>
        .text-gradient {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hangmuc-item:hover {
            transform: translateY(-2px);
            transition: transform 0.2s ease;
        }
        
        .card {
            transition: all 0.3s ease;
        }
        
        .card:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .image-preview img {
            transition: transform 0.3s ease;
        }
        
        .image-preview:hover img {
            transform: scale(1.05);
        }
        
        .btn-group .btn {
            border-radius: 0.375rem !important;
        }
        
        .btn-group .btn:first-child {
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }
        
        .btn-group .btn:last-child {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }
        
        /* Fix text contrast issues */
        .content-preview .card-title {
            color: #2c3e50 !important;
            font-weight: 600 !important;
        }
        
        .content-preview .card-text {
            color: #34495e !important;
            font-weight: 400 !important;
        }
        
        .content-preview small {
            color: #5a6c7d !important;
            font-weight: 500 !important;
        }
        
        /* Ensure card background is light */
        .card {
            background-color: #ffffff !important;
        }
        
        /* Improve badge visibility */
        .badge.bg-primary {
            background-color: #007bff !important;
            color: white !important;
        }
    </style>
</body>
</html>
