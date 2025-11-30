<?php

namespace App\Livewire\Web\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ProductDetail extends Component
{
    public $product;
    public $quantity = 1;

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['images', 'category'])
            ->firstOrFail();
    }

    public function incrementQuantity()
    {
        if ($this->quantity < $this->product->stock_quantity) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        // For now, we are redirecting to checkout directly with the product details
        // In a full cart system, we would add to session/cart here.
        return redirect()->route('web.products.checkout', [
            'product_id' => $this->product->id,
            'quantity' => $this->quantity
        ]);
    }

    public function render()
    {
        return view('livewire.web.products.product-detail', [
            'relatedProducts' => Product::where('category_id', $this->product->category_id)
                ->where('id', '!=', $this->product->id)
                ->where('is_active', true)
                ->take(3)
                ->get()
        ]);
    }
}
