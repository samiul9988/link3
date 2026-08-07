<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('sort_order')->get();
        $featuredCategories = Category::where('status', 1)->where('is_featured', 1)->orderBy('sort_order')->take(8)->get();
        $flashDeals = Product::with(['images', 'brand', 'category'])->where('status', 1)->where('is_flash_deal', 1)->where('flash_deal_end', '>', now())->latest()->take(12)->get();
        $featuredProducts = Product::with(['images', 'brand', 'category'])->where('status', 1)->where('is_featured', 1)->latest()->take(12)->get();
        $newArrivals = Product::with(['images', 'brand', 'category'])->where('status', 1)->where('is_new_arrival', 1)->latest()->take(12)->get();
        $bestSelling = Product::with(['images', 'brand', 'category'])->where('status', 1)->where('is_best_selling', 1)->orderBy('total_sold', 'desc')->take(12)->get();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->orderBy('sort_order')->get();
        $homeBanners = Banner::where('status', 1)->where('position', 'home_top')->orderBy('sort_order')->get();
        $homeMiddleBanners = Banner::where('status', 1)->where('position', 'home_middle')->orderBy('sort_order')->get();

        return view('frontend.home.index', compact(
            'sliders', 'featuredCategories', 'flashDeals', 'featuredProducts',
            'newArrivals', 'bestSelling', 'brands', 'homeBanners', 'homeMiddleBanners'
        ));
    }
}
