<?php
namespace App\Observers;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    public function saved(Category $category) { Cache::forget('categories_all'); Cache::forget('featured_categories'); }
    public function deleted(Category $category) { Cache::forget('categories_all'); Cache::forget('featured_categories'); }
}
