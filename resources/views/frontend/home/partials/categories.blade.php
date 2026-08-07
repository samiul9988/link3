@php
    $featuredCategories = $featuredCategories ?? \App\Models\Category::where('status', 1)->where('is_featured', 1)->whereNull('parent_id')->orderBy('sort_order')->take(8)->get();
@endphp

@if($featuredCategories->count())
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="section-heading mb-0">Shop by Categories</h4>
        <a href="{{ url('/categories') }}" class="view-all-link text-primary">
            View All <i class="fa-solid fa-arrow-right ms-1"></i>
        </a>
    </div>

    <div class="row g-3">
        @foreach($featuredCategories as $category)
            <div class="col-6 col-md-3">
                <a href="{{ url('/category/' . $category->slug) }}" class="category-card">
                    @if($category->image)
                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" loading="lazy">
                    @elseif($category->icon)
                        <div class="d-flex align-items-center justify-content-center mx-auto mb-2 rounded-circle" style="width:60px;height:60px;background:var(--primary-50);">
                            <i class="{{ $category->icon }} fs-4 text-primary"></i>
                        </div>
                    @else
                        <div class="d-flex align-items-center justify-content-center mx-auto mb-2 rounded-circle" style="width:60px;height:60px;background:var(--primary-50);">
                            <i class="fa-solid fa-layer-group fs-4 text-primary"></i>
                        </div>
                    @endif
                    <div class="name">{{ $category->name }}</div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endif
