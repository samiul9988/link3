<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    public function clear()
    {
        Cache::flush();
        Artisan::call('view:clear');
        return back()->with('success', 'All cache cleared successfully.');
    }
}
