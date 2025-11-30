<?php

namespace App\Livewire\Web\Products;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;

#[Layout('layouts.app')]
class Checkout extends Component
{
    public $product;
    public $quantity = 1;
    public $orderPlaced = false;

    // Form fields
    public $name;
    public $email;
    public $phone;
    public $address;
    public $notes;

    public function mount()
    {
        $productId = request()->query('product_id');
        $this->quantity = request()->query('quantity', 1);

        if ($productId) {
            $this->product = Product::find($productId);
        }

        if (!$this->product) {
            return redirect()->route('web.products.index');
        }
    }

    public function getTotalProperty()
    {
        if (!$this->product) {
            return 0;
        }
        $price = $this->product->sale_price ?: $this->product->price;
        return $price * $this->quantity;
    }

    public function placeOrder()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $price = $this->product->sale_price ?: $this->product->price;
        $subtotal = $price * $this->quantity;

        // Create Order
        $order = Order::create([
            'customer_name' => $this->name,
            'customer_email' => $this->email,
            'customer_phone' => $this->phone,
            'shipping_address' => $this->address,
            'notes' => $this->notes,
            'total_amount' => $subtotal,
            'status' => 'pending',
        ]);

        // Create Order Item
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $this->product->id,
            'product_name' => $this->product->name,
            'price' => $price,
            'quantity' => $this->quantity,
            'subtotal' => $subtotal,
        ]);

        // Send Email
        try {
            Mail::to($this->email)->send(new OrderPlaced($order));
            Mail::to(config('mail.from.address'))->send(new OrderPlaced($order, true)); // Admin copy
        } catch (\Exception $e) {
            // Log error
        }

        session()->flash('success', 'Your order has been placed successfully! We will contact you shortly.');

        session()->flash('success', 'Your order has been placed successfully! We will contact you shortly.');

        $this->orderPlaced = true;
    }

    public function render()
    {
        return view('livewire.web.products.checkout');
    }
}
