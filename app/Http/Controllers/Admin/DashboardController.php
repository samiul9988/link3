<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');
        $totalProducts = Product::count();
        $totalCustomers = Customer::count();
        $pendingOrders = Order::where('order_status', 'pending')->count();

        $recentOrders = Order::with('customer')->latest()->take(5)->get();
        $lowStockProducts = Product::where('stock_quantity', '<', 10)->where('status', 1)->take(5)->get();
        $topProducts = Product::where('status', 1)->orderBy('total_sold', 'desc')->take(5)->get();

        $chartLabels = [];
        $chartData = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartLabels[] = $date->format('M d');
            $chartData[] = (int) Order::whereDate('created_at', $date)->where('payment_status', 'paid')->sum('total');
        }

        return view('admin.dashboard.index', compact(
            'totalOrders', 'totalRevenue', 'totalProducts', 'totalCustomers', 'pendingOrders',
            'recentOrders', 'lowStockProducts', 'topProducts', 'chartLabels', 'chartData'
        ));
    }
}
