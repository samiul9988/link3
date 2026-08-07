@extends('frontend.layouts.app')

@php
    $pageTitle = 'My Orders';
@endphp

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-3">
            @include('frontend.customer.partials.sidebar')
        </div>

        <div class="col-lg-9">
            <h4 class="fw-bold mb-4">My Orders</h4>

            @if(isset($orders) && $orders->count())
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="font-size: 0.8rem;">Order#</th>
                                    <th style="font-size: 0.8rem;">Date</th>
                                    <th style="font-size: 0.8rem;">Items</th>
                                    <th style="font-size: 0.8rem;">Total</th>
                                    <th style="font-size: 0.8rem;">Payment Method</th>
                                    <th style="font-size: 0.8rem;">Payment</th>
                                    <th style="font-size: 0.8rem;">Status</th>
                                    <th style="font-size: 0.8rem;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                @php
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
                                <tr>
                                    <td><span class="fw-medium">#{{ $order->order_number }}</span></td>
                                    <td><small class="text-muted">{{ $order->created_at->format('d M, Y') }}</small></td>
                                    <td>{{ $order->items_count ?? $order->items->count() }}</td>
                                    <td class="fw-semibold">৳{{ number_format($order->total, 0) }}</td>
                                    <td><small>{{ ucfirst($order->payment_method) }}</small></td>
                                    <td>
                                        <span class="badge {{ $paymentStatusColors[$order->payment_status] ?? 'bg-secondary' }}" style="font-size: 0.7rem;">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $orderStatusColors[$order->order_status] ?? 'bg-secondary' }}" style="font-size: 0.7rem;">
                                            {{ ucfirst($order->order_status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ url('/account/orders/' . $order->id) }}" class="btn btn-outline-primary btn-sm" style="font-size: 0.75rem;">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($orders instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                    <div class="d-flex justify-content-center mt-4">
                        {{ $orders->links() }}
                    </div>
                @endif
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                        <h5 class="fw-semibold">No orders yet</h5>
                        <p class="text-muted">Looks like you haven't placed any orders yet.</p>
                        <a href="{{ url('/products') }}" class="btn btn-primary">Start Shopping</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
