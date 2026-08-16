<form id="filterForm" method="GET" action="{{ url()->current() }}">
    @php
        $activeCategory = request('category');
        $brandsInput = request('brands', '');
        $activeBrands = is_array($brandsInput) ? array_filter($brandsInput) : array_filter(explode(',', $brandsInput));
        $inStockOnly = request('in_stock');
        $minPrice = request('min_price');
        $maxPrice = request('max_price');
    @endphp

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="mb-0 fw-semibold">Categories</h6>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                <a href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except(['category', 'page']), [])) }}"
                   class="list-group-item list-group-item-action border-0 {{ !$activeCategory ? 'active' : '' }}"
                   style="{{ !$activeCategory ? 'background-color: var(--primary); border-color: var(--primary);' : '' }}">
                    All Categories
                </a>
                @foreach($categories as $cat)
                    <a href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['category' => $cat->slug])) }}"
                       class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center {{ $activeCategory == $cat->slug ? 'active' : '' }}"
                       style="{{ $activeCategory == $cat->slug ? 'background-color: var(--primary); border-color: var(--primary);' : '' }}">
                        {{ $cat->name }}
                        <span class="badge rounded-pill {{ $activeCategory == $cat->slug ? 'bg-white text-primary' : 'bg-light text-muted' }}">{{ $cat->products_count ?? 0 }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="mb-0 fw-semibold">Brands</h6>
        </div>
        <div class="card-body">
            @foreach($brands as $brand)
                <div class="form-check mb-2">
                    <input class="form-check-input filter-trigger" type="checkbox" name="brands[]"
                           value="{{ $brand->slug }}" id="brand_{{ $brand->id }}"
                           {{ in_array($brand->slug, $activeBrands) ? 'checked' : '' }}
                           onchange="this.form.submit()">
                    <label class="form-check-label d-flex justify-content-between w-100" for="brand_{{ $brand->id }}" style="font-size: 0.85rem;">
                        <span>{{ $brand->name }}</span>
                        <small class="text-muted">({{ $brand->products_count ?? 0 }})</small>
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="mb-0 fw-semibold">Availability</h6>
        </div>
        <div class="card-body">
            <div class="form-check">
                <input class="form-check-input filter-trigger" type="checkbox" name="in_stock" value="1"
                       id="inStock" {{ $inStockOnly ? 'checked' : '' }}
                       onchange="this.form.submit()">
                <label class="form-check-label" for="inStock" style="font-size: 0.85rem;">
                    In Stock Only
                </label>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white border-bottom py-3">
            <h6 class="mb-0 fw-semibold">Price Range</h6>
        </div>
        <div class="card-body">
            <div class="row g-2">
                <div class="col-6">
                    <input type="number" name="min_price" class="form-control form-control-sm" placeholder="Min"
                           value="{{ $minPrice }}" min="0" step="1">
                </div>
                <div class="col-6">
                    <input type="number" name="max_price" class="form-control form-control-sm" placeholder="Max"
                           value="{{ $maxPrice }}" min="0" step="1">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm w-100 mt-2">
                <i class="fa-solid fa-filter me-1"></i> Apply Filter
            </button>
        </div>
    </div>
</form>

<style>
    .list-group-item.active {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
    }
    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }
</style>
