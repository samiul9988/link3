<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::with(['images', 'variants', 'category', 'brand', 'reviews' => function($q) { $q->where('status', 1)->with('customer'); }])->where('slug', $slug)->firstOrFail();
        $product->increment('total_views');
        $relatedProducts = Product::with('images')->where('category_id', $product->category_id)->where('id', '!=', $product->id)->where('status', 1)->take(8)->get();
        $isWishlisted = false;
        if (auth()->guard('customer')->check()) {
            $isWishlisted = $product->wishlists()->where('customer_id', auth()->guard('customer')->id())->exists();
        }
        return view('frontend.product.detail', compact('product', 'relatedProducts', 'isWishlisted'));
    }

    public function listing(Request $request)
    {
        $query = Product::with(['images', 'brand', 'category'])->where('status', 1);
        if ($request->filled('category')) $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        if ($request->filled('brand')) $query->whereHas('brand', fn($q) => $q->where('slug', $request->brand));
        if ($request->filled('min_price')) $query->where('sale_price', '>=', $request->min_price)->orWhere(function($q) use ($request) { $q->whereNull('sale_price')->where('regular_price', '>=', $request->min_price); });
        if ($request->filled('max_price')) $query->where('sale_price', '<=', $request->max_price)->orWhere(function($q) use ($request) { $q->whereNull('sale_price')->where('regular_price', '<=', $request->max_price); });
        if ($request->filled('in_stock')) $query->where('stock_quantity', '>', 0);

        $sort = $request->sort ?? 'latest';
        switch ($sort) {
            case 'price_low': $query->orderByRaw('COALESCE(sale_price, regular_price) ASC'); break;
            case 'price_high': $query->orderByRaw('COALESCE(sale_price, regular_price) DESC'); break;
            case 'popular': $query->orderBy('total_sold', 'desc'); break;
            case 'top_rated': $query->orderBy('average_rating', 'desc'); break;
            default: $query->latest(); break;
        }

        $products = $query->paginate(20)->appends($request->query());
        $categories = Category::where('status', 1)->orderBy('sort_order')->get();
        $brands = Brand::where('status', 1)->orderBy('sort_order')->get();
        
        $pageTitle = 'All Products';
        if ($request->filled('category')) $pageTitle = 'Category: ' . optional($categories->where('slug', $request->category)->first())->name;
        if ($request->filled('brand')) $pageTitle = 'Brand: ' . optional($brands->where('slug', $request->brand)->first())->name;

        return view('frontend.product.listing', compact('products', 'categories', 'brands', 'pageTitle'));
    }
}
