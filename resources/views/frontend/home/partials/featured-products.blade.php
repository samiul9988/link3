@php
    $featuredProducts = $featuredProducts ?? \App\Models\Product::where('status', 1)->where('is_featured', 1)->latest()->take(12)->get();
@endphp

@if($featuredProducts->count())
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="section-heading mb-0">Featured Products</h4>
        <a href="{{ url('/products?featured=1') }}" class="view-all-link text-primary">
            View All <i class="fa-solid fa-arrow-right ms-1"></i>
        </a>
    </div>

    <div class="row g-3">
        @foreach($featuredProducts as $product)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                @include('frontend.partials.product-card', ['product' => $product])
            </div>
        @endforeach
    </div>
</div>
@endif
