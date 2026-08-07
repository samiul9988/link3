@extends('frontend.layouts.app')

@php
    $pageTitle = 'My Account';
@endphp

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-3">
            @include('frontend.customer.partials.sidebar')
        </div>

        <div class="col-lg-9">
            <h4 class="fw-bold mb-1">Welcome, {{ auth()->guard('customer')->user()->name }}</h4>
            <p class="text-muted mb-4">Here's what's happening with your orders.</p>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid var(--primary);">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <small class="text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Total Orders</small>
                                    <h3 class="fw-bold mb-0 mt-1">{{ $totalOrders ?? 0 }}</h3>
                                </div>
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: var(--primary-light);">
                                    <i class="fa-solid fa-box text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #f59e0b;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <small class="text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Pending</small>
                                    <h3 class="fw-bold mb-0 mt-1">{{ $pendingOrders ?? 0 }}</h3>
                                </div>
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: #FEF3C7;">
                                    <i class="fa-solid fa-clock" style="color: #f59e0b;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #22c55e;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <small class="text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Delivered</small>
                                    <h3 class="fw-bold mb-0 mt-1">{{ $deliveredOrders ?? 0 }}</h3>
                                </div>
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: #DCFCE7;">
                                    <i class="fa-solid fa-circle-check" style="color: #22c55e;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="fw-semibold mb-0">Recent Orders</h6>
                        <a href="{{ url('/account/orders') }}" class="view-all-link text-primary">View All <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if(isset($recentOrders) && $recentOrders->count())
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="font-size: 0.8rem;">Order#</th>
                                        <th style="font-size: 0.8rem;">Date</th>
                                        <th style="font-size: 0.8rem;">Total</th>
                                        <th style="font-size: 0.8rem;">Status</th>
                                        <th style="font-size: 0.8rem;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-secondary',
                                            'confirmed' => 'bg-info',
                                            'processing' => 'bg-primary',
                                            'shipped' => 'bg-warning text-dark',
                                            'delivered' => 'bg-success',
                                            'cancelled' => 'bg-danger',
                                            'returned' => 'bg-dark',
                                        ];
                                    @endphp
                                    <tr>
                                        <td><span class="fw-medium">#{{ $order->order_number }}</span></td>
                                        <td><small class="text-muted">{{ $order->created_at->format('d M, Y') }}</small></td>
                                        <td class="fw-semibold">৳{{ number_format($order->total, 0) }}</td>
                                        <td>
                                            <span class="badge {{ $statusColors[$order->order_status] ?? 'bg-secondary' }}" style="font-size: 0.7rem;">
                                                {{ ucfirst($order->order_status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ url('/account/orders/' . $order->id) }}" class="btn btn-outline-primary btn-sm" style="font-size: 0.75rem;">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fa-solid fa-box-open fa-2x text-muted mb-3"></i>
                            <p class="text-muted mb-3">No orders yet</p>
                            <a href="{{ url('/products') }}" class="btn btn-primary btn-sm">Start Shopping</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
