<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $query = Product::with(['images', 'brand'])->where('category_id', $category->id)->where('status', 1);
        if ($request->filled('brands') && is_array($request->brands)) {
            $query->whereHas('brand', fn($q) => $q->whereIn('slug', $request->brands));
        } elseif ($request->filled('brand')) {
            $query->whereHas('brand', fn($q) => $q->where('slug', $request->brand));
        }
        if ($request->filled('in_stock')) $query->where('stock_quantity', '>', 0);
        
        $sort = $request->sort ?? 'latest';
        switch ($sort) {
            case 'price_low': $query->orderByRaw('COALESCE(sale_price, regular_price) ASC'); break;
            case 'price_high': $query->orderByRaw('COALESCE(sale_price, regular_price) DESC'); break;
            case 'popular': $query->orderBy('total_sold', 'desc'); break;
            default: $query->latest();
        }
        
        $products = $query->paginate(20)->appends($request->query());
        $brands = Brand::where('status', 1)->get();
        return view('frontend.product.listing', compact('products', 'category', 'brands'))->with('pageTitle', $category->name);
    }
}
