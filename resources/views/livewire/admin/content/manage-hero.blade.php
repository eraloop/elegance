<div>
    @section('title', 'Hero Slider Management')

    <x-admin.ui.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h5 class="mb-0 font-weight-bold text-primary">Hero Slides</h5>
                <x-admin.ui.button wire:click="create" icon="fas fa-plus-circle" label="Add New Slide" />
            </div>
        </x-slot>

        <x-admin.ui.table :headers="['Image', 'Title & Subtitle', 'Buttons', 'Actions']">
            @forelse($heroes as $hero)
                <tr>
                    <td class="align-middle">
                        @if($hero->image)
                            <img src="{{ asset('storage/' . $hero->image) }}" alt="Slide" class="rounded shadow-sm"
                                style="width: 100px; height: 60px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center shadow-sm"
                                style="width: 100px; height: 60px;">
                                <i class="fas fa-image text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td class="align-middle">
                        <div class="font-weight-bold text-dark">{{ $hero->title }}</div>
                        <small class="text-muted">{{ Str::limit($hero->subtitle, 50) }}</small>
                    </td>
                    <td class="align-middle">
                        @if($hero->button_text)
                            <span class="admin-badge admin-badge-primary">{{ $hero->button_text }}</span>
                        @endif
                        @if($hero->secondary_button_text)
                            <span class="admin-badge admin-badge-secondary">{{ $hero->secondary_button_text }}</span>
                        @endif
                    </td>
                    <td class="align-middle text-right">
                        <button wire:click="edit({{ $hero->id }})" class="admin-btn admin-btn-sm admin-btn-secondary mr-2"
                            title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button wire:click="confirmDelete({{ $hero->id }})" class="admin-btn admin-btn-sm admin-btn-danger"
                            title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">No slides found.</td>
                </tr>
            @endforelse
        </x-admin.ui.table>
    </x-admin.ui.card>

    <!-- Create/Edit Modal -->
    <x-admin.ui.modal isOpen="{{ $isOpen }}" title="{{ $heroId ? 'Edit Slide' : 'Create New Slide' }}"
        onClose="closeModal" submitAction="store" submitLabel="{{ $heroId ? 'Update' : 'Create' }}">
        <div class="admin-form-group">
            <label class="admin-label">Background Image</label>
            <div class="custom-file mb-3">
                <input wire:model="new_image" type="file" class="custom-file-input" id="heroImage">
                <label class="custom-file-label" for="heroImage">Choose file</label>
            </div>
            @if ($new_image)
                <img src="{{ $new_image->temporaryUrl() }}" class="img-fluid rounded mb-2 shadow-sm"
                    style="max-height: 200px;">
            @elseif($image)
                <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded mb-2 shadow-sm"
                    style="max-height: 200px;">
            @endif
            @error('new_image') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
        </div>

        <x-admin.ui.input label="Title" name="title" placeholder="Enter main title" />
        <x-admin.ui.textarea label="Subtitle" name="subtitle" placeholder="Enter subtitle" rows="2" />

        <div class="row">
            <div class="col-md-6">
                <x-admin.ui.input label="Primary Button Text" name="button_text" />
            </div>
            <div class="col-md-6">
                <x-admin.ui.input label="Primary Button Link" name="button_link" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <x-admin.ui.input label="Secondary Button Text" name="secondary_button_text" />
            </div>
            <div class="col-md-6">
                <x-admin.ui.input label="Secondary Button Link" name="secondary_button_link" />
            </div>
        </div>
    </x-admin.ui.modal>

    <!-- Delete Confirmation Modal -->
    <x-admin.ui.modal isOpen="{{ $isDeleteOpen }}" title="Confirm Delete" onClose="closeDeleteModal">
        <div class="text-center p-3">
            <div class="mb-4">
                <i class="fas fa-exclamation-circle text-danger" style="font-size: 50px;"></i>
            </div>
            <h4 class="font-weight-bold mb-2">Are you sure?</h4>
            <p class="text-muted mb-4">You won't be able to revert this! This slide will be permanently deleted.</p>
            <div class="d-flex justify-content-center">
                <button wire:click="closeDeleteModal" class="admin-btn admin-btn-secondary mr-3 px-4">Cancel</button>
                <button wire:click="delete" class="admin-btn admin-btn-danger px-4">Yes, Delete it!</button>
            </div>
        </div>
    </x-admin.ui.modal>
</div>