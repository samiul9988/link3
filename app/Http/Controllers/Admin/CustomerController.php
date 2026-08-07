<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::withCount('orders')->latest()->paginate(20);

        return view('admin.customers.index', compact('customers'));
    }

    public function show(Customer $customer)
    {
        $customer->load(['orders' => fn($q) => $q->latest()->take(10), 'addresses']);

        return view('admin.customers.detail', compact('customer'));
    }

    public function toggleStatus(Customer $customer)
    {
        $customer->status = !$customer->status;
        $customer->save();

        $status = $customer->status ? 'activated' : 'deactivated';

        return back()->with('success', "Customer {$status} successfully.");
    }
}
