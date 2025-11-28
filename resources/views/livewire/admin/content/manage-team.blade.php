<div>
    @section('title', 'Team Management')

    <x-admin.ui.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h5 class="mb-0 font-weight-bold text-primary">Team Members</h5>
                <x-admin.ui.button wire:click="create" icon="fas fa-plus-circle" label="Add New Member" />
            </div>
        </x-slot>

        <x-admin.ui.table :headers="['Member', 'Bio', 'Social Links', 'Actions']">
            @forelse($teamMembers as $member)
                <tr>
                    <td class="align-middle">
                        <div class="d-flex align-items-center">
                            @if($member->image)
                                <img src="{{ asset('storage/' . $member->image) }}" class="rounded-circle mr-3 shadow-sm"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="rounded-circle mr-3 bg-light d-flex align-items-center justify-content-center shadow-sm"
                                    style="width: 50px; height: 50px;">
                                    <i class="fas fa-user text-muted"></i>
                                </div>
                            @endif
                            <div>
                                <div class="font-weight-bold text-dark">{{ $member->name }}</div>
                                <small class="text-muted">{{ $member->role }}</small>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle">
                        <small class="text-muted">{{ Str::limit($member->bio, 60) }}</small>
                    </td>
                    <td class="align-middle">
                        @if($member->facebook) <i class="fab fa-facebook text-primary mr-2"></i> @endif
                        @if($member->twitter) <i class="fab fa-twitter text-info mr-2"></i> @endif
                        @if($member->instagram) <i class="fab fa-instagram text-danger mr-2"></i> @endif
                        @if($member->linkedin) <i class="fab fa-linkedin text-primary"></i> @endif
                    </td>
                    <td class="align-middle text-right">
                        <button wire:click="edit({{ $member->id }})" class="admin-btn admin-btn-sm admin-btn-secondary mr-2"
                            title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button wire:click="confirmDelete({{ $member->id }})"
                            class="admin-btn admin-btn-sm admin-btn-danger" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">No team members found.</td>
                </tr>
            @endforelse
        </x-admin.ui.table>
    </x-admin.ui.card>

    <!-- Create/Edit Modal -->
    <x-admin.ui.modal isOpen="{{ $isOpen }}" title="{{ $teamId ? 'Edit Team Member' : 'Add New Member' }}"
        onClose="closeModal" submitAction="store" submitLabel="{{ $teamId ? 'Update' : 'Add' }}">
        <div class="row">
            <div class="col-md-6">
                <x-admin.ui.input label="Full Name" name="name" placeholder="e.g. John Doe" />
            </div>
            <div class="col-md-6">
                <x-admin.ui.input label="Role/Position" name="position" placeholder="e.g. Senior Stylist" />
            </div>
        </div>

        <x-admin.ui.textarea label="Bio" name="bio" placeholder="Enter short bio" rows="3" />

        <div class="row">
            <div class="col-md-6">
                <div class="admin-form-group">
                    <label class="admin-label">Profile Photo</label>
                    <div class="custom-file mb-2">
                        <input wire:model="new_image" type="file" class="custom-file-input" id="teamImage">
                        <label class="custom-file-label" for="teamImage">Choose file</label>
                    </div>
                    @if ($new_image)
                        <img src="{{ $new_image->temporaryUrl() }}" class="rounded-circle shadow-sm"
                            style="width: 60px; height: 60px; object-fit: cover;">
                    @elseif($image)
                        <img src="{{ asset('storage/' . $image) }}" class="rounded-circle shadow-sm"
                            style="width: 60px; height: 60px; object-fit: cover;">
                    @endif
                    @error('new_image') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="admin-form-group">
                    <label class="admin-label">Social Links <small class="text-muted">(Optional)</small></label>
                    <input wire:model="instagram" type="text" class="admin-input mb-2" placeholder="Instagram URL">
                    <input wire:model="facebook" type="text" class="admin-input mb-2" placeholder="Facebook URL">
                    <input wire:model="twitter" type="text" class="admin-input mb-2" placeholder="Twitter URL">
                    <input wire:model="linkedin" type="text" class="admin-input" placeholder="LinkedIn URL">
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
            <p class="text-muted mb-4">You won't be able to revert this! This member will be permanently deleted.</p>
            <div class="d-flex justify-content-center">
                <button wire:click="closeDeleteModal" class="admin-btn admin-btn-secondary mr-3 px-4">Cancel</button>
                <button wire:click="delete" class="admin-btn admin-btn-danger px-4">Yes, Delete it!</button>
            </div>
        </div>
    </x-admin.ui.modal>
</div>