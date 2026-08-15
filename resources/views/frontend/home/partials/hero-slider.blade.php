<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @forelse($sliders as $index => $slider)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}"></button>
        @empty
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        @endforelse
    </div>

    <div class="carousel-inner">
        @forelse($sliders as $slider)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <div class="hero-slide">
                    @if($slider->image_mobile)
                        <img src="{{ asset($slider->image_desktop) }}" alt="{{ $slider->title }}" class="d-none d-md-block w-100">
                        <img src="{{ asset($slider->image_mobile) }}" alt="{{ $slider->title }}" class="d-block d-md-none w-100">
                    @else
                        <img src="{{ asset($slider->image_desktop) }}" alt="{{ $slider->title }}" class="w-100">
                    @endif
                    <div class="hero-content">
                        <div class="container">
                            <div class="content">
                                @if($slider->subtitle)
                                    <p class="text-white mb-2 fw-medium" style="letter-spacing: 1px;">{{ $slider->subtitle }}</p>
                                @endif
                                <h2 class="text-white mb-3">{{ $slider->title }}</h2>
                                @if($slider->description)
                                    <p class="text-white mb-4">{{ $slider->description }}</p>
                                @endif
                                @if($slider->button_text && $slider->link)
                                    <a href="{{ $slider->link }}" class="btn btn-primary px-4 py-2 fw-medium">{{ $slider->button_text }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="carousel-item active">
                <div class="hero-slide d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #0D9488 0%, #0F766E 100%); min-height: 400px;">
                    <div class="container text-center text-white">
                        <h2 class="fw-bold mb-3">Welcome to {{ setting('site_name', 'Our Store') }}</h2>
                        <p class="mb-4" style="opacity: 0.85;">Discover amazing products at great prices</p>
                        <a href="{{ url('/products') }}" class="btn btn-light px-4 py-2 fw-medium text-primary">Shop Now <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
</div>
