<div>
    @section('title', 'User Management')

    <x-admin.ui.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h5 class="mb-0 font-weight-bold text-primary">All Users</h5>
                <x-admin.ui.button wire:click="create" icon="fas fa-plus-circle" label="Add New User" />
            </div>
        </x-slot>

        <x-admin.ui.table :headers="['Name', 'Email', 'Role', 'Status', 'Joined', 'Actions']">
            @forelse($users as $user)
                <tr>
                    <td class="align-middle">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm mr-3 bg-light rounded-circle d-flex align-items-center justify-content-center"
                                style="width:40px;height:40px; border: 1px solid #eee;">
                                <span class="text-primary font-weight-bold">{{ substr($user->name, 0, 2) }}</span>
                            </div>
                            <span class="font-weight-600 text-dark">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="align-middle">{{ $user->email }}</td>
                    <td class="align-middle">
                        @foreach($user->roles as $role)
                            <span class="admin-badge admin-badge-info">{{ ucfirst($role->name) }}</span>
                        @endforeach
                    </td>
                    <td class="align-middle">
                        <span class="admin-badge admin-badge-success">Active</span>
                    </td>
                    <td class="align-middle">{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="align-middle text-right">
                        <button wire:click="edit({{ $user->id }})" class="admin-btn admin-btn-sm admin-btn-secondary mr-2"
                            title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        @if($user->id !== auth()->guard('admin')->id())
                            <button wire:click="confirmDelete({{ $user->id }})" class="admin-btn admin-btn-sm admin-btn-danger"
                                title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No users found.</td>
                </tr>
            @endforelse
        </x-admin.ui.table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </x-admin.ui.card>

    <!-- Create/Edit Modal -->
    <x-admin.ui.modal isOpen="{{ $isOpen }}" title="{{ $userId ? 'Edit User' : 'Create New User' }}"
        onClose="closeModal" submitAction="store" submitLabel="{{ $userId ? 'Update' : 'Create' }}">
        <x-admin.ui.input label="Full Name" name="name" placeholder="Enter full name" required />
        <x-admin.ui.input label="Email Address" name="email" type="email" placeholder="Enter email address" required />

        @if(!$userId)
            <x-admin.ui.input label="Password" name="password" type="password" placeholder="Enter password" required />
        @endif

        <div class="admin-form-group">
            <label for="role" class="admin-label">Role <span class="text-danger">*</span></label>
            <select wire:model="role" class="admin-select @error('role') is-invalid @enderror" id="role">
                <option value="">Select Role</option>
                @foreach($roles as $r)
                    <option value="{{ $r->name }}">{{ ucfirst($r->name) }}</option>
                @endforeach
            </select>
            @error('role') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
        </div>
    </x-admin.ui.modal>

    <!-- Delete Confirmation Modal -->
    <x-admin.ui.modal isOpen="{{ $isDeleteOpen }}" title="Confirm Delete" onClose="closeDeleteModal">
        <div class="text-center p-3">
            <div class="mb-4">
                <i class="fas fa-exclamation-circle text-danger" style="font-size: 50px;"></i>
            </div>
            <h4 class="font-weight-bold mb-2">Are you sure?</h4>
            <p class="text-muted mb-4">You won't be able to revert this! This user will be permanently deleted.</p>
            <div class="d-flex justify-content-center">
                <button wire:click="closeDeleteModal" class="admin-btn admin-btn-secondary mr-3 px-4">Cancel</button>
                <button wire:click="delete" class="admin-btn admin-btn-danger px-4">Yes, Delete it!</button>
            </div>
        </div>
    </x-admin.ui.modal>
</div>