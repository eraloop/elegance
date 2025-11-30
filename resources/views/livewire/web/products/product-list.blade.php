<div>
    @section('title', $currentCategory ? $currentCategory->name . ' - Elegance Products' : 'Shop - Elegance')
    @section('description', $currentCategory ? $currentCategory->description : 'Explore our premium collection of beauty products.')

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">
                            {{ $currentCategory ? $currentCategory->name : 'Our Products' }}
                        </h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Home</a></li>
                                @if($currentCategory)
                                    <li class="breadcrumb-item"><a href="{{ route('web.products.index') }}">Shop</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $currentCategory->name }}</li>
                                @else
                                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                                @endif
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Page Content Start -->
    <div class="page-content">
        <div class="container">
            <div class="row">
                <!-- Sidebar Start -->
                <div class="col-lg-3 col-md-4 mb-5 mb-md-0">
                    <div class="shop-sidebar">
                        <!-- Search Widget -->
                        <div class="widget search-widget mb-4 wow fadeInUp">
                            <h3 class="widget-title">Search</h3>
                            <div class="search-form">
                                <input type="text" class="form-control" placeholder="Search products..."
                                    wire:model.live.debounce.300ms="search">
                                <button type="button"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                        <!-- Categories Widget -->
                        <div class="widget categories-widget mb-4 wow fadeInUp" data-wow-delay="0.2s">
                            <h3 class="widget-title">Categories</h3>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="{{ route('web.products.index') }}"
                                        class="{{ !$currentCategory ? 'active' : '' }}">
                                        All Products
                                    </a>
                                </li>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('web.products.category', $category->slug) }}"
                                            class="{{ $currentCategory && $currentCategory->id == $category->id ? 'active' : '' }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Sidebar End -->

                <!-- Product List Start -->
                <div class="col-lg-9 col-md-8">
                    <!-- Shop Toolbar -->
                    <div class="shop-toolbar d-flex justify-content-between align-items-center mb-4 wow fadeInUp">
                        <p class="mb-0">Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} of
                            {{ $products->total() }} results
                        </p>
                        <select class="form-select w-auto" wire:model.live="sort">
                            <option value="newest">Newest First</option>
                            <option value="price_low">Price: Low to High</option>
                            <option value="price_high">Price: High to Low</option>
                            <option value="name">Name: A-Z</option>
                        </select>
                    </div>

                    <div class="row">
                        @forelse($products as $product)
                            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.{{ $loop->index + 2 }}s">
                                <div class="team-item">
                                    <div class="team-image">
                                        <figure class="hover-anime">
                                            <a href="{{ route('web.products.show', $product->slug) }}">
                                                @if($product->cover_image)
                                                    <img src="{{ Storage::url($product->cover_image) }}"
                                                        alt="{{ $product->name }}">
                                                @else
                                                    <img src="{{ asset('assets/images/post-1.jpg') }}"
                                                        alt="{{ $product->name }}">
                                                @endif
                                            </a>

                                            @if($product->sale_price || $product->is_new || !$product->in_stock)
                                                <div class="product-badges">
                                                    @if($product->is_new)
                                                        <span class="badge badge-new">New</span>
                                                    @endif
                                                    @if($product->sale_price)
                                                        <span class="badge badge-sale">Sale</span>
                                                    @endif
                                                    @if(!$product->in_stock)
                                                        <span class="badge badge-out">Out of Stock</span>
                                                    @endif
                                                </div>
                                            @endif

                                            <div class="product-cart-action">
                                                <a href="{{ route('web.products.show', $product->slug) }}"
                                                    class="cart-icon">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </a>
                                            </div>
                                        </figure>
                                    </div>

                                    <div class="team-info">
                                        <style>
                                            .team-info h3 a {
                                                color: var(--primary-color) !important;
                                            }
                                        </style>
                                        <h3><a
                                                href="{{ route('web.products.show', $product->slug) }}">{{ $product->name }}</a>
                                        </h3>
                                        <p>{{ $product->category->name ?? 'General' }} @if($product->material) •
                                        {{ $product->material }} @endif
                                        </p>
                                        <div class="product-price">
                                            @if($product->sale_price)
                                                <span class="sale-price">${{ number_format($product->sale_price, 2) }}</span>
                                                <span class="regular-price">${{ number_format($product->price, 2) }}</span>
                                            @else
                                                <span class="current-price">${{ number_format($product->price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                <h3>No products found</h3>
                                <p class="text-muted">Try adjusting your search or filter to find what you're looking for.
                                </p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4 wow fadeInUp">
                        {{ $products->links() }}
                    </div>
                </div>
                <!-- Product List End -->
            </div>
        </div>
    </div>
    <!-- Page Content End -->

    <style>
        .product-badges {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 10;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .product-badges .badge {
            padding: 6px 15px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 20px;
            display: inline-block;
        }

        .badge-new {
            background: var(--primary-color);
            color: white;
        }

        .badge-sale {
            background: #e74c3c;
            color: white;
        }

        .badge-out {
            background: #333;
            color: white;
        }

        .product-cart-action {
            position: absolute;
            bottom: 15px;
            right: 15px;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .team-item:hover .product-cart-action {
            opacity: 1;
            transform: translateY(0);
        }

        .cart-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: white;
            color: var(--primary-color);
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .cart-icon:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        .product-price {
            margin-top: 10px;
        }

        .sale-price {
            color: #e74c3c;
            font-weight: 700;
            font-size: 18px;
            margin-right: 8px;
        }

        .regular-price {
            color: #999;
            text-decoration: line-through;
            font-size: 14px;
        }

        .current-price {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 18px;
        }

        .categories-widget ul li {
            margin-bottom: 12px;
        }

        .categories-widget ul li a {
            color: #777;
            font-size: 15px;
            transition: all 0.3s ease;
            display: block;
            padding: 8px 12px;
            border-radius: 5px;
        }

        .categories-widget ul li a:hover {
            color: var(--primary-color);
            background: #f5f5f5;
            padding-left: 20px;
        }

        .categories-widget ul li a.active {
            color: var(--primary-color);
            font-weight: 600;
            background: #f5f5f5;
            padding-left: 20px;
        }

        .shop-toolbar .form-select {
            border: 1px solid #e0e0e0;
            padding: 8px 15px;
            border-radius: 5px;
        }

        .shop-toolbar .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: none;
        }
    </style>
</div>