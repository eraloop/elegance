<div>
    @section('title', 'Testimonials Management')

    <x-admin.ui.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h5 class="mb-0 font-weight-bold text-primary">Client Testimonials</h5>
                <x-admin.ui.button wire:click="create" icon="fas fa-plus-circle" label="Add New Testimonial" />
            </div>
        </x-slot>

        <x-admin.ui.table :headers="['Client', 'Content', 'Rating', 'Actions']">
            @forelse($testimonials as $testimonial)
                <tr>
                    <td class="align-middle">
                        <div class="d-flex align-items-center">
                            @if($testimonial->customer_photo)
                                <img src="{{ asset('storage/' . $testimonial->customer_photo) }}"
                                    class="rounded-circle mr-3 shadow-sm" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <div class="rounded-circle mr-3 bg-light d-flex align-items-center justify-content-center shadow-sm"
                                    style="width: 40px; height: 40px;">
                                    <i class="fas fa-user text-muted"></i>
                                </div>
                            @endif
                            <div>
                                <div class="font-weight-bold text-dark">{{ $testimonial->name }}</div>
                                <small class="text-muted">{{ $testimonial->position }}</small>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle">
                        <small class="text-muted">{{ Str::limit($testimonial->content, 60) }}</small>
                    </td>
                    <td class="align-middle">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }} small"></i>
                        @endfor
                    </td>
                    <td class="align-middle text-right">
                        <button wire:click="edit({{ $testimonial->id }})"
                            class="admin-btn admin-btn-sm admin-btn-secondary mr-2" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button wire:click="confirmDelete({{ $testimonial->id }})"
                            class="admin-btn admin-btn-sm admin-btn-danger" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">No testimonials found.</td>
                </tr>
            @endforelse
        </x-admin.ui.table>
    </x-admin.ui.card>

    <!-- Create/Edit Modal -->
    <x-admin.ui.modal isOpen="{{ $isOpen }}"
        title="{{ $testimonialId ? 'Edit Testimonial' : 'Create New Testimonial' }}" onClose="closeModal"
        submitAction="store" submitLabel="{{ $testimonialId ? 'Update' : 'Create' }}">
        <div class="row">
            <div class="col-md-6">
                <x-admin.ui.input label="Client Name" name="customer_name" placeholder="e.g. Jane Doe" />
            </div>
            <div class="col-md-6">
                <x-admin.ui.input label="Role/Title" name="position" placeholder="e.g. Regular Customer" />
            </div>
        </div>

        <x-admin.ui.textarea label="Review Content" name="content" placeholder="Enter testimonial text" rows="3" />

        <div class="row">
            <div class="col-md-6">
                <div class="admin-form-group">
                    <label class="admin-label">Rating (1-5)</label>
                    <select wire:model="rating" class="admin-select">
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="2">2 Stars</option>
                        <option value="1">1 Star</option>
                    </select>
                    @error('rating') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="admin-form-group">
                    <label class="admin-label">Client Photo</label>
                    <div class="custom-file mb-2">
                        <input wire:model="new_image" type="file" class="custom-file-input" id="clientImage">
                        <label class="custom-file-label" for="clientImage">Choose file</label>
                    </div>
                    @if ($new_image)
                        <img src="{{ $new_image->temporaryUrl() }}" class="rounded-circle shadow-sm"
                            style="width: 50px; height: 50px; object-fit: cover;">
                    @elseif($customer_photo)
                        <img src="{{ asset('storage/' . $customer_photo) }}" class="rounded-circle shadow-sm"
                            style="width: 50px; height: 50px; object-fit: cover;">
                    @endif
                    @error('new_image') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
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
            <p class="text-muted mb-4">You won't be able to revert this! This testimonial will be permanently deleted.
            </p>
            <div class="d-flex justify-content-center">
                <button wire:click="closeDeleteModal" class="admin-btn admin-btn-secondary mr-3 px-4">Cancel</button>
                <button wire:click="delete" class="admin-btn admin-btn-danger px-4">Yes, Delete it!</button>
            </div>
        </div>
    </x-admin.ui.modal>
</div>