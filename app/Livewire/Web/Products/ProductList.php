<?php

namespace App\Livewire\Web\Products;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ProductList extends Component
{
    use WithPagination;

    public $categorySlug;
    public $search = '';
    public $sort = 'newest';

    protected $paginationTheme = 'bootstrap';

    public function mount($category = null)
    {
        $this->categorySlug = $category;
    }

    public function render()
    {
        $query = Product::where('is_active', true);

        if ($this->categorySlug) {
            $category = Category::where('slug', $this->categorySlug)->firstOrFail();
            $query->where('category_id', $category->id);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        switch ($this->sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default: // newest
                $query->latest();
                break;
        }

        return view('livewire.web.products.product-list', [
            'products' => $query->paginate(12),
            'categories' => Category::where('is_active', true)->orderBy('sort_order')->get(),
            'currentCategory' => $this->categorySlug ? Category::where('slug', $this->categorySlug)->first() : null
        ]);
    }
}
