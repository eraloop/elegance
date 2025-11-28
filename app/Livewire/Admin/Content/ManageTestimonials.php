<?php

namespace App\Livewire\Admin\Content;

use App\Models\Testimonial;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.admin')]
class ManageTestimonials extends Component
{
    use WithFileUploads;

    public $testimonials;
    public $customer_name, $position, $content, $rating;
    public $customer_photo, $new_image;
    public $testimonialId;
    public $isOpen = false;
    public $isDeleteOpen = false;
    public $deleteId;

    public function render()
    {
        $this->testimonials = Testimonial::all();
        return view('livewire.admin.content.manage-testimonials');
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
        $this->customer_name = '';
        $this->position = '';
        $this->content = '';
        $this->rating = 5;
        $this->customer_photo = null;
        $this->new_image = null;
        $this->testimonialId = null;
    }

    public function store()
    {
        $this->validate([
            'customer_name' => 'required',
            'position' => 'required',
            'content' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'new_image' => $this->testimonialId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'customer_name' => $this->customer_name,
            'position' => $this->position,
            'content' => $this->content,
            'rating' => $this->rating,
        ];

        if ($this->new_image) {
            $path = $this->new_image->store('testimonials', 'public');
            $data['customer_photo'] = $path;
        }

        Testimonial::updateOrCreate(['id' => $this->testimonialId], $data);

        session()->flash('success', $this->testimonialId ? 'Testimonial updated successfully.' : 'Testimonial created successfully.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $this->testimonialId = $id;
        $this->customer_name = $testimonial->customer_name;
        $this->position = $testimonial->position;
        $this->content = $testimonial->content;
        $this->rating = $testimonial->rating;
        $this->customer_photo = $testimonial->customer_photo;

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
            $testimonial = Testimonial::find($this->deleteId);
            if ($testimonial->customer_photo) {
                Storage::disk('public')->delete($testimonial->customer_photo);
            }
            $testimonial->delete();
            session()->flash('success', 'Testimonial deleted successfully.');
            $this->closeDeleteModal();
        }
    }
}
