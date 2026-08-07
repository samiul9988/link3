@extends('admin.layouts.admin')
@section('title', 'Orders')
@section('page_title', 'Orders')

@push('styles')
<style>
    .filter-card .form-label { font-size: 13px; font-weight: 500; color: #64748B; }
    .filter-card .form-select, .filter-card .form-control { font-size: 13px; }
</style>
@endpush

@section('content')
<div class="card mb-4 filter-card">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Search</label>
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Order#, Customer name, email, phone..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">Order Status</label>
                <select name="order_status" class="form-select form-select-sm">
                    <option value="">All</option>
                    <option value="pending" {{ request('order_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('order_status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="processing" {{ request('order_status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ request('order_status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ request('order_status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ request('order_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="returned" {{ request('order_status') == 'returned' ? 'selected' : '' }}>Returned</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Payment Status</label>
                <select name="payment_status" class="form-select form-select-sm">
                    <option value="">All</option>
                    <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Date From</label>
                <input type="date" name="date_from" class="form-control form-control-sm" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">Date To</label>
                <input type="date" name="date_to" class="form-control form-control-sm" value="{{ request('date_to') }}">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary btn-sm w-100"><i class="fas fa-filter"></i></button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-semibold">All Orders</h6>
        <span class="badge bg-primary">{{ $orders->total() }} orders</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Order#</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Payment Method</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="fw-semibold text-decoration-none">
                            #{{ $order->order_number }}
                        </a>
                    </td>
                    <td>
                        <div class="fw-medium">{{ $order->customer->name ?? 'Guest' }}</div>
                        @if(isset($order->customer->email))
                            <small class="text-muted">{{ $order->customer->email }}</small>
                        @endif
                    </td>
                    <td>
                        <span title="{{ $order->created_at->format('Y-m-d H:i') }}">
                            {{ $order->created_at->diffForHumans() }}
                        </span>
                    </td>
                    <td class="fw-semibold">৳{{ number_format($order->total, 2) }}</td>
                    <td>
                        <span class="badge bg-light text-dark">
                            {{ ucfirst($order->payment_method) }}
                        </span>
                    </td>
                    <td>
                        @php
                            $paymentColors = ['pending' => 'warning', 'paid' => 'success', 'failed' => 'danger'];
                        @endphp
                        <span class="badge bg-{{ $paymentColors[$order->payment_status] ?? 'secondary' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </td>
                    <td>
                        @php
                            $statusColors = [
                                'pending' => 'secondary',
                                'confirmed' => 'info',
                                'processing' => 'primary',
                                'shipped' => 'warning',
                                'delivered' => 'success',
                                'cancelled' => 'danger',
                                'returned' => 'dark',
                            ];
                        @endphp
                        <span class="badge bg-{{ $statusColors[$order->order_status] ?? 'secondary' }}">
                            {{ ucfirst($order->order_status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary" title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.orders.invoice', $order) }}" class="btn btn-sm btn-outline-secondary" title="Invoice">
                            <i class="fas fa-file-invoice"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-muted">No orders found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="card-footer">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
