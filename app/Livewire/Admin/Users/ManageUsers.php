<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class ManageUsers extends Component
{
    use WithPagination;

    public $name, $email, $password, $role, $userId;
    public $isOpen = false;
    public $isDeleteOpen = false;
    public $deleteId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.users.manage-users', [
            'users' => User::with('roles')->latest()->paginate(10),
            'roles' => Role::where('guard_name', 'admin')->get()
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
        $this->email = '';
        $this->password = '';
        $this->role = '';
        $this->userId = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => $this->userId ? 'nullable|min:6' : 'required|min:6',
            'role' => 'required'
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        $user = User::updateOrCreate(['id' => $this->userId], $data);

        // Sync roles
        $user->syncRoles([$this->role]);

        session()->flash('success', $this->userId ? 'User updated successfully.' : 'User created successfully.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->first()->name ?? '';

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
            User::find($this->deleteId)->delete();
            session()->flash('success', 'User deleted successfully.');
            $this->closeDeleteModal();
        }
    }
}
