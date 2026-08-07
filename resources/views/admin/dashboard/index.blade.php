@extends('admin.layouts.admin')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <small class="opacity-75">Total Orders</small>
                    <h2 class="mb-0 mt-1">{{ $totalOrders }}</h2>
                </div>
                <i class="fas fa-shopping-cart fa-2x opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card blue">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <small class="opacity-75">Total Revenue</small>
                    <h2 class="mb-0 mt-1">৳{{ number_format($totalRevenue, 0) }}</h2>
                </div>
                <i class="fas fa-dollar-sign fa-2x opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card green">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <small class="opacity-75">Total Products</small>
                    <h2 class="mb-0 mt-1">{{ $totalProducts }}</h2>
                </div>
                <i class="fas fa-box fa-2x opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card purple">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <small class="opacity-75">Total Customers</small>
                    <h2 class="mb-0 mt-1">{{ $totalCustomers }}</h2>
                </div>
                <i class="fas fa-users fa-2x opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center py-3">
                <h6 class="mb-0 fw-semibold">Sales (Last 30 Days)</h6>
            </div>
            <div class="card-body">
                <canvas id="salesChart" height="300"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-transparent border-bottom py-3">
                <h6 class="mb-0 fw-semibold">Recent Orders</h6>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($recentOrders as $order)
                        <a href="{{ route('admin.orders.show', $order) }}" class="list-group-item list-group-item-action px-3 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted d-block">{{ $order->order_number }}</small>
                                    <small>{{ $order->customer->name ?? 'Guest' }}</small>
                                </div>
                                <div class="text-end">
                                    <span class="fw-semibold d-block">৳{{ number_format($order->total, 0) }}</span>
                                    <span class="badge bg-{{ $order->order_status === 'pending' ? 'warning' : ($order->order_status === 'delivered' ? 'success' : 'info') }}">
                                        {{ ucfirst($order->order_status) }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-4 text-muted">No orders yet</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@if($lowStockProducts->count() > 0)
<div class="card mt-4">
    <div class="card-header bg-transparent border-bottom py-3">
        <h6 class="mb-0 fw-semibold"><i class="fas fa-exclamation-triangle text-warning me-2"></i> Low Stock Alerts</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lowStockProducts as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td><span class="badge bg-danger">{{ $product->stock_quantity }}</span></td>
                        <td>৳{{ number_format($product->final_price, 0) }}</td>
                        <td><a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-primary">Update Stock</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

<div class="card mt-4">
    <div class="card-header bg-transparent border-bottom py-3">
        <h6 class="mb-0 fw-semibold">Top Selling Products</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr><th>Product</th><th>Sold</th><th>Revenue</th></tr>
                </thead>
                <tbody>
                    @forelse($topProducts as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->total_sold }}</td>
                        <td>৳{{ number_format($product->total_sold * $product->final_price, 0) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center text-muted py-3">No sales yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const ctx = document.getElementById('salesChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            label: 'Sales (BDT)',
            data: {!! json_encode($chartData) !!},
            borderColor: '#0D9488',
            backgroundColor: 'rgba(13,148,136,0.1)',
            fill: true,
            tension: 0.4,
            pointRadius: 4,
            pointBackgroundColor: '#0D9488'
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { callback: v => '৳' + v } }
        }
    }
});
</script>
@endpush
