<?php

namespace App\Livewire\Admin\Content;

use App\Models\Team;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.admin')]
class ManageTeam extends Component
{
    use WithFileUploads;

    public $teamMembers;
    public $name, $position, $bio;
    public $facebook, $twitter, $instagram, $linkedin;
    public $image, $new_image;
    public $teamId;
    public $isOpen = false;
    public $isDeleteOpen = false;
    public $deleteId;

    public function render()
    {
        $this->teamMembers = Team::all();
        return view('livewire.admin.content.manage-team');
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
        $this->position = '';
        $this->bio = '';
        $this->facebook = '';
        $this->twitter = '';
        $this->instagram = '';
        $this->linkedin = '';
        $this->image = null;
        $this->new_image = null;
        $this->teamId = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'position' => 'required',
            'new_image' => $this->teamId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'name' => $this->name,
            'position' => $this->position,
            'bio' => $this->bio,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
        ];

        if ($this->new_image) {
            $path = $this->new_image->store('team', 'public');
            $data['image'] = $path;
        }

        Team::updateOrCreate(['id' => $this->teamId], $data);

        session()->flash('success', $this->teamId ? 'Team member updated successfully.' : 'Team member added successfully.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $member = Team::findOrFail($id);
        $this->teamId = $id;
        $this->name = $member->name;
        $this->position = $member->position;
        $this->bio = $member->bio;
        $this->facebook = $member->facebook;
        $this->twitter = $member->twitter;
        $this->instagram = $member->instagram;
        $this->linkedin = $member->linkedin;
        $this->image = $member->image;

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
            $member = Team::find($this->deleteId);
            if ($member->image) {
                Storage::disk('public')->delete($member->image);
            }
            $member->delete();
            session()->flash('success', 'Team member deleted successfully.');
            $this->closeDeleteModal();
        }
    }
}
