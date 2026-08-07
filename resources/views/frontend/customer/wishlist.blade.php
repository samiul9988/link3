@extends('frontend.layouts.app')

@php
    $pageTitle = 'My Wishlist';
@endphp

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-3">
            @include('frontend.customer.partials.sidebar')
        </div>

        <div class="col-lg-9">
            <h4 class="fw-bold mb-4">My Wishlist</h4>

            @if(isset($wishlistItems) && $wishlistItems->count())
                <div class="row g-3">
                    @foreach($wishlistItems as $item)
                        <div class="col-6 col-md-4 col-lg-3">
                            @include('frontend.partials.product-card', ['product' => $item->product, 'showAddToCart' => true])
                        </div>
                    @endforeach
                </div>

                @if($wishlistItems instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                    <div class="d-flex justify-content-center mt-4">
                        {{ $wishlistItems->links() }}
                    </div>
                @endif
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fa-regular fa-heart fa-3x text-muted mb-3"></i>
                        <h5 class="fw-semibold">No items in wishlist</h5>
                        <p class="text-muted">Save your favorite products here to find them later.</p>
                        <a href="{{ url('/products') }}" class="btn btn-primary">Browse Products</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
