<?php

namespace App\Livewire\Admin\Content;

use App\Models\GalleryImage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.admin')]
class ManageGallery extends Component
{
    use WithFileUploads;

    public $images;
    public $title, $category;
    public $image_path, $new_image_path;
    public $imageId;
    public $isOpen = false;
    public $isDeleteOpen = false;
    public $deleteId;

    public function render()
    {
        $this->images = GalleryImage::all();
        return view('livewire.admin.content.manage-gallery');
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
        $this->category = 'Haircuts';
        $this->image_path = null;
        $this->new_image_path = null;
        $this->imageId = null;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'category' => 'required',
            'new_image_path' => $this->imageId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'category' => $this->category,
        ];

        if ($this->new_image_path) {
            $path = $this->new_image_path->store('gallery', 'public');
            $data['image_path'] = $path;
        }

        GalleryImage::updateOrCreate(['id' => $this->imageId], $data);

        session()->flash('success', $this->imageId ? 'Image updated successfully.' : 'Image added successfully.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $image = GalleryImage::findOrFail($id);
        $this->imageId = $id;
        $this->title = $image->title;
        $this->category = $image->category;
        $this->image_path = $image->image_path;

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
            $image = GalleryImage::find($this->deleteId);
            if ($image->image_path) {
                Storage::disk('public')->delete($image->image_path);
            }
            $image->delete();
            session()->flash('success', 'Image deleted successfully.');
            $this->closeDeleteModal();
        }
    }
}
