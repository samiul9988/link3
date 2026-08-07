<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = ProductReview::with(['product', 'customer'])->latest()->paginate(20);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function toggleStatus(ProductReview $review)
    {
        $review->status = !$review->status;
        $review->save();
        return back()->with('success', 'Review status updated.');
    }

    public function destroy(ProductReview $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted.');
    }
}
