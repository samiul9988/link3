<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Page;

class SitemapController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $pages = Page::where('status', 1)->get();
        return response()->view('frontend.sitemap', compact('products', 'categories', 'brands', 'pages'))->header('Content-Type', 'text/xml');
    }
}
