<?php

namespace App\Livewire\Admin\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class ManagePermissions extends Component
{
    public $permissions;
    public $name;
    public $permissionId;
    public $isOpen = false;
    public $isDeleteOpen = false;
    public $deleteId;

    public function render()
    {
        $this->permissions = Permission::all();
        return view('livewire.admin.permissions.manage-permissions');
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
        $this->permissionId = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|unique:permissions,name,' . $this->permissionId,
        ]);

        Permission::updateOrCreate(['id' => $this->permissionId], [
            'name' => $this->name,
            'guard_name' => 'web'
        ]);

        session()->flash('success', $this->permissionId ? 'Permission updated successfully.' : 'Permission created successfully.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $this->permissionId = $id;
        $this->name = $permission->name;

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
            Permission::find($this->deleteId)->delete();
            session()->flash('success', 'Permission deleted successfully.');
            $this->closeDeleteModal();
        }
    }
}
