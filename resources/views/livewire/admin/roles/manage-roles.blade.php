<div>
    @section('title', 'Role Management')

    <x-admin.ui.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h5 class="mb-0 font-weight-bold text-primary">All Roles</h5>
                <x-admin.ui.button wire:click="create" icon="fas fa-plus-circle" label="Add New Role" />
            </div>
        </x-slot>

        <x-admin.ui.table :headers="['Name', 'Permissions', 'Users Count', 'Actions']">
            @forelse($roles as $role)
                <tr>
                    <td class="align-middle">
                        <span class="font-weight-600 text-dark">{{ ucfirst($role->name) }}</span>
                    </td>
                    <td class="align-middle">
                        <span class="admin-badge admin-badge-info">{{ $role->permissions->count() }} Permissions</span>
                    </td>
                    <td class="align-middle">
                        <span class="admin-badge admin-badge-secondary">{{ $role->users_count ?? 0 }} Users</span>
                    </td>
                    <td class="align-middle text-right">
                        <button wire:click="edit({{ $role->id }})" class="admin-btn admin-btn-sm admin-btn-secondary mr-2"
                            title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        @if($role->name !== 'admin')
                            <button wire:click="confirmDelete({{ $role->id }})" class="admin-btn admin-btn-sm admin-btn-danger"
                                title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">No roles found.</td>
                </tr>
            @endforelse
        </x-admin.ui.table>

        <div class="mt-4">
            {{ $roles->links() }}
        </div>
    </x-admin.ui.card>

    <!-- Create/Edit Modal -->
    <x-admin.ui.modal isOpen="{{ $isOpen }}" title="{{ $roleId ? 'Edit Role' : 'Create New Role' }}"
        onClose="closeModal" submitAction="store" submitLabel="{{ $roleId ? 'Update' : 'Create' }}">
        <x-admin.ui.input label="Role Name" name="name" placeholder="Enter role name" required />

        <div class="admin-form-group">
            <label class="admin-label mb-3">Permissions</label>
            <div class="row" style="max-height: 400px; overflow-y: auto;">
                @foreach($permissions as $group => $perms)
                    <div class="col-md-6 mb-4">
                        <div class="p-3 bg-light rounded h-100 border">
                            <h6 class="font-weight-bold text-uppercase small text-primary mb-3 border-bottom pb-2">
                                {{ ucfirst($group) }}
                            </h6>
                            @foreach($perms as $permission)
                                <div class="custom-control custom-checkbox mb-2">
                                    <input wire:model="selectedPermissions" type="checkbox" class="custom-control-input"
                                        id="perm_{{ $permission->id }}" value="{{ $permission->name }}">
                                    <label class="custom-control-label" for="perm_{{ $permission->id }}"
                                        style="cursor: pointer;">
                                        {{ str_replace('_', ' ', ucfirst($permission->name)) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            @error('selectedPermissions') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
        </div>
    </x-admin.ui.modal>

    <!-- Delete Confirmation Modal -->
    <x-admin.ui.modal isOpen="{{ $isDeleteOpen }}" title="Confirm Delete" onClose="closeDeleteModal">
        <div class="text-center p-3">
            <div class="mb-4">
                <i class="fas fa-exclamation-circle text-danger" style="font-size: 50px;"></i>
            </div>
            <h4 class="font-weight-bold mb-2">Are you sure?</h4>
            <p class="text-muted mb-4">You won't be able to revert this! This role will be permanently deleted.</p>
            <div class="d-flex justify-content-center">
                <button wire:click="closeDeleteModal" class="admin-btn admin-btn-secondary mr-3 px-4">Cancel</button>
                <button wire:click="delete" class="admin-btn admin-btn-danger px-4">Yes, Delete it!</button>
            </div>
        </div>
    </x-admin.ui.modal>
</div>