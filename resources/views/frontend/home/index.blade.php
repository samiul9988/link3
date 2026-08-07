@extends('frontend.layouts.app')

@section('content')

@include('frontend.home.partials.hero-slider')

@include('frontend.home.partials.service-bar')

@include('frontend.home.partials.flash-deals')

@include('frontend.home.partials.categories')

@include('frontend.home.partials.featured-products')

@if(!empty($homeBanners) && $homeBanners->count())
<div class="container my-4">
    <div class="row g-3">
        @foreach($homeBanners as $banner)
            <div class="{{ $banner->position == 'full' ? 'col-12' : 'col-md-6' }}">
                <a href="{{ $banner->link ?: '#' }}" class="banner-section d-block">
                    <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}">
                </a>
            </div>
        @endforeach
    </div>
</div>
@endif

@include('frontend.home.partials.brands')

@include('frontend.home.partials.new-arrivals')

@include('frontend.home.partials.best-selling')

@if(!empty($homeMiddleBanners) && $homeMiddleBanners->count())
<div class="container my-4">
    <div class="row g-3">
        @foreach($homeMiddleBanners as $banner)
            <div class="{{ $banner->position == 'full' ? 'col-12' : 'col-md-6' }}">
                <a href="{{ $banner->link ?: '#' }}" class="banner-section d-block">
                    <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}">
                </a>
            </div>
        @endforeach
    </div>
</div>
@endif

@endsection
