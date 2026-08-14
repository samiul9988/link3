@extends('frontend.layouts.app')

@php
    $pageTitle = $product->name ?? 'Product Details';
@endphp

@section('title', $pageTitle . ' - ' . ($product->meta_title ?? $pageTitle))

@push('styles')
<style>
    .main-image-wrapper {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
        background: #f9fafb;
        aspect-ratio: 1 / 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .main-image-wrapper img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
    .thumbnail-item {
        width: 70px;
        height: 70px;
        border: 2px solid #e5e7eb;
        border-radius: 6px;
        overflow: hidden;
        cursor: pointer;
        transition: border-color 0.2s;
        flex-shrink: 0;
    }
    .thumbnail-item:hover,
    .thumbnail-item.active {
        border-color: var(--primary);
    }
    .thumbnail-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .product-detail-page h2 {
        font-weight: 700;
        font-size: 1.5rem;
        color: #1f2937;
    }
    .stock-badge {
        display: inline-block;
        padding: 0.2rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .stock-badge.in-stock {
        background: #dcfce7;
        color: #15803d;
    }
    .stock-badge.out-of-stock {
        background: #fef2f2;
        color: #dc2626;
    }
    .quantity-selector {
        display: inline-flex;
        align-items: center;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        overflow: hidden;
    }
    .quantity-selector button {
        width: 38px;
        height: 38px;
        border: none;
        background: #f9fafb;
        color: #374151;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .quantity-selector button:hover {
        background: #e5e7eb;
    }
    .quantity-selector input {
        width: 50px;
        height: 38px;
        border: none;
        border-left: 1px solid #e5e7eb;
        border-right: 1px solid #e5e7eb;
        text-align: center;
        font-size: 0.9rem;
        font-weight: 500;
        -moz-appearance: textfield;
    }
    .quantity-selector input::-webkit-outer-spin-button,
    .quantity-selector input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .variant-option {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        height: 38px;
        padding: 0 0.85rem;
        border: 2px solid #e5e7eb;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.2s;
        background: #fff;
    }
    .variant-option:hover {
        border-color: var(--primary);
    }
    .variant-option.active {
        border-color: var(--primary);
        background: var(--primary-50);
        color: var(--primary-dark);
    }
    .variant-option input {
        display: none;
    }
    .discount-badge {
        display: inline-block;
        background: #fef2f2;
        color: #dc2626;
        padding: 0.15rem 0.6rem;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .share-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 1px solid #e5e7eb;
        color: #6b7280;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.2s;
    }
    .share-btn:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
    }
    .wishlist-heart {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border: 2px solid #e5e7eb;
        border-radius: 50%;
        cursor: pointer;
        font-size: 1.1rem;
        color: #9ca3af;
        background: #fff;
        transition: all 0.2s;
    }
    .wishlist-heart:hover,
    .wishlist-heart.active {
        border-color: #ef4444;
        color: #ef4444;
    }
    .nav-tabs .nav-link {
        color: #6b7280;
        font-weight: 500;
        font-size: 0.9rem;
        border: none;
        padding: 0.75rem 1.25rem;
        position: relative;
    }
    .nav-tabs .nav-link.active {
        color: var(--primary);
        background: transparent;
        border-bottom: 2px solid var(--primary);
    }
    .nav-tabs .nav-link:hover {
        color: var(--primary);
        border-color: transparent;
    }
    .review-item {
        border-bottom: 1px solid #f3f4f6;
        padding: 1rem 0;
    }
    .review-item:last-child {
        border-bottom: none;
    }
    .star-rating-input {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 0.15rem;
    }
    .star-rating-input input {
        display: none;
    }
    .star-rating-input label {
        cursor: pointer;
        color: #d1d5db;
        font-size: 1.25rem;
        transition: color 0.15s;
    }
    .star-rating-input input:checked ~ label,
    .star-rating-input label:hover,
    .star-rating-input label:hover ~ label {
        color: #f59e0b;
    }
    @@media (max-width: 767px) {
        .product-detail-page h2 {
            font-size: 1.2rem;
        }
        .thumbnail-item {
            width: 55px;
            height: 55px;
        }
    }
</style>
@endpush

@section('content')

@php
    $breadcrumbs = collect([
        (object)['name' => 'Home', 'url' => url('/')],
    ]);

    if (isset($category) && $category) {
        $breadcrumbs->push((object)['name' => $category->name, 'url' => url('/category/' . $category->slug)]);
    }

    $breadcrumbs->push((object)['name' => $product->name, 'url' => '#']);
@endphp

@include('frontend.partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])

<div class="container py-4 product-detail-page">
    <div class="row g-4 mb-5">
        <div class="col-lg-5">
            <div class="main-image-wrapper mb-3" id="mainImageWrapper">
                @php $images = $product->images ?? collect(); @endphp
                @if($images->count())
                    <img src="{{ asset($images->first()->path ?? $images->first()->image) }}"
                         alt="{{ $product->name }}" id="mainImage">
                @else
                    <img src="{{ asset($product->thumbnail ?? 'placeholder.png') }}"
                         alt="{{ $product->name }}" id="mainImage">
                @endif
            </div>

            @if($images->count() > 1)
                <div class="d-flex gap-2 overflow-auto pb-2" id="thumbnailRow">
                    @foreach($images as $index => $image)
                        <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}"
                             data-image="{{ asset($image->path ?? $image->image) }}">
                            <img src="{{ asset($image->path ?? $image->image) }}"
                                 alt="{{ $product->name }} - {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="col-lg-7">
            <h2 class="mb-2">{{ $product->name }}</h2>

            <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                @if($product->brand)
                    <a href="{{ url('/brand/' . $product->brand->slug) }}" class="text-decoration-none small text-muted">
                        <i class="fa-solid fa-tag me-1"></i> {{ $product->brand->name }}
                    </a>
                    <span class="text-muted">|</span>
                @endif
                @if(isset($category) && $category)
                    <a href="{{ url('/category/' . $category->slug) }}" class="text-decoration-none small text-muted">
                        <i class="fa-solid fa-folder me-1"></i> {{ $category->name }}
                    </a>
                @endif
            </div>

            <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                <small class="text-muted"><strong>SKU:</strong> {{ $product->sku ?? 'N/A' }}</small>
                @php $stockClass = ($product->stock_quantity ?? 0) > 0 ? 'in-stock' : 'out-of-stock'; @endphp
                @php $stockText = ($product->stock_quantity ?? 0) > 0 ? 'In Stock' : 'Out of Stock'; @endphp
                <span class="stock-badge {{ $stockClass }}">{{ $stockText }}</span>
            </div>

            <div class="mb-3">
                @if($product->sale_price && $product->sale_price < $product->regular_price)
                    <span class="text-muted text-decoration-line-through me-2" style="font-size: 1.1rem;">
                        ৳{{ number_format($product->regular_price, 0) }}
                    </span>
                    <span class="text-primary fw-bold me-2" style="font-size: 1.6rem;" id="displayPrice">
                        ৳{{ number_format($product->sale_price, 0) }}
                    </span>
                    <span class="discount-badge">-{{ $product->discount_percent ?? round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100) }}%</span>
                    <input type="hidden" id="baseRegularPrice" value="{{ $product->regular_price }}">
                    <input type="hidden" id="baseSalePrice" value="{{ $product->sale_price }}">
                @else
                    <span class="text-primary fw-bold" style="font-size: 1.6rem;" id="displayPrice">
                        ৳{{ number_format($product->regular_price, 0) }}
                    </span>
                    <input type="hidden" id="baseRegularPrice" value="{{ $product->regular_price }}">
                    <input type="hidden" id="baseSalePrice" value="">
                @endif
            </div>

            @if(isset($variants) && $variants->count())
                @php $groupedVariants = $variants->groupBy('variant_type'); @endphp
                @foreach($groupedVariants as $variantType => $vars)
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted mb-2">{{ ucfirst($variantType) }}</label>
                        <div class="d-flex flex-wrap gap-2 variant-group" data-variant-type="{{ $variantType }}">
                            @foreach($vars as $variant)
                                <label class="variant-option {{ $loop->first ? 'active' : '' }}"
                                       data-variant-id="{{ $variant->id }}"
                                       data-price="{{ $variant->sale_price ?? $variant->regular_price }}"
                                       data-regular-price="{{ $variant->regular_price }}"
                                       data-sale-price="{{ $variant->sale_price ?? '' }}">
                                    <input type="radio" name="variant[{{ $variantType }}]"
                                           value="{{ $variant->id }}" {{ $loop->first ? 'checked' : '' }}>
                                    {{ $variant->variant_value ?? $variant->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="d-flex align-items-center gap-3 mb-4">
                <span class="fw-semibold small text-muted">Quantity:</span>
                <div class="quantity-selector">
                    <button type="button" id="qtyMinus"><i class="fa-solid fa-minus"></i></button>
                    <input type="number" id="quantity" value="1" min="1" max="{{ $product->stock_quantity ?? 99 }}" readonly>
                    <button type="button" id="qtyPlus"><i class="fa-solid fa-plus"></i></button>
                </div>
            </div>

            <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                <button class="btn btn-primary btn-lg px-4 add-to-cart-detail" id="addToCartBtn"
                        data-product-id="{{ $product->id }}"
                        {{ ($product->stock_quantity ?? 0) <= 0 ? 'disabled' : '' }}>
                    <i class="fa-solid fa-basket-shopping me-2"></i> Add to Cart
                </button>
                <a href="{{ url('/cart') }}" class="btn btn-outline-primary btn-lg px-4 buy-now-btn" id="buyNowBtn">
                    <i class="fa-solid fa-bolt me-2"></i> Buy Now
                </a>
                <button class="wishlist-heart {{ $isWishlisted ?? false ? 'active' : '' }}"
                        data-product-id="{{ $product->id }}" id="wishlistBtn">
                    <i class="{{ $isWishlisted ?? false ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                </button>
            </div>

            <div class="d-flex align-items-center gap-2">
                <span class="small text-muted me-1">Share:</span>
                @php
                    $shareUrl = urlencode(url()->current());
                    $shareTitle = urlencode($product->name);
                @endphp
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" class="share-btn" title="Facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" class="share-btn" title="Twitter">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
                <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank" class="share-btn" title="WhatsApp">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
                <button class="share-btn" onclick="copyProductLink()" title="Copy Link">
                    <i class="fa-solid fa-link"></i>
                </button>
            </div>
        </div>
    </div>

    @if(!empty($product->full_description) || (isset($reviews) && $reviews->count()))
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs mb-4" id="productTabs" role="tablist">
                    @if(!empty($product->full_description))
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description" type="button" role="tab">
                                Description
                            </button>
                        </li>
                    @endif
                    @if(isset($reviews) && $reviews->count())
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ empty($product->full_description) ? 'active' : '' }}"
                                    id="reviews-tab" data-bs-toggle="tab"
                                    data-bs-target="#reviews" type="button" role="tab">
                                Reviews ({{ $reviews->count() }})
                            </button>
                        </li>
                    @endif
                </ul>

                <div class="tab-content" id="productTabsContent">
                    @if(!empty($product->full_description))
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="p-3 bg-white rounded shadow-sm" style="line-height: 1.8;">
                                {!! $product->full_description !!}
                            </div>
                        </div>
                    @endif

                    @if(isset($reviews) && $reviews->count())
                        <div class="tab-pane fade {{ empty($product->full_description) ? 'show active' : '' }}" id="reviews" role="tabpanel">
                            <div class="p-3 bg-white rounded shadow-sm">
                                @foreach($reviews as $review)
                                    <div class="review-item">
                                        <div class="d-flex justify-content-between align-items-start mb-1">
                                            <div>
                                                <strong class="me-2">{{ $review->customer->name ?? 'Anonymous' }}</strong>
                                                <span class="rating-stars" style="font-size: 0.8rem;">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $review->rating)
                                                            <i class="fa-solid fa-star"></i>
                                                        @else
                                                            <i class="fa-regular fa-star empty"></i>
                                                        @endif
                                                    @endfor
                                                </span>
                                            </div>
                                            <small class="text-muted">{{ $review->created_at ? $review->created_at->format('M d, Y') : '' }}</small>
                                        </div>
                                        <p class="mb-0 small text-secondary">{{ $review->comment }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @elseif(!empty($product->full_description))
        <div class="row mt-4">
            <div class="col-12">
                <h5 class="fw-semibold mb-3">Description</h5>
                <div class="p-3 bg-white rounded shadow-sm" style="line-height: 1.8;">
                    {!! $product->full_description !!}
                </div>
            </div>
        </div>
    @endif
</div>

@if(isset($relatedProducts) && $relatedProducts->count())
    <div class="container pb-5">
        <h4 class="section-heading">Related Products</h4>
        @include('frontend.product.partials.product-grid', ['products' => $relatedProducts])
    </div>
@endif

@if(isset($recentlyViewed) && $recentlyViewed->count())
    <div class="container pb-5">
        <h4 class="section-heading">Recently Viewed</h4>
        @include('frontend.product.partials.product-grid', ['products' => $recentlyViewed])
    </div>
@endif

<script type="application/ld+json">
{
    "@@context": "https://schema.org/",
    "@@type": "Product",
    "name": "{{ $product->name }}",
    "description": "{{ Str::limit(strip_tags($product->full_description ?? ''), 300) }}",
    "sku": "{{ $product->sku ?? '' }}",
    "brand": {
        "@@type": "Brand",
        "name": "{{ $product->brand->name ?? '' }}"
    },
    "offers": {
        "@@type": "Offer",
        "price": "{{ $product->sale_price ?? $product->regular_price }}",
        "priceCurrency": "BDT",
        "availability": "{{ ($product->stock_quantity ?? 0) > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}"
    },
    "image": "{{ asset($product->thumbnail ?? 'placeholder.png') }}"
}
</script>

@push('scripts')
<script>
    $(function() {
        const maxQty = {{ $product->stock_quantity ?? 99 }};
        const $qtyInput = $('#quantity');
        const $mainImage = $('#mainImage');

        $('#qtyPlus').on('click', function() {
            let val = parseInt($qtyInput.val());
            if (val < maxQty) {
                $qtyInput.val(val + 1);
            }
        });

        $('#qtyMinus').on('click', function() {
            let val = parseInt($qtyInput.val());
            if (val > 1) {
                $qtyInput.val(val - 1);
            }
        });

        $('.thumbnail-item').on('click', function() {
            $('.thumbnail-item').removeClass('active');
            $(this).addClass('active');
            $mainImage.attr('src', $(this).data('image'));
        });

        $('.variant-option').on('click', function() {
            const group = $(this).closest('.variant-group');
            group.find('.variant-option').removeClass('active');
            $(this).addClass('active');
            group.find('input[type="radio"]').prop('checked', false);
            $(this).find('input[type="radio"]').prop('checked', true);
            updatePriceFromVariants();
        });

        function getSelectedVariantId() {
            return $('.variant-option.active').first().data('variant-id') || null;
        }

        function getSelectedVariantData() {
            const active = $('.variant-option.active').first();
            return {
                id: active.data('variant-id'),
                price: active.data('price'),
            };
        }

        function updatePriceFromVariants() {
            const active = $('.variant-option.active').first();
            if (!active.length) return;

            const salePrice = active.data('sale-price');
            const regularPrice = active.data('regular-price');

            if (salePrice && parseFloat(salePrice) < parseFloat(regularPrice)) {
                $('#displayPrice').html('৳' + parseFloat(salePrice).toLocaleString('en-IN'));
            } else {
                $('#displayPrice').html('৳' + parseFloat(regularPrice).toLocaleString('en-IN'));
            }
        }

        $('#addToCartBtn').on('click', function(e) {
            e.preventDefault();
            const btn = $(this);
            const productId = btn.data('product-id');
            const variantId = getSelectedVariantId();
            const quantity = parseInt($qtyInput.val());

            btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-2"></i> Adding...');

            $.ajax({
                url: '{{ url("/cart/add") }}',
                method: 'POST',
                data: {
                    product_id: productId,
                    variant_id: variantId,
                    quantity: quantity
                },
                success: function(res) {
                    showToast(res.message || 'Added to cart!');
                    if (res.count !== undefined) {
                        $('.cart-count').text(res.count);
                    }
                    btn.html('<i class="fa-solid fa-basket-shopping me-2"></i> Add to Cart').prop('disabled', false);
                },
                error: function(xhr) {
                    const msg = xhr.responseJSON?.message || 'Something went wrong';
                    showToast(msg, 'error');
                    btn.html('<i class="fa-solid fa-basket-shopping me-2"></i> Add to Cart').prop('disabled', false);
                }
            });
        });

        $('#buyNowBtn').on('click', function(e) {
            e.preventDefault();
            const btn = $(this);
            const productId = {{ $product->id }};
            const variantId = getSelectedVariantId();
            const quantity = parseInt($qtyInput.val());

            btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-2"></i>');

            $.ajax({
                url: '{{ url("/cart/add") }}',
                method: 'POST',
                data: {
                    product_id: productId,
                    variant_id: variantId,
                    quantity: quantity
                },
                success: function(res) {
                    window.location.href = '{{ url("/cart") }}';
                },
                error: function(xhr) {
                    const msg = xhr.responseJSON?.message || 'Something went wrong';
                    showToast(msg, 'error');
                    btn.html('<i class="fa-solid fa-bolt me-2"></i> Buy Now').prop('disabled', false);
                }
            });
        });

        $('#wishlistBtn').on('click', function(e) {
            e.preventDefault();
            const btn = $(this);
            const productId = btn.data('product-id');
            const isLoggedIn = {{ auth()->guard('customer')->check() ? 'true' : 'false' }};

            if (!isLoggedIn) {
                showToast('Please login to add to wishlist', 'error');
                return;
            }

            $.ajax({
                url: '{{ url("/account/wishlist/toggle") }}',
                method: 'POST',
                data: { product_id: productId },
                success: function(res) {
                    btn.toggleClass('active');
                    btn.find('i').toggleClass('fa-regular fa-solid');
                    showToast(res.message);
                },
                error: function() {
                    showToast('Something went wrong', 'error');
                }
            });
        });

        storeRecentlyViewed({{ $product->id }}, '{{ $product->name }}', '{{ asset($product->thumbnail ?? 'placeholder.png') }}', '{{ url('/product/' . $product->slug) }}', '{{ $product->sale_price ?? $product->regular_price }}');
    });

    function copyProductLink() {
        const url = window.location.href;
        if (navigator.clipboard) {
            navigator.clipboard.writeText(url).then(function() {
                showToast('Link copied to clipboard!');
            });
        } else {
            const textArea = document.createElement('textarea');
            textArea.value = url;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            showToast('Link copied to clipboard!');
        }
    }

    function storeRecentlyViewed(id, name, image, url, price) {
        try {
            let viewed = JSON.parse(localStorage.getItem('recentlyViewed') || '[]');
            viewed = viewed.filter(function(item) { return item.id !== id; });
            viewed.unshift({ id: id, name: name, image: image, url: url, price: price });
            if (viewed.length > 20) viewed = viewed.slice(0, 20);
            localStorage.setItem('recentlyViewed', JSON.stringify(viewed));
        } catch (e) {}
    }
</script>
@endpush

@endsection
