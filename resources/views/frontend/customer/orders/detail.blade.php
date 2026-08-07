@extends('frontend.layouts.app')

@php
    $pageTitle = 'Order #' . $order->order_number;
    $orderStatusColors = [
        'pending' => 'bg-secondary',
        'confirmed' => 'bg-info',
        'processing' => 'bg-primary',
        'shipped' => 'bg-warning text-dark',
        'delivered' => 'bg-success',
        'cancelled' => 'bg-danger',
        'returned' => 'bg-dark',
    ];
    $paymentStatusColors = [
        'pending' => 'bg-warning text-dark',
        'paid' => 'bg-success',
        'failed' => 'bg-danger',
    ];
@endphp

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-3">
            @include('frontend.customer.partials.sidebar')
        </div>

        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Order #{{ $order->order_number }}</h4>
                <div>
                    <a href="{{ url('/account/orders') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Orders
                    </a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                            <h6 class="fw-semibold mb-0">Items</h6>
                            <span class="badge {{ $orderStatusColors[$order->order_status] ?? 'bg-secondary' }}">
                                {{ ucfirst($order->order_status) }}
                            </span>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 60px; font-size: 0.8rem;">Image</th>
                                        <th style="font-size: 0.8rem;">Product</th>
                                        <th style="font-size: 0.8rem;">Variant</th>
                                        <th style="font-size: 0.8rem;">Qty</th>
                                        <th class="text-end" style="font-size: 0.8rem;">Unit Price</th>
                                        <th class="text-end" style="font-size: 0.8rem;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($item->product_image ?? 'placeholder.png') }}" alt="{{ $item->product_name }}" style="width: 48px; height: 48px; object-fit: cover; border-radius: 6px;">
                                        </td>
                                        <td>
                                            <div class="fw-medium" style="font-size: 0.85rem;">{{ $item->product_name }}</div>
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

                    @if(in_array($order->order_status, ['pending', 'confirmed']))
                        <form action="{{ url('/account/orders/' . $order->id . '/cancel') }}" method="POST" class="mb-4"
                              onsubmit="return confirm('Are you sure you want to cancel this order?')">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fa-solid fa-xmark me-1"></i> Cancel Order
                            </button>
                        </form>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-white border-bottom py-3">
                            <h6 class="fw-semibold mb-0">Order Info</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <small class="text-muted text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Order Number</small>
                                <div class="fw-semibold">#{{ $order->order_number }}</div>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Date</small>
                                <div>{{ $order->created_at->format('d M, Y h:i A') }}</div>
                            </div>
                            <div class="mb-0">
                                <small class="text-muted text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Status</small>
                                <div>
                                    <span class="badge {{ $orderStatusColors[$order->order_status] ?? 'bg-secondary' }}">
                                        {{ ucfirst($order->order_status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($order->address)
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-white border-bottom py-3">
                            <h6 class="fw-semibold mb-0"><i class="fa-solid fa-map-marker-alt me-2 text-primary"></i>Shipping Address</h6>
                        </div>
                        <div class="card-body">
                            <div class="fw-medium mb-1">{{ $order->address->full_name }}</div>
                            <div class="text-muted" style="font-size: 0.85rem;">{{ $order->address->phone }}</div>
                            @if($order->address->email)
                                <div class="text-muted" style="font-size: 0.85rem;">{{ $order->address->email }}</div>
                            @endif
                            <div class="mt-2" style="font-size: 0.85rem;">
                                {{ $order->address->address_line }},
                                {{ $order->address->upazia ?? $order->address->upazila }},
                                {{ $order->address->district }},
                                {{ $order->address->division }}
                                @if($order->address->postal_code)
                                    - {{ $order->address->postal_code }}
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-white border-bottom py-3">
                            <h6 class="fw-semibold mb-0">Order Summary</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2" style="font-size: 0.85rem;">
                                <span class="text-muted">Subtotal</span>
                                <span>৳{{ number_format($order->subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2" style="font-size: 0.85rem;">
                                <span class="text-muted">Discount</span>
                                <span class="text-danger">- ৳{{ number_format($order->discount, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2" style="font-size: 0.85rem;">
                                <span class="text-muted">Delivery</span>
                                <span>৳{{ number_format($order->delivery_charge, 2) }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total</span>
                                <span class="fw-bold fs-5 text-primary">৳{{ number_format($order->total, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom py-3">
                            <h6 class="fw-semibold mb-0">Payment Info</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <small class="text-muted text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Method</small>
                                <div>{{ ucfirst($order->payment_method) }}</div>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Status</small>
                                <div>
                                    <span class="badge {{ $paymentStatusColors[$order->payment_status] ?? 'bg-secondary' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="mb-0">
                                <small class="text-muted text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Transaction ID</small>
                                <div>{{ $order->transaction_id ?: '—' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
