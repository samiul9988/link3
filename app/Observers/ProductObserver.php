<?php
namespace App\Observers;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    public function saved(Product $product) { Cache::forget('homepage_data'); Cache::forget('product_' . $product->id); Cache::forget('product_slug_' . $product->slug); }
    public function deleted(Product $product) { Cache::forget('homepage_data'); Cache::forget('product_' . $product->id); Cache::forget('product_slug_' . $product->slug); }
}
