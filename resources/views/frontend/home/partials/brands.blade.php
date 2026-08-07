@php
    $brands = $brands ?? \App\Models\Brand::where('status', 1)->where('is_featured', 1)->orderBy('sort_order')->get();
@endphp

@if($brands->count())
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="section-heading mb-0">Top Brands</h4>
        <a href="{{ url('/brands') }}" class="view-all-link text-primary">
            View All <i class="fa-solid fa-arrow-right ms-1"></i>
        </a>
    </div>

    <div id="brandsCarousel" class="carousel slide" data-bs-ride="false">
        <div class="carousel-inner">
            @foreach($brands->chunk(6) as $chunkIndex => $chunk)
                <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                    <div class="row g-3 justify-content-center">
                        @foreach($chunk as $brand)
                            <div class="col-4 col-md-2">
                                <a href="{{ url('/brand/' . $brand->slug) }}" class="brand-logo text-decoration-none">
                                    @if($brand->logo)
                                        <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}" loading="lazy">
                                    @else
                                        <span class="fw-semibold text-muted" style="font-size:0.8rem;">{{ $brand->name }}</span>
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        @if($brands->count() > 6)
            <button class="carousel-control-prev" type="button" data-bs-target="#brandsCarousel" data-bs-slide="prev" style="width:40px;">
                <span class="carousel-control-prev-icon bg-dark rounded-circle" style="width:30px;height:30px;"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#brandsCarousel" data-bs-slide="next" style="width:40px;">
                <span class="carousel-control-next-icon bg-dark rounded-circle" style="width:30px;height:30px;"></span>
            </button>
        @endif
    </div>
</div>
@endif
