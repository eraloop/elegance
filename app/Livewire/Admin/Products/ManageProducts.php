<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.admin')]
class ManageProducts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $slug, $short_description, $description, $price, $sale_price, $sku, $stock_quantity = 0;
    public $in_stock = true, $is_active = true, $is_featured = false;
    public $category_id;
    public $cover_image, $new_cover_image;
    public $gallery_images = []; // For new uploads
    public $existing_gallery_images = []; // For display/deletion

    public $productId;
    public $isOpen = false;
    public $isDeleteOpen = false;
    public $deleteId;

    public $search = '';
    public $filterCategory = '';

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $query = Product::with('category');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('sku', 'like', '%' . $this->search . '%');
        }

        if ($this->filterCategory) {
            $query->where('category_id', $this->filterCategory);
        }

        return view('livewire.admin.products.manage-products', [
            'products' => $query->latest()->paginate(10),
            'categories' => Category::orderBy('name')->get()
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
        $this->short_description = '';
        $this->description = '';
        $this->price = '';
        $this->sale_price = '';
        $this->sku = '';
        $this->stock_quantity = 0;
        $this->in_stock = true;
        $this->is_active = true;
        $this->is_featured = false;
        $this->category_id = '';
        $this->cover_image = null;
        $this->new_cover_image = null;
        $this->gallery_images = [];
        $this->existing_gallery_images = [];
        $this->productId = null;
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,' . $this->productId,
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'new_cover_image' => 'nullable|image|max:2048', // 2MB Max
            'gallery_images.*' => 'image|max:2048',
        ]);

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'price' => $this->price,
            'sale_price' => $this->sale_price ?: null,
            'sku' => $this->sku,
            'stock_quantity' => $this->stock_quantity,
            'in_stock' => $this->in_stock,
            'is_active' => $this->is_active,
            'is_featured' => $this->is_featured,
            'category_id' => $this->category_id ?: null,
        ];

        if ($this->new_cover_image) {
            if ($this->cover_image) {
                Storage::disk('public')->delete($this->cover_image);
            }
            $data['cover_image'] = $this->new_cover_image->store('products', 'public');
        }

        $product = Product::updateOrCreate(['id' => $this->productId], $data);

        // Handle Gallery Images
        if (!empty($this->gallery_images)) {
            foreach ($this->gallery_images as $image) {
                $path = $image->store('products/gallery', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        session()->flash('success', $this->productId ? 'Product updated successfully.' : 'Product created successfully.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $this->productId = $id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->sale_price = $product->sale_price;
        $this->sku = $product->sku;
        $this->stock_quantity = $product->stock_quantity;
        $this->in_stock = $product->in_stock;
        $this->is_active = $product->is_active;
        $this->is_featured = $product->is_featured;
        $this->category_id = $product->category_id;
        $this->cover_image = $product->cover_image;
        $this->existing_gallery_images = $product->images;

        $this->openModal();
    }

    public function deleteImage($imageId)
    {
        $image = ProductImage::find($imageId);
        if ($image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
            $this->existing_gallery_images = $this->existing_gallery_images->reject(function ($img) use ($imageId) {
                return $img->id == $imageId;
            });
        }
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
            $product = Product::find($this->deleteId);

            // Delete cover image
            if ($product->cover_image) {
                Storage::disk('public')->delete($product->cover_image);
            }

            // Delete gallery images
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->image_path);
            }

            $product->delete();
            session()->flash('success', 'Product deleted successfully.');
            $this->closeDeleteModal();
        }
    }
}
