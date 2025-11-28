<div>
    @section('title', 'Permissions Management')

    <x-admin.ui.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h5 class="mb-0 font-weight-bold text-primary">Permissions</h5>
                <x-admin.ui.button wire:click="create" icon="fas fa-plus-circle" label="Add New Permission" />
            </div>
        </x-slot>

        <x-admin.ui.table :headers="['Name', 'Guard Name', 'Actions']">
            @forelse($permissions as $permission)
                <tr>
                    <td class="align-middle">
                        <div class="font-weight-bold text-dark">{{ $permission->name }}</div>
                    </td>
                    <td class="align-middle">
                        <span class="admin-badge admin-badge-info">{{ $permission->guard_name }}</span>
                    </td>
                    <td class="align-middle text-right">
                        <button wire:click="edit({{ $permission->id }})"
                            class="admin-btn admin-btn-sm admin-btn-secondary mr-2" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button wire:click="confirmDelete({{ $permission->id }})"
                            class="admin-btn admin-btn-sm admin-btn-danger" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-muted">No permissions found.</td>
                </tr>
            @endforelse
        </x-admin.ui.table>
    </x-admin.ui.card>

    <!-- Create/Edit Modal -->
    <x-admin.ui.modal isOpen="{{ $isOpen }}" title="{{ $permissionId ? 'Edit Permission' : 'Create New Permission' }}"
        onClose="closeModal" submitAction="store" submitLabel="{{ $permissionId ? 'Update' : 'Create' }}">
        <x-admin.ui.input label="Permission Name" name="name" placeholder="e.g. edit articles" required="true" />
    </x-admin.ui.modal>

    <!-- Delete Confirmation Modal -->
    <x-admin.ui.modal isOpen="{{ $isDeleteOpen }}" title="Confirm Delete" onClose="closeDeleteModal">
        <div class="text-center p-3">
            <div class="mb-4">
                <i class="fas fa-exclamation-circle text-danger" style="font-size: 50px;"></i>
            </div>
            <h4 class="font-weight-bold mb-2">Are you sure?</h4>
            <p class="text-muted mb-4">You won't be able to revert this! This permission will be permanently deleted.
            </p>
            <div class="d-flex justify-content-center">
                <button wire:click="closeDeleteModal" class="admin-btn admin-btn-secondary mr-3 px-4">Cancel</button>
                <button wire:click="delete" class="admin-btn admin-btn-danger px-4">Yes, Delete it!</button>
            </div>
        </div>
    </x-admin.ui.modal>
</div>