<div>
    @section('title', 'Services Management')

    <x-admin.ui.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h5 class="mb-0 font-weight-bold text-primary">All Services</h5>
                <x-admin.ui.button wire:click="create" icon="fas fa-plus-circle" label="Add New Service" />
            </div>
        </x-slot>

        <x-admin.ui.table :headers="['Thumbnail', 'Name', 'Category', 'Price', 'Duration', 'Actions']">
            @forelse($services as $service)
                <tr>
                    <td class="align-middle">
                        @if($service->thumbnail)
                            <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->name }}"
                                class="rounded shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center shadow-sm"
                                style="width: 50px; height: 50px;">
                                <i class="fas fa-image text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td class="align-middle">
                        <div class="font-weight-bold text-dark">{{ $service->name }}</div>
                        <small class="text-muted">{{ Str::limit($service->description, 50) }}</small>
                    </td>
                    <td class="align-middle">
                        <span class="admin-badge admin-badge-info">{{ $service->category->name ?? 'Uncategorized' }}</span>
                    </td>
                    <td class="align-middle font-weight-bold">
                        ${{ number_format($service->price_min, 2) }}
                        @if($service->price_max)
                            - ${{ number_format($service->price_max, 2) }}
                        @endif
                    </td>
                    <td class="align-middle">
                        {{ $service->duration_min }} mins
                    </td>
                    <td class="align-middle text-right">
                        <button wire:click="edit({{ $service->id }})"
                            class="admin-btn admin-btn-sm admin-btn-secondary mr-2" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button wire:click="confirmDelete({{ $service->id }})"
                            class="admin-btn admin-btn-sm admin-btn-danger" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No services found.</td>
                </tr>
            @endforelse
        </x-admin.ui.table>

        <div class="mt-4">
            {{ $services->links() }}
        </div>
    </x-admin.ui.card>

    <!-- Create/Edit Modal -->
    <x-admin.ui.modal isOpen="{{ $isOpen }}" title="{{ $serviceId ? 'Edit Service' : 'Create New Service' }}"
        onClose="closeModal" submitAction="store" submitLabel="{{ $serviceId ? 'Update' : 'Create' }}">

        <div class="row">
            <!-- Left Column: Main Information -->
            <div class="col-md-7 border-right pr-4">
                <h6 class="text-primary font-weight-bold mb-3">Basic Information</h6>

                <div class="row">
                    <div class="col-md-12">
                        <x-admin.ui.input label="Service Name" name="name" placeholder="e.g. Luxury Facial" required />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="admin-form-group">
                            <label for="category" class="admin-label">Category <span
                                    class="text-danger">*</span></label>
                            <select wire:model="category_id"
                                class="admin-select @error('category_id') is-invalid @enderror" id="category">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <x-admin.ui.textarea label="Description" name="description"
                            placeholder="Describe the service details..." rows="5" required />
                    </div>
                </div>
            </div>

            <!-- Right Column: Pricing & Details -->
            <div class="col-md-5 pl-4">
                <h6 class="text-primary font-weight-bold mb-3">Pricing & Duration</h6>

                <!-- Price Section -->
                <div class="bg-light p-3 rounded mb-3">
                    <label class="admin-label mb-2">Price Range ($)</label>
                    <div class="row">
                        <div class="col-6 pr-1">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-right-0 bg-white">$</span>
                                </div>
                                <input wire:model="price_min" type="number" step="0.01"
                                    class="form-control admin-input border-left-0" placeholder="Min">
                            </div>
                            @error('price_min') <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 pl-1">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-right-0 bg-white">$</span>
                                </div>
                                <input wire:model="price_max" type="number" step="0.01"
                                    class="form-control admin-input border-left-0" placeholder="Max">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Duration Section -->
                <div class="bg-light p-3 rounded mb-3">
                    <label class="admin-label mb-2">Duration (Minutes)</label>
                    <div class="row">
                        <div class="col-6 pr-1">
                            <div class="input-group input-group-sm">
                                <input wire:model="duration_min" type="number"
                                    class="form-control admin-input border-right-0" placeholder="Min">
                                <div class="input-group-append">
                                    <span class="input-group-text border-left-0 bg-white">m</span>
                                </div>
                            </div>
                            @error('duration_min') <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 pl-1">
                            <div class="input-group input-group-sm">
                                <input wire:model="duration_max" type="number"
                                    class="form-control admin-input border-right-0" placeholder="Max">
                                <div class="input-group-append">
                                    <span class="input-group-text border-left-0 bg-white">m</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Thumbnail Section -->
                <div class="mt-4">
                    <label class="admin-label">Service Thumbnail</label>
                    <div class="custom-file mb-3">
                        <input wire:model="newThumbnail" type="file" class="custom-file-input" id="thumbnail">
                        <label class="custom-file-label" for="thumbnail">Choose file</label>
                    </div>

                    <div class="text-center bg-light rounded p-2 border"
                        style="min-height: 100px; display: flex; align-items: center; justify-content: center;">
                        @if ($newThumbnail)
                            <img src="{{ $newThumbnail->temporaryUrl() }}" class="img-fluid rounded shadow-sm"
                                style="max-height: 150px;">
                        @elseif($thumbnail)
                            <img src="{{ asset('storage/' . $thumbnail) }}" class="img-fluid rounded shadow-sm"
                                style="max-height: 150px;">
                        @else
                            <div class="text-muted small">
                                <i class="fas fa-image fa-2x mb-2 d-block"></i>
                                No image selected
                            </div>
                        @endif
                    </div>
                    <div wire:loading wire:target="newThumbnail" class="text-center small text-primary mt-1">
                        Uploading...</div>
                    @error('newThumbnail') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
                </div>
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
            <p class="text-muted mb-4">You won't be able to revert this! This service will be permanently deleted.</p>
            <div class="d-flex justify-content-center">
                <button wire:click="closeDeleteModal" class="admin-btn admin-btn-secondary mr-3 px-4">Cancel</button>
                <button wire:click="delete" class="admin-btn admin-btn-danger px-4">Yes, Delete it!</button>
            </div>
        </div>
    </x-admin.ui.modal>
</div>