<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Products</h2>
        <button wire:click="create" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add New Product
        </button>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search products..."
                        wire:model.live.debounce.300ms="search">
                </div>
                <div class="col-md-3">
                    <select class="form-select" wire:model.live="filterCategory">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4" style="width: 80px;">Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="ps-4">
                                    @if($product->cover_image)
                                        <img src="{{ Storage::url($product->cover_image) }}" class="rounded" width="50"
                                            height="50" style="object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted"
                                            style="width: 50px; height: 50px;">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-medium">
                                    {{ $product->name }}
                                    @if($product->is_featured)
                                        <span class="badge bg-info text-dark ms-1" style="font-size: 0.65rem;">Featured</span>
                                    @endif
                                </td>
                                <td class="text-muted">{{ $product->category->name ?? 'Uncategorized' }}</td>
                                <td>
                                    @if($product->sale_price)
                                        <span class="text-danger fw-bold">${{ number_format($product->sale_price, 2) }}</span>
                                        <small
                                            class="text-muted text-decoration-line-through ms-1">${{ number_format($product->price, 2) }}</small>
                                    @else
                                        <span class="fw-bold">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->in_stock)
                                        <span class="badge bg-success-subtle text-success">In Stock
                                            ({{ $product->stock_quantity }})</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger">Out of Stock</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <button wire:click="edit({{ $product->id }})"
                                        class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $product->id }})"
                                        class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-box-open fa-2x mb-3 d-block"></i>
                                    No products found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 py-3">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Create/Edit Modal -->
    @if($isOpen)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5); overflow-y: auto;"
            tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $productId ? 'Edit Product' : 'Create Product' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">Product Name</label>
                                        <input type="text" class="form-control" wire:model.live="name">
                                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Slug</label>
                                        <input type="text" class="form-control" wire:model="slug">
                                        @error('slug') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Short Description</label>
                                        <textarea class="form-control" wire:model="short_description" rows="2"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Full Description</label>
                                        <textarea class="form-control" wire:model="description" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <select class="form-select" wire:model="category_id">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id') <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Price ($)</label>
                                        <input type="number" step="0.01" class="form-control" wire:model="price">
                                        @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Sale Price ($)</label>
                                        <input type="number" step="0.01" class="form-control" wire:model="sale_price">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">SKU</label>
                                        <input type="text" class="form-control" wire:model="sku">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Stock Quantity</label>
                                        <input type="number" class="form-control" wire:model="stock_quantity">
                                    </div>
                                    <div class="card bg-light border-0 p-3">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" wire:model="in_stock"
                                                id="inStock">
                                            <label class="form-check-label" for="inStock">In Stock</label>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" wire:model="is_active"
                                                id="isActive">
                                            <label class="form-check-label" for="isActive">Active</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" wire:model="is_featured"
                                                id="isFeatured">
                                            <label class="form-check-label" for="isFeatured">Featured</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="form-label">Cover Image</label>
                                    <input type="file" class="form-control" wire:model="new_cover_image">
                                    @if($new_cover_image)
                                        <img src="{{ $new_cover_image->temporaryUrl() }}" class="mt-2 rounded" width="100">
                                    @elseif($cover_image)
                                        <img src="{{ Storage::url($cover_image) }}" class="mt-2 rounded" width="100">
                                    @endif
                                    @error('new_cover_image') <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Gallery Images</label>
                                    <input type="file" class="form-control" wire:model="gallery_images" multiple>
                                    <div class="d-flex flex-wrap gap-2 mt-2">
                                        @foreach($existing_gallery_images as $img)
                                            <div class="position-relative">
                                                <img src="{{ Storage::url($img->image_path) }}" class="rounded" width="60"
                                                    height="60" style="object-fit: cover;">
                                                <button type="button" wire:click="deleteImage({{ $img->id }})"
                                                    class="btn btn-danger btn-sm position-absolute top-0 start-100 translate-middle p-0 rounded-circle"
                                                    style="width: 20px; height: 20px; font-size: 10px;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('gallery_images.*') <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                        <button type="button" class="btn btn-primary" wire:click="store">Save Product</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if($isDeleteOpen)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="btn-close" wire:click="closeDeleteModal"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this product?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeDeleteModal">Cancel</button>
                        <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>