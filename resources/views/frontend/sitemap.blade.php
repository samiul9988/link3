{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    @if(isset($categories))
        @foreach($categories as $category)
            <url>
                <loc>{{ url('/category/' . $category->slug) }}</loc>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endif

    @if(isset($brands))
        @foreach($brands as $brand)
            <url>
                <loc>{{ url('/brand/' . $brand->slug) }}</loc>
                <changefreq>weekly</changefreq>
                <priority>0.7</priority>
            </url>
        @endforeach
    @endif

    @if(isset($products))
        @foreach($products as $product)
            <url>
                <loc>{{ url('/product/' . $product->slug) }}</loc>
                <changefreq>weekly</changefreq>
                <priority>0.6</priority>
                @if($product->updated_at)
                    <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
                @endif
            </url>
        @endforeach
    @endif

    @if(isset($pages))
        @foreach($pages as $page)
            <url>
                <loc>{{ url('/page/' . $page->slug) }}</loc>
                <changefreq>monthly</changefreq>
                <priority>0.5</priority>
            </url>
        @endforeach
    @endif
</urlset>
