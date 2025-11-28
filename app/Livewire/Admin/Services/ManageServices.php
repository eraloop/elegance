<?php

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.admin')]
class ManageServices extends Component
{
    use WithPagination, WithFileUploads;

    public $name, $description, $price_min, $price_max, $duration_min, $duration_max, $category_id, $serviceId;
    public $thumbnail, $newThumbnail;
    public $isOpen = false;
    public $isDeleteOpen = false;
    public $deleteId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.services.manage-services', [
            'services' => Service::with('category')->latest()->paginate(10),
            'categories' => Category::all()
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
        $this->description = '';
        $this->price_min = '';
        $this->price_max = '';
        $this->duration_min = '';
        $this->duration_max = '';
        $this->category_id = '';
        $this->thumbnail = null;
        $this->newThumbnail = null;
        $this->serviceId = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'price_min' => 'required|numeric',
            'duration_min' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'newThumbnail' => $this->serviceId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price_min' => $this->price_min,
            'price_max' => $this->price_max,
            'duration_min' => $this->duration_min,
            'duration_max' => $this->duration_max,
            'category_id' => $this->category_id,
            'slug' => \Illuminate\Support\Str::slug($this->name),
            'is_active' => true,
        ];

        if ($this->newThumbnail) {
            $path = $this->newThumbnail->store('services', 'public');
            $data['thumbnail'] = $path;
        }

        Service::updateOrCreate(['id' => $this->serviceId], $data);

        session()->flash('success', $this->serviceId ? 'Service updated successfully.' : 'Service created successfully.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $this->serviceId = $id;
        $this->name = $service->name;
        $this->description = $service->description;
        $this->price_min = $service->price_min;
        $this->price_max = $service->price_max;
        $this->duration_min = $service->duration_min;
        $this->duration_max = $service->duration_max;
        $this->category_id = $service->category_id;
        $this->thumbnail = $service->thumbnail;

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
            $service = Service::find($this->deleteId);
            if ($service->thumbnail) {
                Storage::disk('public')->delete($service->thumbnail);
            }
            $service->delete();
            session()->flash('success', 'Service deleted successfully.');
            $this->closeDeleteModal();
        }
    }
}
