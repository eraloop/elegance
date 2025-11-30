<div>
    @section('title', $product->name . ' - Elegance')
    @section('description', $product->short_description)
    @section('og_image', $product->cover_image ? Storage::url($product->cover_image) : asset('assets/images/hero-img.jpg'))

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">{{ $product->name }}</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('web.index') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('web.products.index') }}">Shop</a></li>
                                @if($product->category)
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('web.products.category', $product->category->slug) }}">{{ $product->category->name }}</a>
                                    </li>
                                @endif
                                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Product Detail Section Start -->
    <div class="page-content">
        <div class="container">
            <div class="row">
                <!-- Product Gallery -->
                <div class="col-lg-6 mb-5 mb-lg-0 wow fadeInUp">
                    <div class="product-detail-gallery">
                        <div class="main-image mb-3">
                            @if($product->cover_image)
                                <img src="{{ asset('storage/' . $product->cover_image) }}" class="img-fluid rounded"
                                    alt="{{ $product->name }}" id="mainImage">
                            @else
                                <div class="no-image">
                                    <i class="fas fa-image fa-5x text-muted"></i>
                                </div>
                            @endif
                        </div>

                        @if($product->images->count() > 0)
                            <div class="thumbnail-grid row g-2">
                                <div class="col-3">
                                    <img src="{{ asset('storage/' . $product->cover_image) }}"
                                        class="img-fluid rounded thumbnail"
                                        onclick="changeMainImage('{{ asset('storage/' . $product->cover_image) }}')"
                                        alt="Thumbnail">
                                </div>
                                @foreach($product->images as $image)
                                    <div class="col-3">
                                        <img src="{{ asset('storage/' . $image->image_path) }}"
                                            class="img-fluid rounded thumbnail"
                                            onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}')"
                                            alt="Thumbnail">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="product-detail-info">
                        <!-- Product Meta -->
                        <div class="product-meta mb-3">
                            @if($product->category)
                                <span class="category">{{ $product->category->name }}</span>
                            @endif
                            @if($product->in_stock)
                                <span class="stock in-stock"><i class="fas fa-check-circle"></i> In Stock</span>
                            @else
                                <span class="stock out-of-stock"><i class="fas fa-times-circle"></i> Out of Stock</span>
                            @endif
                        </div>

                        <h2 class="product-title">{{ $product->name }}</h2>

                        <!-- Price -->
                        <div class="product-price mb-4">
                            @if($product->sale_price)
                                <span class="price-sale">${{ number_format($product->sale_price, 2) }}</span>
                                <span class="price-regular">${{ number_format($product->price, 2) }}</span>
                                <span class="price-save">Save
                                    ${{ number_format($product->price - $product->sale_price, 2) }}</span>
                            @else
                                <span class="price-current">${{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>

                        <!-- Short Description -->
                        @if($product->short_description)
                            <p class="product-short-desc">{{ $product->short_description }}</p>
                        @endif

                        <!-- Product Details -->
                        @if($product->sku || $product->brand || $product->material || $product->texture || $product->weight || $product->dimensions)
                            <div class="product-details-table mb-4">
                                <h5>Product Details</h5>
                                <table class="table table-borderless">
                                    @if($product->sku)
                                        <tr>
                                            <td><strong>SKU:</strong></td>
                                            <td>{{ $product->sku }}</td>
                                        </tr>
                                    @endif
                                    @if($product->brand)
                                        <tr>
                                            <td><strong>Brand:</strong></td>
                                            <td>{{ $product->brand }}</td>
                                        </tr>
                                    @endif
                                    @if($product->material)
                                        <tr>
                                            <td><strong>Material:</strong></td>
                                            <td>{{ $product->material }}</td>
                                        </tr>
                                    @endif
                                    @if($product->texture)
                                        <tr>
                                            <td><strong>Texture:</strong></td>
                                            <td>{{ $product->texture }}</td>
                                        </tr>
                                    @endif
                                    @if($product->weight)
                                        <tr>
                                            <td><strong>Weight:</strong></td>
                                            <td>{{ $product->weight }}</td>
                                        </tr>
                                    @endif
                                    @if($product->dimensions)
                                        <tr>
                                            <td><strong>Dimensions:</strong></td>
                                            <td>{{ $product->dimensions }}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        @endif

                        <!-- Add to Cart -->
                        @if($product->in_stock)
                            <div class="product-actions mb-4">
                                <div class="quantity-selector">
                                    <button class="qty-btn minus" wire:click="decrementQuantity">-</button>
                                    <input type="number" class="qty-input" value="{{ $quantity }}" readonly>
                                    <button class="qty-btn plus" wire:click="incrementQuantity">+</button>
                                </div>
                                <button class="btn-add-cart" wire:click="addToCart">
                                    <i class="fas fa-shopping-bag"></i> Add to Cart
                                </button>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> This product is currently out of stock.
                            </div>
                        @endif

                        <!-- Description -->
                        @if($product->description)
                            <div class="product-description">
                                <h5>Description</h5>
                                <div class="description-content">
                                    {!! nl2br(e($product->description)) !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Detail Section End -->

    <!-- Related Products Start -->
    @if($relatedProducts->count() > 0)
        <div class="our-team">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Related Products</h3>
                            <h2 class="text-anime">You May Also Like</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach($relatedProducts->take(3) as $related)
                        <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.{{ $loop->index }}s">
                            <div class="team-item">
                                <div class="team-image">
                                    <figure class="hover-anime">
                                        <a href="{{ route('web.products.show', $related->slug) }}">
                                            @if($related->cover_image)
                                                <img src="{{ Storage::url($related->cover_image) }}" alt="{{ $related->name }}">
                                            @else
                                                <img src="{{ asset('assets/images/post-1.jpg') }}" alt="{{ $related->name }}">
                                            @endif
                                        </a>
                                    </figure>
                                </div>
                                <div class="team-info">
                                    <h3><a
                                            href="{{ route('web.products.show', $related->slug) }}">{{ Str::limit($related->name, 30) }}</a>
                                    </h3>
                                    <p>${{ number_format($related->price, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Related Products End -->

    <style>
        .product-detail-gallery .main-image img {
            width: 100%;
            border-radius: 10px;
        }

        .thumbnail-grid .thumbnail {
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .thumbnail-grid .thumbnail:hover {
            border-color: var(--primary-color);
        }

        .product-meta {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .product-meta .category {
            background: var(--primary-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .product-meta .stock {
            font-size: 14px;
            font-weight: 600;
        }

        .product-meta .in-stock {
            color: #27ae60;
        }

        .product-meta .out-of-stock {
            color: #e74c3c;
        }

        .product-title {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }

        .product-price {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }

        .price-sale {
            font-size: 2rem;
            font-weight: 700;
            color: #e74c3c;
            margin-right: 10px;
        }

        .price-regular {
            font-size: 1.2rem;
            color: #999;
            text-decoration: line-through;
            margin-right: 10px;
        }

        .price-save {
            background: #27ae60;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .price-current {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .product-short-desc {
            font-size: 16px;
            color: #666;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .product-details-table h5 {
            font-weight: 700;
            margin-bottom: 15px;
            color: #333;
        }

        .product-details-table table td {
            padding: 8px 0;
            color: #666;
        }

        .product-details-table table td:first-child {
            width: 150px;
        }

        .product-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }

        .qty-btn {
            background: white;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            color: #333;
            transition: all 0.3s ease;
        }

        .qty-btn:hover {
            background: #f0f0f0;
        }

        .qty-input {
            border: none;
            border-left: 1px solid #e0e0e0;
            border-right: 1px solid #e0e0e0;
            width: 60px;
            text-align: center;
            font-weight: 600;
            padding: 12px 0;
        }

        .btn-add-cart {
            flex: 1;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-add-cart:hover {
            background: #065c42;
            transform: translateY(-2px);
        }

        .product-description h5 {
            font-weight: 700;
            margin-bottom: 15px;
            color: #333;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .description-content {
            line-height: 1.8;
            color: #666;
        }

        @media (max-width: 991px) {
            .product-actions {
                flex-direction: column;
            }

            .btn-add-cart {
                width: 100%;
            }

            .product-title {
                font-size: 1.5rem;
            }
        }
    </style>

    <script>
        function changeMainImage(src) {
            document.getElementById('mainImage').src = src;
        }
    </script>
</div>