<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->paginate(30);
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function export()
    {
        $subscribers = Subscriber::where('status', 1)->pluck('email');
        $csv = "Email\n";
        foreach ($subscribers as $email) {
            $csv .= $email . "\n";
        }
        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="subscribers.csv"',
        ]);
    }
}
