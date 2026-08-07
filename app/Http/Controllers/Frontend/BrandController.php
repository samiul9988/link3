<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function show(Request $request, $slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $query = Product::with(['images', 'category'])->where('brand_id', $brand->id)->where('status', 1);
        if ($request->filled('in_stock')) $query->where('stock_quantity', '>', 0);
        
        $sort = $request->sort ?? 'latest';
        switch ($sort) {
            case 'price_low': $query->orderByRaw('COALESCE(sale_price, regular_price) ASC'); break;
            case 'price_high': $query->orderByRaw('COALESCE(sale_price, regular_price) DESC'); break;
            case 'popular': $query->orderBy('total_sold', 'desc'); break;
            default: $query->latest();
        }
        
        $products = $query->paginate(20)->appends($request->query());
        return view('frontend.product.listing', compact('products', 'brand'))->with('pageTitle', $brand->name);
    }
}
