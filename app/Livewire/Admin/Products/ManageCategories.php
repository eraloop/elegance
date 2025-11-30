<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

#[Layout('layouts.admin')]
class ManageCategories extends Component
{
    use WithPagination;

    public $name, $slug, $description, $is_featured = false, $is_active = true, $sort_order = 0;
    public $categoryId;
    public $isOpen = false;
    public $isDeleteOpen = false;
    public $deleteId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.products.manage-categories', [
            'categories' => Category::orderBy('sort_order')->paginate(10)
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
        $this->slug = '';
        $this->description = '';
        $this->is_featured = false;
        $this->is_active = true;
        $this->sort_order = 0;
        $this->categoryId = null;
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $this->categoryId,
            'sort_order' => 'integer',
        ]);

        Category::updateOrCreate(['id' => $this->categoryId], [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'is_featured' => $this->is_featured,
            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
        ]);

        session()->flash('success', $this->categoryId ? 'Category updated successfully.' : 'Category created successfully.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->description = $category->description;
        $this->is_featured = $category->is_featured;
        $this->is_active = $category->is_active;
        $this->sort_order = $category->sort_order;

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
            Category::find($this->deleteId)->delete();
            session()->flash('success', 'Category deleted successfully.');
            $this->closeDeleteModal();
        }
    }
}
