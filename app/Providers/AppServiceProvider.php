<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use App\Observers\CategoryObserver;
use App\Observers\BrandObserver;
use App\Observers\ProductObserver;
use App\Observers\SettingObserver;
use App\Observers\SliderObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Category::observe(CategoryObserver::class);
        Brand::observe(BrandObserver::class);
        Product::observe(ProductObserver::class);
        Setting::observe(SettingObserver::class);
        Slider::observe(SliderObserver::class);
    }
}
