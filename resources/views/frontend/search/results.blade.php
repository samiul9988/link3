@extends('frontend.layouts.app')

@php
    $keyword = request()->get('search', request()->get('q', ''));
    $pageTitle = 'Search Results for: ' . $keyword;
    $metaDescription = 'Search results for "' . $keyword . '" — find products at ' . setting('site_name', 'E-Commerce');
@endphp

@section('content')
<div class="bg-primary text-white py-4">
    <div class="container">
        <h4 class="fw-bold mb-0">Search Results for: "{{ $keyword }}"</h4>
        @if(isset($products))
            <small class="text-white-50">{{ $products->total() }} product(s) found</small>
        @endif
    </div>
</div>

<div class="container py-4">
    @if(isset($products) && $products->count())
        <div class="row g-3">
            @foreach($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('frontend.partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>

        @if($products instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-5">
            <i class="fa-solid fa-magnifying-glass fa-3x text-muted mb-3"></i>
            <h5 class="fw-semibold">No products found for "{{ $keyword }}"</h5>
            <p class="text-muted mb-4">Try checking your spelling or use more general terms.</p>
            <div class="d-flex justify-content-center gap-2 flex-wrap">
                <a href="{{ url('/products') }}" class="btn btn-primary">Browse All Products</a>
                <a href="{{ url('/') }}" class="btn btn-outline-secondary">Go to Home</a>
            </div>
        </div>
    @endif
</div>
@endsection
