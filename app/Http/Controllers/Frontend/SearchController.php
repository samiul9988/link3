<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SearchTerm;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->q;
        if ($keyword) {
            $term = SearchTerm::firstOrCreate(['term' => $keyword]);
            $term->increment('count');
        }
        $products = Product::with(['images', 'brand', 'category'])->where('status', 1)
            ->where(function($q) use ($keyword) { $q->where('name', 'like', '%'.$keyword.'%')->orWhere('short_description', 'like', '%'.$keyword.'%'); })
            ->latest()->paginate(20)->appends(['q' => $keyword]);
        return view('frontend.search.results', compact('products', 'keyword'));
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->q;
        if (strlen($keyword) < 2) return response()->json([]);
        $products = Product::with('images')->where('status', 1)->where('name', 'like', '%'.$keyword.'%')->take(8)->get()->map(function($p) {
            return ['id' => $p->id, 'name' => $p->name, 'slug' => $p->slug, 'image' => $p->thumbnail ?? ($p->images->first()->image_path ?? null), 'price' => $p->final_price, 'sale_price' => $p->sale_price, 'regular_price' => $p->regular_price];
        });
        return response()->json($products);
    }
}
