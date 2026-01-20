<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<?php use App\Models\BookModel; ?>
<?php $coverUrl = BookModel::getCoverUrl($book['cover_image'] ?? null, $book['title']); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-pencil"></i> Edit Book</h2>
    <a href="<?= base_url('admin/books') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Books
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('admin/books/update/' . $book['id']) ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="<?= old('title', $book['title']) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="author" class="form-label">Author *</label>
                        <input type="text" class="form-control" id="author" name="author" 
                               value="<?= old('author', $book['author']) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4"><?= old('description', $book['description']) ?></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input type="text" class="form-control" id="isbn" name="isbn" 
                                       value="<?= old('isbn', $book['isbn']) ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price *</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="price" name="price" 
                                           step="0.01" min="0" value="<?= old('price', $book['price']) ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="stock_quantity" class="form-label">Stock Quantity *</label>
                                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" 
                                       min="0" value="<?= old('stock_quantity', $book['stock_quantity']) ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Cover Image Section -->
                    <div class="card bg-light mb-3">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="bi bi-image me-2"></i>Book Cover Image</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="cover_image_url" class="form-label">Cover Image URL</label>
                                <input type="url" class="form-control" id="cover_image_url" name="cover_image" 
                                       placeholder="https://example.com/book-cover.jpg" 
                                       value="<?= old('cover_image', $book['cover_image'] ?? '') ?>">
                                <div class="form-text">Enter a direct URL to the book cover image. You can use Open Library covers: <code>https://covers.openlibrary.org/b/isbn/[ISBN]-L.jpg</code></div>
                            </div>
                            <div class="text-center text-muted small">
                                <span>— OR —</span>
                            </div>
                            <div class="mt-3">
                                <label for="cover_image_file" class="form-label">Upload New Cover Image</label>
                                <input type="file" class="form-control" id="cover_image_file" name="cover_image_file" 
                                       accept="image/jpeg,image/png,image/webp">
                                <div class="form-text">Accepted formats: JPG, PNG, WebP. Max size: 2MB. Leave empty to keep current image.</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Book
                        </button>
                        <a href="<?= base_url('admin/books') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Current Cover Preview -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-eye me-2"></i>Current Cover</h6>
            </div>
            <div class="card-body text-center">
                <div id="coverPreview" class="border rounded p-2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 250px; display: flex; align-items: center; justify-content: center;">
                    <img src="<?= $coverUrl ?>" 
                         style="max-width: 100%; max-height: 300px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);" 
                         onerror="this.parentElement.innerHTML='<div class=\'text-white\'><i class=\'bi bi-book display-4\'></i><p class=\'mt-2 mb-0 small\'>No cover available</p></div>';">
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Book Info</h6>
            </div>
            <div class="card-body">
                <small class="text-muted d-block mb-2">
                    <strong>Created:</strong><br>
                    <?= date('M d, Y H:i', strtotime($book['created_at'])) ?>
                </small>
                <small class="text-muted d-block">
                    <strong>Last Updated:</strong><br>
                    <?= date('M d, Y H:i', strtotime($book['updated_at'])) ?>
                </small>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlInput = document.getElementById('cover_image_url');
    const fileInput = document.getElementById('cover_image_file');
    const preview = document.getElementById('coverPreview');
    
    function showPreview(src) {
        preview.innerHTML = `<img src="${src}" style="max-width: 100%; max-height: 300px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">`;
    }
    
    urlInput.addEventListener('input', function() {
        if (this.value) {
            showPreview(this.value);
        }
    });
    
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                showPreview(e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>
<?= $this->endSection() ?>
