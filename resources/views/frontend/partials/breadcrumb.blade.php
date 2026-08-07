@php
    if (!isset($breadcrumbs)) {
        $breadcrumbs = collect();
        $segments = request()->segments();
        $url = '';
        foreach ($segments as $i => $segment) {
            $url .= '/' . $segment;
            $name = ucwords(str_replace(['-', '_'], ' ', $segment));
            if ($i === 0 && $segment === 'product' && isset($product)) {
                $name = $product->name;
            } elseif ($i === 0 && $segment === 'category' && isset($category)) {
                $name = $category->name;
            } elseif ($i === 0 && $segment === 'brand' && isset($brand)) {
                $name = $brand->name;
            } elseif ($i === 0 && $segment === 'page' && isset($page)) {
                $name = $page->title;
            }
            $breadcrumbs->push((object)['name' => $name, 'url' => $url]);
        }
    }
@endphp

@if($breadcrumbs->count())
<nav aria-label="breadcrumb" class="py-2 border-bottom" style="background: #f9fafb;">
    <div class="container">
        <ol class="breadcrumb mb-0" style="font-size: 0.8rem;">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
            @foreach($breadcrumbs as $crumb)
                @if(!$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $crumb->url }}" class="text-decoration-none text-muted">{{ $crumb->name }}</a></li>
                @else
                    <li class="breadcrumb-item active text-dark" aria-current="page">{{ $crumb->name }}</li>
                @endif
            @endforeach
        </ol>
    </div>
</nav>
@endif
