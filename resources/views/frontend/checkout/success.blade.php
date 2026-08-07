@extends('frontend.layouts.app')

@php $pageTitle = 'Order Placed Successfully'; @endphp

@push('styles')
<style>
    .success-icon {
        width: 80px;
        height: 80px;
        background: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }
    .success-icon i { color: #fff; font-size: 2.2rem; }
    .order-summary-box { background: #f9fafb; border-radius: 12px; padding: 1.5rem; }
    .order-summary-box .order-info-row { display: flex; justify-content: space-between; padding: 0.4rem 0; font-size: 0.9rem; }
    .order-summary-box .order-info-row:last-child { border-top: 2px solid #e5e7eb; padding-top: 0.6rem; margin-top: 0.4rem; font-weight: 700; font-size: 1rem; }
    .items-table th { font-size: 0.8rem; text-transform: uppercase; color: #6b7280; font-weight: 600; }
    .items-table td { font-size: 0.85rem; vertical-align: middle; }
    .items-table .item-thumb { width: 50px; height: 50px; object-fit: cover; border-radius: 4px; }
    .address-display { background: #f0fdfa; border-radius: 8px; padding: 1rem; border: 1px solid #ccfbf1; }
    .address-display .name { font-weight: 600; }
    .address-display .detail { font-size: 0.85rem; color: #4b5563; line-height: 1.6; }
    .btn-lg-custom { padding: 0.75rem 1.5rem; font-weight: 600; font-size: 0.95rem; }
</style>
@endpush

@section('content')
    <div class="container py-5">
        <div class="text-center mb-4">
            <div class="success-icon mb-3">
                <i class="fa-solid fa-check"></i>
            </div>
            <h2 class="fw-bold">Order Placed Successfully!</h2>
            <p class="text-muted">Order #{{ $order->order_number }}</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="order-summary-box mb-4">
                    <h5 class="fw-semibold mb-3">Order Summary</h5>
                    <div class="table-responsive">
                        <table class="table items-table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Variant</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ asset($item->product_image) }}" class="item-thumb" alt="{{ $item->product_name }}">
                                                <span>{{ $item->product_name }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $item->variant_details ?? '—' }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">৳{{ number_format($item->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="order-info-row"><span>Subtotal</span><span>৳{{ number_format($order->subtotal, 2) }}</span></div>
                    @if($order->discount > 0)
                        <div class="order-info-row text-success"><span>Discount</span><span>-৳{{ number_format($order->discount, 2) }}</span></div>
                    @endif
                    <div class="order-info-row"><span>Delivery Charge</span><span>{{ $order->delivery_charge > 0 ? '৳' . number_format($order->delivery_charge, 2) : 'Free' }}</span></div>
                    <div class="order-info-row"><span>Total</span><span>৳{{ number_format($order->total, 2) }}</span></div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="address-display">
                            <h6 class="fw-semibold mb-2"><i class="fa-solid fa-location-dot me-1" style="color:var(--primary);"></i> Shipping Address</h6>
                            @if($order->address)
                                <div class="name">{{ $order->address->full_name }}</div>
                                <div class="detail">{{ $order->address->phone }}</div>
                                <div class="detail">{{ $order->address->address_line }}</div>
                                <div class="detail">{{ $order->address->district }}, {{ $order->address->division }}</div>
                                @if($order->address->postal_code)
                                    <div class="detail">Postal: {{ $order->address->postal_code }}</div>
                                @endif
                            @else
                                <div class="text-muted small">N/A</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="address-display">
                            <h6 class="fw-semibold mb-2"><i class="fa-solid fa-credit-card me-1" style="color:var(--primary);"></i> Payment Method</h6>
                            <div class="name">{{ $order->payment_method === 'cod' ? 'Cash on Delivery' : ucfirst($order->payment_method) }}</div>
                            @if($order->transaction_id)
                                <div class="detail">Transaction ID: {{ $order->transaction_id }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg-custom">
                        <i class="fa-solid fa-arrow-left me-1"></i> Continue Shopping
                    </a>
                    <a href="{{ route('customer.order.detail', $order) }}" class="btn btn-primary btn-lg-custom">
                        <i class="fa-solid fa-eye me-1"></i> View Order
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
