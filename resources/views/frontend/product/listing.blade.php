@extends('frontend.layouts.app')

@section('title', $pageTitle ?? 'Products')

@push('styles')
<style>
    .page-banner {
        background-color: var(--primary);
        padding: 2.5rem 0;
    }
    .page-banner h3 {
        color: #fff;
        font-weight: 700;
        margin-bottom: 0;
    }
    .filter-sidebar .card {
        border-radius: 8px;
    }
    .top-bar {
        background: #fff;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 1px solid #e5e7eb;
    }
    .top-bar select.form-select {
        width: auto;
        min-width: 180px;
        font-size: 0.85rem;
    }
    .active-filter-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: var(--primary-50);
        color: var(--primary-dark);
        border: 1px solid var(--primary-light);
        padding: 0.25rem 0.6rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        text-decoration: none;
    }
    .active-filter-badge:hover {
        background: #e6f7f0;
        color: var(--primary-dark);
    }
    .active-filter-badge .remove {
        font-size: 0.85rem;
        cursor: pointer;
        opacity: 0.7;
    }
    .active-filter-badge .remove:hover {
        opacity: 1;
    }
    .pagination .page-link {
        color: var(--primary);
        font-size: 0.85rem;
    }
    .pagination .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    @media (max-width: 991px) {
        .filter-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 300px;
            height: 100vh;
            z-index: 1050;
            background: #fff;
            overflow-y: auto;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            padding: 1rem;
            box-shadow: 2px 0 15px rgba(0,0,0,0.1);
        }
        .filter-sidebar.open {
            transform: translateX(0);
        }
        .filter-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 1040;
        }
        .filter-overlay.open {
            display: block;
        }
    }
</style>
@endpush

@section('content')

<div class="page-banner">
    <div class="container">
        <h3>{{ $pageTitle ?? 'Products' }}</h3>
    </div>
</div>

@php
    $breadcrumbs = collect([
        (object)['name' => 'Home', 'url' => url('/')],
    ]);

    if (request('category') && isset($categoryName)) {
        $breadcrumbs->push((object)['name' => $categoryName, 'url' => url('/category/' . request('category'))]);
    }

    $breadcrumbs->push((object)['name' => $pageTitle ?? 'Products', 'url' => '#']);
@endphp

@include('frontend.partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])

<div class="container py-4">
    <div class="row g-4">
        <div class="d-lg-none mb-2">
            <button class="btn btn-outline-primary btn-sm" id="filterToggleBtn">
                <i class="fa-solid fa-sliders me-1"></i> Filters
            </button>
        </div>

        <div class="filter-overlay" id="filterOverlay"></div>

        <div class="col-lg-3 filter-sidebar" id="filterSidebar">
            <div class="d-flex justify-content-between align-items-center d-lg-none mb-3">
                <h6 class="mb-0 fw-semibold">Filters</h6>
                <button class="btn-close" id="filterCloseBtn"></button>
            </div>
            @include('frontend.product.partials.filters', [
                'categories' => $categories ?? collect(),
                'brands' => $brands ?? collect(),
            ])
        </div>

        <div class="col-lg-9">
            <div class="top-bar d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                <div>
                    <span class="text-muted" style="font-size: 0.85rem;">
                        Showing <strong>{{ $products->firstItem() ?? 0 }}</strong>–<strong>{{ $products->lastItem() ?? 0 }}</strong>
                        of <strong>{{ $products->total() }}</strong> results
                    </span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <label for="sortBy" class="form-label mb-0 text-muted" style="font-size: 0.8rem; white-space: nowrap;">Sort by:</label>
                    <select id="sortBy" class="form-select form-select-sm" onchange="updateSort(this.value)">
                        <option value="latest" {{ request('sort') == 'latest' || !request('sort') ? 'selected' : '' }}>Latest</option>
                        <option value="price_low_high" {{ request('sort') == 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high_low" {{ request('sort') == 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popular</option>
                        <option value="top_rated" {{ request('sort') == 'top_rated' ? 'selected' : '' }}>Top Rated</option>
                    </select>
                </div>
            </div>

            @php
                $activeFilters = [];
                if (request('category') && isset($categoryName)) {
                    $activeFilters[] = [
                        'label' => 'Category: ' . $categoryName,
                        'remove_param' => 'category',
                    ];
                }
                $brandsInput = request('brands', '');
                $activeBrands = is_array($brandsInput) ? array_filter($brandsInput) : array_filter(explode(',', $brandsInput));
                foreach ($activeBrands as $bslug) {
                    $bname = $brands->firstWhere('slug', $bslug)?->name ?? $bslug;
                    $activeFilters[] = [
                        'label' => 'Brand: ' . $bname,
                        'remove_param' => 'brands',
                        'remove_value' => $bslug,
                    ];
                }
                if (request('in_stock')) {
                    $activeFilters[] = [
                        'label' => 'In Stock Only',
                        'remove_param' => 'in_stock',
                    ];
                }
                if (request('min_price')) {
                    $activeFilters[] = [
                        'label' => 'Min: ৳' . number_format(request('min_price')),
                        'remove_param' => 'min_price',
                    ];
                }
                if (request('max_price')) {
                    $activeFilters[] = [
                        'label' => 'Max: ৳' . number_format(request('max_price')),
                        'remove_param' => 'max_price',
                    ];
                }
            @endphp

            @if(count($activeFilters))
                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                    <small class="text-muted fw-medium" style="font-size: 0.8rem;">Active Filters:</small>
                    @foreach($activeFilters as $filter)
                        @php
                            $params = request()->except('page');
                            if (isset($filter['remove_value'])) {
                                $current = $params[$filter['remove_param']] ?? '';
                                $currentArr = is_array($current) ? $current : array_filter(explode(',', $current));
                                $remaining = array_diff($currentArr, [$filter['remove_value']]);
                                if (count($remaining)) {
                                    $params[$filter['remove_param']] = array_values($remaining);
                                } else {
                                    unset($params[$filter['remove_param']]);
                                }
                            } else {
                                unset($params[$filter['remove_param']]);
                            }
                        @endphp
                        <a href="{{ url()->current() }}?{{ http_build_query($params) }}" class="active-filter-badge text-decoration-none">
                            {{ $filter['label'] }}
                            <span class="remove">&times;</span>
                        </a>
                    @endforeach
                    <a href="{{ url()->current() }}" class="text-muted small text-decoration-none" style="font-size: 0.75rem;">Clear All</a>
                </div>
            @endif

            @include('frontend.product.partials.product-grid', ['products' => $products])

            @if($products->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    function updateSort(value) {
        const url = new URL(window.location.href);
        url.searchParams.set('sort', value);
        url.searchParams.delete('page');
        window.location.href = url.toString();
    }

    $(function() {
        const $sidebar = $('#filterSidebar');
        const $overlay = $('#filterOverlay');

        $('#filterToggleBtn').on('click', function() {
            $sidebar.addClass('open');
            $overlay.addClass('open');
            $('body').css('overflow', 'hidden');
        });

        function closeFilters() {
            $sidebar.removeClass('open');
            $overlay.removeClass('open');
            $('body').css('overflow', '');
        }

        $('#filterCloseBtn, #filterOverlay').on('click', closeFilters);
    });
</script>
@endpush

@endsection
