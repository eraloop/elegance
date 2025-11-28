<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class ManageRoles extends Component
{
    use WithPagination;

    public $name;
    public $selectedPermissions = [];
    public $roleId;
    public $isOpen = false;
    public $isDeleteOpen = false;
    public $deleteId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.roles.manage-roles', [
            'roles' => Role::where('guard_name', 'admin')->with('permissions')->latest()->paginate(10),
            'permissions' => Permission::where('guard_name', 'admin')->get()->groupBy(function ($data) {
                $parts = explode('_', $data->name);
                // Handle cases where permission might not have underscore or different format
                if (count($parts) > 1) {
                    return end($parts);
                }
                return 'other';
            })
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->selectedPermissions = [];
        $this->roleId = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|unique:roles,name,' . $this->roleId,
            'selectedPermissions' => 'required|array|min:1'
        ]);

        $role = Role::updateOrCreate(
            ['id' => $this->roleId],
            [
                'name' => $this->name,
                'guard_name' => 'admin'
            ]
        );

        // Sync permissions
        // We need to fetch permission names from IDs or just pass names if selectedPermissions contains names
        // But checkboxes usually bind to IDs or names. Let's assume names for simplicity or IDs.
        // If selectedPermissions is array of names:
        $role->syncPermissions($this->selectedPermissions);

        session()->flash('success', $this->roleId ? 'Role updated successfully.' : 'Role created successfully.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $this->roleId = $id;
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions->pluck('name')->toArray();

        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->isDeleteOpen = true;
    }

    public function closeDeleteModal()
    {
        $this->isDeleteOpen = false;
        $this->deleteId = null;
    }

    public function delete()
    {
        if ($this->deleteId) {
            $role = Role::find($this->deleteId);
            if ($role->name === 'admin') {
                session()->flash('error', 'Cannot delete Super Admin role.');
            } else {
                $role->delete();
                session()->flash('success', 'Role deleted successfully.');
            }
            $this->closeDeleteModal();
        }
    }
}
