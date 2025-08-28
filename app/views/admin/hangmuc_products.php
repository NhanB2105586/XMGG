<?php include_once __DIR__ . '/../partials/headerAdmin.php'; ?>

<style>
/* Fix text visibility issues */
.card {
    background-color: #ffffff !important;
    color: #333333 !important;
}

.card .card-title {
    color: #2c3e50 !important;
    font-weight: 600 !important;
}

.card .card-text {
    color: #34495e !important;
    font-weight: 400 !important;
}

.card .text-muted {
    color: #6c757d !important;
    font-weight: 500 !important;
}

.card small {
    color: #5a6c7d !important;
    font-weight: 500 !important;
}

.card-body {
    color: #333333 !important;
}

.btn {
    color: inherit !important;
}

.form-check-input {
    background-color: #007bff !important;
    border-color: #007bff !important;
}

.form-check-input:checked {
    background-color: #28a745 !important;
    border-color: #28a745 !important;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-1">
                            <i class="fas fa-boxes me-2"></i>
                            Quản lý sản phẩm - <?php echo htmlspecialchars($hangmucPage['title'] ?? $slug); ?>
                        </h4>
                        <p class="text-muted mb-0">Quản lý nội dung và hình ảnh cho các sản phẩm trong hạng mục</p>
                    </div>
                    <div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="fas fa-plus me-2"></i>Thêm sản phẩm
                        </button>
                        <a href="/admin/hangmuc" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php
                            $message = '';
                            switch ($_GET['success']) {
                                case 'created': $message = 'Sản phẩm đã được tạo thành công!'; break;
                                case 'updated': $message = 'Sản phẩm đã được cập nhật thành công!'; break;
                                case 'deleted': $message = 'Sản phẩm đã được xóa thành công!'; break;
                            }
                            echo $message;
                            ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php
                            $message = '';
                            switch ($_GET['error']) {
                                case 'create_failed': $message = 'Không thể tạo sản phẩm. Vui lòng thử lại!'; break;
                                case 'update_failed': $message = 'Không thể cập nhật sản phẩm. Vui lòng thử lại!'; break;
                                case 'delete_failed': $message = 'Không thể xóa sản phẩm. Vui lòng thử lại!'; break;
                                case 'product_not_found': $message = 'Không tìm thấy sản phẩm!'; break;
                            }
                            echo $message;
                            ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <div class="col-md-6 col-lg-4 mb-4" data-product-id="<?php echo $product['id']; ?>">
                                    <div class="card h-100">
                                        <div class="position-relative">
                                            <?php if ($product['image_path']): ?>
                                                <img src="<?php echo htmlspecialchars($product['image_path']); ?>" 
                                                     class="card-img-top" alt="<?php echo htmlspecialchars($product['title']); ?>"
                                                     style="height: 200px; object-fit: cover;">
                                            <?php else: ?>
                                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                                     style="height: 200px;">
                                                    <i class="fas fa-image fa-3x text-muted"></i>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div class="position-absolute top-0 end-0 p-2">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input toggle-active" type="checkbox" 
                                                           data-product-id="<?php echo $product['id']; ?>"
                                                           <?php echo $product['is_active'] ? 'checked' : ''; ?>>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card-body">
                                            <h6 class="card-title fw-bold"><?php echo htmlspecialchars($product['title']); ?></h6>
                                            <p class="card-text text-muted small">
                                                <?php echo htmlspecialchars(substr($product['description'], 0, 100)) . '...'; ?>
                                            </p>
                                            
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">
                                                    <i class="fas fa-sort me-1"></i>
                                                    Thứ tự: <?php echo $product['sort_order']; ?>
                                                </small>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-primary" 
                                                            onclick="editProduct(<?php echo $product['id']; ?>)"
                                                            title="Chỉnh sửa">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-outline-danger" 
                                                            onclick="deleteProduct(<?php echo $product['id']; ?>)"
                                                            title="Xóa">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
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
                                        <i class="fas fa-boxes fa-4x mb-4"></i>
                                        <h4>Chưa có sản phẩm nào</h4>
                                        <p class="mb-4">Bắt đầu bằng cách thêm sản phẩm đầu tiên</p>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                            <i class="fas fa-plus me-2"></i>Thêm sản phẩm đầu tiên
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

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus me-2"></i>Thêm sản phẩm mới
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/admin/hangmuc-products/create" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="hangmuc_slug" value="<?php echo htmlspecialchars($slug); ?>">
                    
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">Tiêu đề <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required
                               placeholder="Nhập tiêu đề sản phẩm...">
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Mô tả</label>
                        <textarea class="form-control" id="description" name="description" rows="4"
                                  placeholder="Mô tả chi tiết về sản phẩm..."></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Hình ảnh</label>
                        <input type="file" class="form-control" id="image" name="image" 
                               accept="image/*">
                        <div class="form-text">Hỗ trợ: JPG, PNG, GIF. Kích thước tối đa: 5MB</div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label fw-bold">Thứ tự hiển thị</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" 
                                       value="0" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                                    <label class="form-check-label fw-bold" for="is_active">
                                        Kích hoạt
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Lưu sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>Chỉnh sửa sản phẩm
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editProductForm" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_title" class="form-label fw-bold">Tiêu đề <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_title" name="title" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_description" class="form-label fw-bold">Mô tả</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="4"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_image" class="form-label fw-bold">Hình ảnh</label>
                        <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                        <div class="form-text">Để trống nếu không muốn thay đổi hình ảnh</div>
                        <div id="current_image" class="mt-2"></div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_sort_order" class="form-label fw-bold">Thứ tự hiển thị</label>
                                <input type="number" class="form-control" id="edit_sort_order" name="sort_order" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="edit_is_active" name="is_active">
                                    <label class="form-check-label fw-bold" for="edit_is_active">
                                        Kích hoạt
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Toggle active status
document.querySelectorAll('.toggle-active').forEach(toggle => {
    toggle.addEventListener('change', function() {
        const productId = this.dataset.productId;
        fetch(`/admin/hangmuc-products/toggle/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                this.checked = !this.checked; // Revert if failed
                alert('Có lỗi xảy ra khi cập nhật trạng thái');
            }
        })
        .catch(error => {
            this.checked = !this.checked; // Revert if failed
            alert('Có lỗi xảy ra khi cập nhật trạng thái');
        });
    });
});

// Edit product
function editProduct(productId) {
    console.log('Edit product called with ID:', productId);
    
    // Fetch product data from database via AJAX
    fetch(`/admin/hangmuc-products/get-product/${productId}`)
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            if (data.success) {
                const product = data.product;
                
                document.getElementById('edit_title').value = product.title;
                document.getElementById('edit_description').value = product.description;
                document.getElementById('edit_sort_order').value = product.sort_order;
                document.getElementById('edit_is_active').checked = product.is_active == 1;
                
                // Set form action
                document.getElementById('editProductForm').action = `/admin/hangmuc-products/update/${productId}`;
                
                // Show current image if exists
                if (product.image_path) {
                    document.getElementById('current_image').innerHTML = 
                        `<img src="${product.image_path}" class="img-thumbnail" style="max-height: 100px;">`;
                } else {
                    document.getElementById('current_image').innerHTML = '';
                }
                
                console.log('Opening modal...');
                new bootstrap.Modal(document.getElementById('editProductModal')).show();
            } else {
                console.error('API returned error:', data.error);
                alert('Không thể tải thông tin sản phẩm: ' + (data.error || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('Có lỗi xảy ra khi tải thông tin sản phẩm: ' + error.message);
        });
}

// Delete product
function deleteProduct(productId) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/hangmuc-products/delete/${productId}`;
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

<?php include_once __DIR__ . '/../partials/footerAdmin.php'; ?>
