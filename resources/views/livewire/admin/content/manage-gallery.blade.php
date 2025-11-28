<div>
    @section('title', 'Gallery Management')

    <x-admin.ui.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h5 class="mb-0 font-weight-bold text-primary">Gallery Images</h5>
                <x-admin.ui.button wire:click="create" icon="fas fa-plus-circle" label="Add New Image" />
            </div>
        </x-slot>

        <div class="row p-3">
            @forelse($images as $image)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 border-0 shadow-sm admin-card-hover">
                        <div class="position-relative">
                            @if($image->image_path)
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top rounded-top"
                                    style="height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center rounded-top"
                                    style="height: 200px;">
                                    <i class="fas fa-image text-muted fa-2x"></i>
                                </div>
                            @endif
                            <div class="position-absolute top-0 right-0 p-2">
                                <span class="admin-badge admin-badge-light shadow-sm">{{ $image->category }}</span>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <h6 class="font-weight-bold mb-1 text-dark">{{ $image->title }}</h6>
                            <div class="d-flex justify-content-between mt-3">
                                <button wire:click="edit({{ $image->id }})"
                                    class="admin-btn admin-btn-sm admin-btn-outline-primary flex-grow-1 mr-1">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button wire:click="confirmDelete({{ $image->id }})"
                                    class="admin-btn admin-btn-sm admin-btn-outline-danger flex-grow-1 ml-1">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No images found in gallery.</p>
                </div>
            @endforelse
        </div>
    </x-admin.ui.card>

    <!-- Create/Edit Modal -->
    <x-admin.ui.modal isOpen="{{ $isOpen }}" title="{{ $imageId ? 'Edit Image' : 'Add New Image' }}"
        onClose="closeModal" submitAction="store" submitLabel="{{ $imageId ? 'Update' : 'Add' }}">
        <x-admin.ui.input label="Image Title" name="title" placeholder="e.g. Modern Haircut" />

        <div class="admin-form-group">
            <label class="admin-label">Category</label>
            <select wire:model="category" class="admin-select">
                <option value="Haircuts">Haircuts</option>
                <option value="Coloring">Coloring</option>
                <option value="Styling">Styling</option>
                <option value="Manicure">Manicure</option>
                <option value="Pedicure">Pedicure</option>
                <option value="Facial">Facial</option>
            </select>
            @error('category') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
        </div>

        <div class="admin-form-group">
            <label class="admin-label">Image File</label>
            <div class="custom-file mb-2">
                <input wire:model="new_image_path" type="file" class="custom-file-input" id="galleryImage">
                <label class="custom-file-label" for="galleryImage">Choose file</label>
            </div>
            @if ($new_image_path)
                <img src="{{ $new_image_path->temporaryUrl() }}" class="img-fluid rounded mb-2 shadow-sm"
                    style="max-height: 200px;">
            @elseif($image_path)
                <img src="{{ asset('storage/' . $image_path) }}" class="img-fluid rounded mb-2 shadow-sm"
                    style="max-height: 200px;">
            @endif
            @error('new_image_path') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
        </div>
    </x-admin.ui.modal>

    <!-- Delete Confirmation Modal -->
    <x-admin.ui.modal isOpen="{{ $isDeleteOpen }}" title="Confirm Delete" onClose="closeDeleteModal">
        <div class="text-center p-3">
            <div class="mb-4">
                <i class="fas fa-exclamation-circle text-danger" style="font-size: 50px;"></i>
            </div>
            <h4 class="font-weight-bold mb-2">Are you sure?</h4>
            <p class="text-muted mb-4">You won't be able to revert this! This image will be permanently deleted.</p>
            <div class="d-flex justify-content-center">
                <button wire:click="closeDeleteModal" class="admin-btn admin-btn-secondary mr-3 px-4">Cancel</button>
                <button wire:click="delete" class="admin-btn admin-btn-danger px-4">Yes, Delete it!</button>
            </div>
        </div>
    </x-admin.ui.modal>
</div>