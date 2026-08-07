<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
    @forelse($products as $product)
        <div class="col">
            @include('frontend.partials.product-card', ['product' => $product])
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <div class="mb-3">
                <i class="fa-solid fa-box-open text-muted" style="font-size: 3rem;"></i>
            </div>
            <h5 class="text-muted">No products found</h5>
            <p class="text-muted small">Try adjusting your filters or search criteria.</p>
            <a href="{{ url()->current() }}" class="btn btn-outline-primary btn-sm">
                <i class="fa-solid fa-rotate me-1"></i> Clear Filters
            </a>
        </div>
    @endforelse
</div>
