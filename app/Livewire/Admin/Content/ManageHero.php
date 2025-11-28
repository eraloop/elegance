<?php

namespace App\Livewire\Admin\Content;

use App\Models\Hero;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.admin')]
class ManageHero extends Component
{
    use WithFileUploads;

    public $heroes;
    public $title, $subtitle, $button_text, $button_link, $secondary_button_text, $secondary_button_link;
    public $image, $new_image;
    public $heroId;
    public $isOpen = false;
    public $isDeleteOpen = false;
    public $deleteId;

    public function render()
    {
        $this->heroes = Hero::all();
        return view('livewire.admin.content.manage-hero');
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
        $this->title = '';
        $this->subtitle = '';
        $this->button_text = '';
        $this->button_link = '';
        $this->secondary_button_text = '';
        $this->secondary_button_link = '';
        $this->image = null;
        $this->new_image = null;
        $this->heroId = null;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'new_image' => $this->heroId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'button_text' => $this->button_text,
            'button_link' => $this->button_link,
            'secondary_button_text' => $this->secondary_button_text,
            'secondary_button_link' => $this->secondary_button_link,
        ];

        if ($this->new_image) {
            $path = $this->new_image->store('hero', 'public');
            $data['image'] = $path;
        }

        Hero::updateOrCreate(['id' => $this->heroId], $data);

        session()->flash('success', $this->heroId ? 'Slide updated successfully.' : 'Slide created successfully.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $hero = Hero::findOrFail($id);
        $this->heroId = $id;
        $this->title = $hero->title;
        $this->subtitle = $hero->subtitle;
        $this->button_text = $hero->button_text;
        $this->button_link = $hero->button_link;
        $this->secondary_button_text = $hero->secondary_button_text;
        $this->secondary_button_link = $hero->secondary_button_link;
        $this->image = $hero->image;

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
            $hero = Hero::find($this->deleteId);
            if ($hero->image) {
                Storage::disk('public')->delete($hero->image);
            }
            $hero->delete();
            session()->flash('success', 'Slide deleted successfully.');
            $this->closeDeleteModal();
        }
    }
}
