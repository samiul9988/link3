<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    public function show($slug)
    {
        if ($slug === 'contact') {
            return view('frontend.pages.contact');
        }

        $page = Page::where('slug', $slug)->where('status', 1)->firstOrFail();
        return view('frontend.pages.dynamic', compact('page'));
    }
}
