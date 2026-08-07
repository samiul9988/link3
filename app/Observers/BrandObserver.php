<?php
namespace App\Observers;
use App\Models\Brand;
use Illuminate\Support\Facades\Cache;

class BrandObserver
{
    public function saved(Brand $brand) { Cache::forget('brands_all'); }
    public function deleted(Brand $brand) { Cache::forget('brands_all'); }
}
