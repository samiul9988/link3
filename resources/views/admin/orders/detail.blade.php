@extends('admin.layouts.admin')
@section('title', 'Order #' . $order->order_number)
@section('page_title', 'Order #' . $order->order_number)

@push('styles')
<style>
    .timeline-item { position: relative; padding-left: 24px; margin-bottom: 12px; }
    .timeline-item::before { content: ''; position: absolute; left: 0; top: 6px; width: 10px; height: 10px; border-radius: 50%; background: #CBD5E1; }
    .timeline-item::after { content: ''; position: absolute; left: 4px; top: 18px; width: 2px; height: calc(100% - 8px); background: #E2E8F0; }
    .timeline-item:last-child::after { display: none; }
    .detail-label { font-size: 12px; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
    .product-img { width: 50px; height: 50px; object-fit: cover; border-radius: 8px; }
</style>
@endpush

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to Orders
    </a>
    <a href="{{ route('admin.orders.invoice', $order) }}" class="btn btn-sm btn-outline-primary ms-2" target="_blank">
        <i class="fas fa-file-invoice me-1"></i> Print Invoice
    </a>
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
    <div class="col-lg-8">
        {{-- Order Info Card --}}
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <h6 class="mb-0 fw-semibold">Order Items</h6>
                <div>
                    <span class="badge bg-{{ $statusColors[$order->order_status] ?? 'secondary' }} fs-6">
                        {{ ucfirst($order->order_status) }}
                    </span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;">Image</th>
                            <th>Product</th>
                            <th>Variant</th>
                            <th>Qty</th>
                            <th class="text-end">Unit Price</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <img src="{{ asset($item->product_image) }}" alt="{{ $item->product_name }}" class="product-img">
                            </td>
                            <td>
                                <div class="fw-medium">{{ $item->product_name }}</div>
                                @if($item->product)
                                    <small class="text-muted">SKU: {{ $item->product->sku }}</small>
                                @endif
                            </td>
                            <td>
                                @if($item->variant_details)
                                    <small>{{ $item->variant_details }}</small>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td class="text-end">৳{{ number_format($item->unit_price, 2) }}</td>
                            <td class="text-end fw-semibold">৳{{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Status Update Forms --}}
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header py-3">
                        <h6 class="mb-0 fw-semibold">Update Order Status</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Order Status</label>
                                <select name="order_status" class="form-select">
                                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $order->order_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="returned" {{ $order->order_status == 'returned' ? 'selected' : '' }}>Returned</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Admin Note</label>
                                <textarea name="admin_note" class="form-control" rows="2" placeholder="Add a note...">{{ $order->admin_note }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header py-3">
                        <h6 class="mb-0 fw-semibold">Update Payment Status</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.orders.payment', $order) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Payment Status</label>
                                <select name="payment_status" class="form-select">
                                    <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Update Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        {{-- Order Info --}}
        <div class="card mb-3">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-info-circle me-2"></i>Order Info</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="detail-label">Order Number</div>
                    <div class="fw-semibold">#{{ $order->order_number }}</div>
                </div>
                <div class="mb-3">
                    <div class="detail-label">Date</div>
                    <div>{{ $order->created_at->format('d M, Y h:i A') }}</div>
                </div>
                <div class="mb-3">
                    <div class="detail-label">Payment Method</div>
                    <div>{{ ucfirst($order->payment_method) }}</div>
                </div>
                <div class="mb-3">
                    <div class="detail-label">Transaction ID</div>
                    <div>{{ $order->transaction_id ?: '—' }}</div>
                </div>
                @if($order->coupon)
                <div class="mb-0">
                    <div class="detail-label">Coupon Applied</div>
                    <div>
                        <span class="badge bg-success">{{ $order->coupon->code }}</span>
                        <small class="text-muted ms-1">({{ number_format($order->coupon->discount_amount, 2) }} off)</small>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Customer Info --}}
        <div class="card mb-3">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-user me-2"></i>Customer</h6>
            </div>
            <div class="card-body">
                @if($order->customer)
                    <div class="mb-2">
                        <div class="detail-label">Name</div>
                        <a href="{{ route('admin.customers.show', $order->customer) }}" class="text-decoration-none fw-medium">
                            {{ $order->customer->name }}
                        </a>
                    </div>
                    <div class="mb-2">
                        <div class="detail-label">Email</div>
                        <div>{{ $order->customer->email }}</div>
                    </div>
                    <div class="mb-0">
                        <div class="detail-label">Phone</div>
                        <div>{{ $order->customer->phone ?: '—' }}</div>
                    </div>
                @else
                    <div class="text-muted">Guest checkout</div>
                @endif
            </div>
        </div>

        {{-- Shipping Address --}}
        <div class="card mb-3">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-map-marker-alt me-2"></i>Shipping Address</h6>
            </div>
            <div class="card-body">
                @if($order->address)
                    <div class="fw-medium mb-1">{{ $order->address->full_name }}</div>
                    <div class="text-muted">{{ $order->address->phone }}</div>
                    @if($order->address->email)
                        <div class="text-muted">{{ $order->address->email }}</div>
                    @endif
                    <div class="mt-2">
                        {{ $order->address->address_line }},
                        {{ $order->address->upazila }},
                        {{ $order->address->district }},
                        {{ $order->address->division }}
                        @if($order->address->postal_code)
                            - {{ $order->address->postal_code }}
                        @endif
                    </div>
                @else
                    <div class="text-muted">No address found</div>
                @endif
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="card mb-3">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-calculator me-2"></i>Order Summary</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal</span>
                    <span>৳{{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Discount</span>
                    <span class="text-danger">- ৳{{ number_format($order->discount, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Delivery Charge</span>
                    <span>৳{{ number_format($order->delivery_charge, 2) }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span class="fw-bold">Total</span>
                    <span class="fw-bold fs-5">৳{{ number_format($order->total, 2) }}</span>
                </div>
                <div class="mt-2">
                    <span class="badge bg-{{ $paymentColors[$order->payment_status] ?? 'secondary' }}">
                        Payment: {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Customer Note --}}
        @if($order->customer_note)
        <div class="card mb-3">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-semibold"><i class="fas fa-sticky-note me-2"></i>Customer Note</h6>
            </div>
            <div class="card-body">
                <p class="mb-0 text-muted">{{ $order->customer_note }}</p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
