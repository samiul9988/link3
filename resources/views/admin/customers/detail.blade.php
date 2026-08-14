@extends('admin.layouts.admin')
@section('title', $customer->name)
@section('page_title', $customer->name)

@push('styles')
<style>
    .detail-label { font-size: 12px; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
    .avatar-circle { width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #0D9488, #0F766E); color: white; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 700; }
</style>
@endpush

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to Customers
    </a>

    <form action="{{ route('admin.customers.status', $customer) }}" method="POST" class="d-inline ms-2">
        @csrf
        <button type="submit" class="btn btn-sm btn-{{ $customer->status ? 'danger' : 'success' }}">
            <i class="fas fa-{{ $customer->status ? 'ban' : 'check' }} me-1"></i>
            {{ $customer->status ? 'Deactivate' : 'Activate' }} Customer
        </button>
    </form>
</div>

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
    $paymentColors = ['pending' => 'warning', 'paid' => 'success', 'failed' => 'danger'];
@endphp

<div class="row g-4">
    <div class="col-lg-4">
        {{-- Customer Info Card --}}
        <div class="card">
            <div class="card-body text-center py-4">
                <div class="avatar-circle mx-auto mb-3">
                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                </div>
                <h5 class="fw-bold mb-1">{{ $customer->name }}</h5>
                <div class="text-muted mb-2">{{ $customer->email }}</div>

                <span class="badge bg-{{ $customer->status ? 'success' : 'secondary' }} fs-6 mb-3">
                    {{ $customer->status ? 'Active' : 'Inactive' }}
                </span>

                <div class="text-muted" style="font-size:13px;">
                    Joined {{ $customer->created_at->format('d M, Y') }}
                </div>
            </div>
        </div>

        {{-- Contact Info --}}
        <div class="card mt-3">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-address-book me-2"></i>Contact Info</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="detail-label">Email</div>
                    <div>{{ $customer->email }}</div>
                </div>
                <div class="mb-3">
                    <div class="detail-label">Phone</div>
                    <div>{{ $customer->phone ?: '—' }}</div>
                </div>
                <div class="mb-3">
                    <div class="detail-label">Total Orders</div>
                    <div><span class="badge bg-info">{{ $customer->orders_count ?? $customer->orders->count() }}</span></div>
                </div>
                <div class="mb-3">
                    <div class="detail-label">Email Verified</div>
                    <div>
                        @if($customer->email_verified_at)
                            <span class="badge bg-success">Verified</span>
                            <small class="text-muted ms-1">{{ $customer->email_verified_at->format('d M, Y') }}</small>
                        @else
                            <span class="badge bg-warning text-dark">Unverified</span>
                        @endif
                    </div>
                </div>
                <div class="mb-0">
                    <div class="detail-label">Phone Verified</div>
                    <div>
                        @if($customer->phone_verified_at)
                            <span class="badge bg-success">Verified</span>
                        @else
                            <span class="badge bg-warning text-dark">Unverified</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Addresses --}}
        <div class="card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-map-marker-alt me-2"></i>Addresses</h6>
                <span class="badge bg-light text-dark">{{ $customer->addresses->count() }}</span>
            </div>
            <div class="card-body p-0">
                @forelse($customer->addresses as $address)
                    <div class="p-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <span class="fw-medium">{{ $address->full_name }}</span>
                            @if($address->is_default)
                                <span class="badge bg-success" style="font-size:10px;">Default</span>
                            @endif
                        </div>
                        <div class="text-muted" style="font-size:13px;">
                            <div>{{ $address->phone }}</div>
                            @if($address->email)
                                <div>{{ $address->email }}</div>
                            @endif
                            <div class="mt-1">
                                {{ $address->address_line }}, {{ $address->upazila }},
                                {{ $address->district }}, {{ $address->division }}
                                @if($address->postal_code)
                                    - {{ $address->postal_code }}
                                @endif
                            </div>
                            @if($address->type)
                                <span class="badge bg-light text-dark mt-1">Type: {{ ucfirst($address->type) }}</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-3 text-center text-muted">No addresses saved</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        {{-- Recent Orders --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-shopping-bag me-2"></i>Recent Orders</h6>
                <span class="badge bg-primary">{{ $customer->orders->count() }} orders</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Order#</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customer->orders as $order)
                        <tr>
                            <td>
                                <span class="fw-semibold">#{{ $order->order_number }}</span>
                            </td>
                            <td>
                                <span title="{{ $order->created_at->format('Y-m-d H:i') }}">
                                    {{ $order->created_at->diffForHumans() }}
                                </span>
                            </td>
                            <td class="fw-semibold">৳{{ number_format($order->total, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $paymentColors[$order->payment_status] ?? 'secondary' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $statusColors[$order->order_status] ?? 'secondary' }}">
                                    {{ ucfirst($order->order_status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary" title="View Order">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No orders yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
