<div>
    @section('title', 'Checkout - Elegance')

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">Checkout</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('web.products.index') }}">Shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="page-content">
        <div class="container">
            @if(session()->has('message'))
                <div class="alert alert-success wow fadeInUp">
                    {{ session('message') }}
                </div>
            @endif

            @if($orderPlaced)
                <div class="text-center py-5 wow fadeInUp">
                    <div class="success-icon mb-4">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h2 class="mb-3">Order Placed Successfully!</h2>
                    <p class="lead mb-4">Thank you for your order. We have sent a confirmation email to {{ $email }}.</p>
                    <a href="{{ route('web.products.index') }}" class="btn-default">Continue Shopping</a>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-8 mb-5 mb-lg-0 wow fadeInUp">
                        <div class="checkout-form-section">
                            <h3 class="section-heading">Billing Details</h3>
                            <form wire:submit.prevent="placeOrder">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" wire:model="name" placeholder="John Doe">
                                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email Address *</label>
                                        <input type="email" class="form-control" wire:model="email"
                                            placeholder="john@example.com">
                                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Phone Number *</label>
                                        <input type="tel" class="form-control" wire:model="phone"
                                            placeholder="+1 234 567 890">
                                        @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Shipping Address *</label>
                                        <textarea class="form-control" wire:model="address" rows="3"
                                            placeholder="123 Main St, City, Country"></textarea>
                                        @error('address') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label class="form-label">Order Notes (Optional)</label>
                                        <textarea class="form-control" wire:model="notes" rows="2"
                                            placeholder="Notes about your order"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="order-summary-section">
                            <h3 class="section-heading">Your Order</h3>

                            <div class="order-product mb-3">
                                @if($product->cover_image)
                                    <img src="{{ Storage::url($product->cover_image) }}" alt="{{ $product->name }}"
                                        class="product-thumb">
                                @endif
                                <div class="product-details">
                                    <h5>{{ $product->name }}</h5>
                                    <p class="text-muted small">Quantity: {{ $quantity }}</p>
                                </div>
                            </div>

                            <div class="order-calculations">
                                <div class="calc-row">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($total, 2) }}</span>
                                </div>
                                <div class="calc-row total">
                                    <span>Total</span>
                                    <span>${{ number_format($total, 2) }}</span>
                                </div>
                            </div>

                            <div class="payment-method mb-4">
                                <h5 class="mb-3">Payment Method</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="cod" checked>
                                    <label class="form-check-label" for="cod">
                                        Cash on Delivery
                                    </label>
                                </div>
                            </div>

                            <button type="button" class="btn-place-order w-100" wire:click="placeOrder"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove>Place Order</span>
                                <span wire:loading><i class="fas fa-spinner fa-spin"></i> Processing...</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        .success-icon i {
            font-size: 80px;
            color: #27ae60;
        }

        .checkout-form-section,
        .order-summary-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .section-heading {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 25px;
            color: #333;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--primary-color);
        }

        .form-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }

        .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(8, 71, 52, 0.15);
        }

        .order-product {
            display: flex;
            gap: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .product-thumb {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-details h5 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .order-calculations {
            border-top: 1px solid #e0e0e0;
            padding-top: 20px;
            margin-top: 20px;
        }

        .calc-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            color: #666;
        }

        .calc-row.total {
            border-top: 2px solid var(--primary-color);
            margin-top: 10px;
            padding-top: 15px;
            font-size: 18px;
            font-weight: 700;
            color: #333;
        }

        .payment-method h5 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .payment-method {
            border-top: 1px solid #e0e0e0;
            padding-top: 20px;
            margin-top: 20px;
        }

        .btn-place-order {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-place-order:hover {
            background: #065c42;
            transform: translateY(-2px);
        }

        .btn-place-order:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        @media (max-width: 991px) {

            .checkout-form-section,
            .order-summary-section {
                padding: 20px;
            }
        }
    </style>
</div>