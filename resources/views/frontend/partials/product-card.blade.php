<div class="product-card border rounded-lg shadow-sm bg-white h-100 position-relative">
    <div class="image-zoom position-relative" style="aspect-ratio: 1/1;">
        <a href="{{ url('/product/' . $product->slug) }}">
            <img src="{{ asset($product->thumbnail ?? 'placeholder.png') }}" alt="{{ $product->name }}" class="w-100 h-100" style="object-fit: cover;" loading="lazy">
        </a>

        @if($product->sale_price && $product->sale_price < $product->regular_price)
            <span class="badge-discount">-{{ $product->discount_percent }}%</span>
        @endif

        @if(!empty($showNewBadge) && $product->is_new_arrival)
            <span class="badge-new">New</span>
        @endif

        @if(!empty($showFlashTimer) && $product->is_flash_deal && $product->flash_deal_end)
            <span class="badge-flash">
                <i class="fa-solid fa-bolt me-1"></i> Flash
            </span>
        @endif

        <div class="wishlist-btn" data-product-id="{{ $product->id }}">
            <i class="{{ auth()->guard('customer')->check() && $product->wishlists()->where('customer_id', auth()->guard('customer')->id())->exists() ? 'fa-solid' : 'fa-regular' }} fa-heart {{ auth()->guard('customer')->check() && $product->wishlists()->where('customer_id', auth()->guard('customer')->id())->exists() ? 'active' : '' }}"></i>
        </div>

        <div class="position-absolute bottom-0 start-0 end-0 p-2 d-flex gap-1" style="background: linear-gradient(transparent, rgba(0,0,0,0.05)); opacity: 0; transition: opacity 0.3s;">
            <button class="btn btn-primary btn-sm w-100 add-to-cart-btn" data-product-id="{{ $product->id }}" style="font-size: 0.75rem; border-radius: 4px;">
                <i class="fa-solid fa-basket-shopping me-1"></i> Add to Cart
            </button>
        </div>
    </div>

    <div class="p-2 d-flex flex-column" style="flex:1;">
        @if($product->brand)
            <small class="text-muted mb-1" style="font-size:0.65rem;">{{ $product->brand->name }}</small>
        @endif

        <a href="{{ url('/product/' . $product->slug) }}" class="text-decoration-none text-dark">
            <h6 class="mb-1 fw-medium" style="font-size: 0.8rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                {{ $product->name }}
            </h6>
        </a>

        <div class="mt-auto">
            <div class="d-flex align-items-center gap-1 mb-1">
                <span class="rating-stars">
                    @php $rating = $product->average_rating ?? 0; @endphp
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($rating))
                            <i class="fa-solid fa-star"></i>
                        @elseif($i - 0.5 <= $rating)
                            <i class="fa-solid fa-star-half-stroke"></i>
                        @else
                            <i class="fa-regular fa-star empty"></i>
                        @endif
                    @endfor
                </span>
                @if($product->total_reviews)
                    <small class="text-muted" style="font-size:0.6rem;">({{ $product->total_reviews }})</small>
                @endif
            </div>

            <div class="d-flex align-items-center gap-2">
                @if($product->sale_price && $product->sale_price < $product->regular_price)
                    <span class="fw-bold text-primary" style="font-size:0.9rem;">৳{{ number_format($product->sale_price, 0) }}</span>
                    <small class="text-muted text-decoration-line-through" style="font-size:0.7rem;">৳{{ number_format($product->regular_price, 0) }}</small>
                @else
                    <span class="fw-bold text-primary" style="font-size:0.9rem;">৳{{ number_format($product->regular_price, 0) }}</span>
                @endif
            </div>

            @if(!empty($showFlashTimer) && $product->is_flash_deal && $product->flash_deal_end)
                <div class="flash-timer mt-1" data-end="{{ $product->flash_deal_end->timestamp }}" data-product="{{ $product->id }}">
                    <i class="fa-regular fa-clock"></i> <span class="countdown"></span>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .product-card:hover .position-absolute.bottom-0.start-0.end-0 {
        opacity: 1 !important;
    }
    .product-card:hover .wishlist-btn {
        opacity: 1 !important;
    }
    @media (max-width: 767px) {
        .product-card .position-absolute.bottom-0.start-0.end-0 {
            opacity: 1 !important;
        }
    }
</style>
