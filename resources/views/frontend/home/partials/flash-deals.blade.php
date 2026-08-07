@php
    $flashProducts = $flashDeals ?? \App\Models\Product::where('status', 1)->where('is_flash_deal', 1)->where('flash_deal_end', '>', now())->latest()->take(8)->get();
@endphp

@if($flashProducts->count())
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="section-heading mb-0">
                <i class="fa-solid fa-bolt text-warning me-2"></i>Flash Deals
            </h4>
        </div>
        <a href="{{ url('/products?flash_deals=1') }}" class="view-all-link text-primary">
            View All <i class="fa-solid fa-arrow-right ms-1"></i>
        </a>
    </div>

    <div class="row g-3">
        @foreach($flashProducts as $product)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                @include('frontend.partials.product-card', ['product' => $product, 'showFlashTimer' => true])
            </div>
        @endforeach
    </div>
</div>
@endif
