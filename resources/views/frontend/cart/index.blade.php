@extends('frontend.layouts.app')

@section('title', $pageTitle ?? 'Shopping Cart')

@push('styles')
<style>
    .cart-table th {
        background: #f9fafb;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6b7280;
        font-weight: 600;
        padding: 0.75rem 1rem;
        border-bottom: 2px solid #e5e7eb;
        white-space: nowrap;
    }
    .cart-table td {
        vertical-align: middle;
        padding: 1rem;
        font-size: 0.9rem;
    }
    .cart-product-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #e5e7eb;
    }
    .cart-product-name {
        font-weight: 600;
        color: #1f2937;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .cart-product-name:hover {
        color: var(--primary);
    }
    .cart-variant-badge {
        display: inline-block;
        font-size: 0.7rem;
        background: #f3f4f6;
        padding: 0.15rem 0.5rem;
        border-radius: 4px;
        margin-top: 0.25rem;
    }
    .cart-remove-btn {
        color: #9ca3af;
        cursor: pointer;
        font-size: 1.1rem;
        transition: color 0.2s;
        background: none;
        border: none;
        padding: 0.25rem;
    }
    .cart-remove-btn:hover {
        color: #ef4444;
    }
    .cart-summary-card {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: #fff;
    }
    .cart-summary-card .card-body {
        padding: 1.5rem;
    }
    .coupon-input-group .form-control {
        border-right: none;
        font-size: 0.85rem;
    }
    .coupon-input-group .btn {
        border-left: none;
    }
    .applied-coupon {
        background: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
        padding: 0.4rem 0.75rem;
        border-radius: 6px;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .applied-coupon .remove-coupon {
        cursor: pointer;
        color: #dc2626;
        font-size: 0.9rem;
    }
    .empty-cart {
        text-align: center;
        padding: 3rem 1rem;
    }
    .empty-cart i {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 1rem;
    }

    @media (max-width: 767px) {
        .cart-table thead {
            display: none;
        }
        .cart-table,
        .cart-table tbody,
        .cart-table tr,
        .cart-table td {
            display: block;
        }
        .cart-table tr {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 1rem;
            padding: 1rem;
            background: #fff;
        }
        .cart-table td {
            padding: 0.35rem 0;
            border: none;
            text-align: right;
        }
        .cart-table td::before {
            content: attr(data-label);
            float: left;
            font-weight: 600;
            font-size: 0.75rem;
            color: #6b7280;
            text-transform: uppercase;
        }
        .cart-table td:first-child {
            text-align: center;
            padding-bottom: 0.5rem;
        }
        .cart-table td:first-child::before {
            content: none;
        }
        .cart-product-img {
            width: 100px;
            height: 100px;
        }
    }
</style>
@endpush

@section('content')

<div class="container py-4">
    <h3 class="fw-bold mb-4">
        <i class="fa-solid fa-basket-shopping me-2 text-primary"></i> Shopping Cart
    </h3>

    @if(empty($cartItems) || !count($cartItems))
        <div class="empty-cart">
            <i class="fa-solid fa-cart-shopping d-block"></i>
            <h4 class="text-muted mb-2">Your cart is empty</h4>
            <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet.</p>
            <a href="{{ url('/products') }}" class="btn btn-primary px-4">
                <i class="fa-solid fa-store me-2"></i> Start Shopping
            </a>
        </div>
    @else
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="table-responsive">
                    <table class="table cart-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Product</th>
                                <th>Details</th>
                                <th>Unit Price</th>
                                <th style="width: 140px;">Quantity</th>
                                <th>Subtotal</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr id="cartRow{{ $item->id }}" data-unit-price="{{ $item->product->final_price + ($item->variant->additional_price ?? 0) }}">
                                    <td data-label="Product">
                                        <a href="{{ url('/product/' . ($item->product->slug ?? '#')) }}">
                                            <img src="{{ asset($item->product->thumbnail ?? 'placeholder.png') }}"
                                                 alt="{{ $item->product->name ?? '' }}" class="cart-product-img">
                                        </a>
                                    </td>
                                    <td data-label="Details">
                                        <a href="{{ url('/product/' . ($item->product->slug ?? '#')) }}" class="cart-product-name">
                                            {{ $item->product->name ?? 'Product' }}
                                        </a>
                                        @if(!empty($item->variant_details))
                                            <br>
                                            <span class="cart-variant-badge">{{ $item->variant_details }}</span>
                                        @endif
                                    </td>
                                    <td data-label="Unit Price">
                                        <span class="fw-medium">৳{{ number_format($item->product->final_price + ($item->variant->additional_price ?? 0), 0) }}</span>
                                    </td>
                                    <td data-label="Quantity">
                                        <div class="d-flex justify-content-end justify-content-lg-start">
                                            <div class="quantity-selector">
                                                <button type="button" class="cart-qty-btn" data-cart-id="{{ $item->id }}" data-action="minus">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                                <input type="number" class="cart-qty-input" value="{{ $item->quantity }}"
                                                       min="1" max="99" data-cart-id="{{ $item->id }}" readonly>
                                                <button type="button" class="cart-qty-btn" data-cart-id="{{ $item->id }}" data-action="plus">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Subtotal">
                                        <span class="fw-semibold text-primary cart-subtotal" data-cart-id="{{ $item->id }}">
                                            ৳{{ number_format(($item->product->final_price + ($item->variant->additional_price ?? 0)) * $item->quantity, 0) }}
                                        </span>
                                    </td>
                                    <td data-label="">
                                        <button class="cart-remove-btn cart-remove-item" data-cart-id="{{ $item->id }}" title="Remove">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex flex-wrap justify-content-between mt-3">
                    <a href="{{ url('/products') }}" class="btn btn-outline-primary btn-sm mb-2">
                        <i class="fa-solid fa-arrow-left me-1"></i> Continue Shopping
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="cart-summary-card">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Cart Summary</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-medium" id="summarySubtotal">৳{{ number_format($subtotal ?? 0, 0) }}</span>
                        </div>

                        <div class="mb-3 pt-2">
                            <label class="form-label small fw-semibold text-muted">Coupon Code</label>
                            <div class="input-group input-group-sm coupon-input-group">
                                <input type="text" class="form-control" id="couponCode"
                                       placeholder="Enter coupon" {{ !empty($coupon) ? 'disabled' : '' }}>
                                @if(empty($coupon))
                                    <button class="btn btn-primary" type="button" id="applyCouponBtn">Apply</button>
                                @endif
                            </div>
                            <div id="couponMessage" class="mt-1" style="font-size: 0.75rem;"></div>

                            @if(!empty($coupon))
                                <div class="mt-2 applied-coupon" id="appliedCoupon">
                                    <i class="fa-solid fa-tag"></i>
                                    <span>{{ $coupon->code }}</span>
                                    <span class="remove-coupon" id="removeCouponBtn" title="Remove">
                                        <i class="fa-solid fa-xmark"></i>
                                    </span>
                                </div>
                            @endif
                        </div>

                        @if(!empty($discount) && $discount > 0)
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Discount</span>
                                <span class="fw-medium text-success" id="summaryDiscount">
                                    -৳{{ number_format($discount, 0) }}
                                </span>
                            </div>
                        @endif

                        @php
                            $freeDeliveryAbove = (int) \App\Helpers\SettingHelper::get('free_delivery_above', 5000);
                            $insideDhakaCharge = (int) \App\Helpers\SettingHelper::get('inside_dhaka_charge', 60);
                            $outsideDhakaCharge = (int) \App\Helpers\SettingHelper::get('outside_dhaka_charge', 120);
                            $deliveryCharge = ($subtotal ?? 0) > $freeDeliveryAbove ? 0 : $insideDhakaCharge;
                        @endphp
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Est. Delivery</span>
                            <span class="fw-medium" id="summaryDelivery">
                                @if(($subtotal ?? 0) > $freeDeliveryAbove)
                                    Free
                                @else
                                    Inside Dhaka: ৳{{ number_format($insideDhakaCharge, 0) }} / Outside: ৳{{ number_format($outsideDhakaCharge, 0) }}
                                @endif
                            </span>
                        </div>

                        <hr>

                        @php $cartTotal = ($subtotal ?? 0) - ($discount ?? 0) + $deliveryCharge; @endphp
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-semibold" style="font-size: 1.1rem;">Total</span>
                            <span class="fw-bold text-primary" style="font-size: 1.2rem;" id="summaryTotal">
                                ৳{{ number_format($cartTotal, 0) }}
                            </span>
                        </div>

                        <a href="{{ url('/checkout') }}"
                           class="btn btn-primary w-100 py-2 fw-semibold {{ auth()->guard('customer')->check() ? '' : 'disabled' }}"
                           id="checkoutBtn">
                            <i class="fa-solid fa-lock me-2"></i> Proceed to Checkout
                        </a>

                        @unless(auth()->guard('customer')->check())
                            <div class="text-center mt-2">
                                <small class="text-muted">
                                    Please <a href="{{ url('/login') }}" class="text-decoration-none">login</a> to checkout.
                                </small>
                            </div>
                        @endunless
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@if(!empty($cartItems) && count($cartItems))
@push('scripts')
<script>
    $(function() {
        function updateCartSummary(data) {
            if (data.subtotal !== undefined) {
                $('#summarySubtotal').text('৳' + parseFloat(data.subtotal).toLocaleString('en-IN'));
            }
            if (data.discount !== undefined && data.discount > 0) {
                $('#summaryDiscount').text('-৳' + parseFloat(data.discount).toLocaleString('en-IN')).show();
            } else {
                $('#summaryDiscount').hide();
            }
            if (data.delivery !== undefined) {
                $('#summaryDelivery').text('৳' + parseFloat(data.delivery).toLocaleString('en-IN'));
            }
            if (data.total !== undefined) {
                $('#summaryTotal').text('৳' + parseFloat(data.total).toLocaleString('en-IN'));
            }
            if (data.count !== undefined) {
                $('.cart-count').text(data.count);
            }
        }

        $('.cart-qty-btn').on('click', function() {
            const cartId = $(this).data('cart-id');
            const action = $(this).data('action');
            const $input = $('.cart-qty-input[data-cart-id="' + cartId + '"]');
            let qty = parseInt($input.val());

            if (action === 'plus') qty += 1;
            else if (action === 'minus' && qty > 1) qty -= 1;

            $input.val(qty);

            $.ajax({
                url: '{{ url("/cart/update") }}',
                method: 'POST',
                data: { cart_id: cartId, quantity: qty },
                success: function(res) {
                    const unitPrice = parseFloat($('#cartRow' + cartId).data('unit-price') || 0);
                    const subtotal = unitPrice * qty;
                    $('.cart-subtotal[data-cart-id="' + cartId + '"]').text(
                        '৳' + subtotal.toLocaleString('en-IN')
                    );
                    updateCartSummary(res);
                    showToast(res.message || 'Cart updated');
                },
                error: function() {
                    showToast('Failed to update cart', 'error');
                }
            });
        });

        $('.cart-remove-item').on('click', function() {
            const cartId = $(this).data('cart-id');
            const $row = $('#cartRow' + cartId);

            if (!confirm('Remove this item from cart?')) return;

            $.ajax({
                url: '{{ url("/cart/remove") }}',
                method: 'POST',
                data: { cart_id: cartId },
                success: function(res) {
                    $row.fadeOut(300, function() {
                        $row.remove();
                        if ($('.cart-table tbody tr').length === 0) {
                            location.reload();
                        }
                        updateCartSummary(res);
                    });
                    showToast(res.message || 'Item removed');
                },
                error: function() {
                    showToast('Failed to remove item', 'error');
                }
            });
        });

        $('#applyCouponBtn').on('click', function() {
            const code = $('#couponCode').val().trim();
            if (!code) {
                showToast('Please enter a coupon code', 'error');
                return;
            }

            const btn = $(this);
            btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i>');

            $.ajax({
                url: '{{ url("/cart/coupon") }}',
                method: 'POST',
                data: { code: code },
                success: function(res) {
                    $('#couponMessage').html(
                        '<span class="text-success">' + (res.message || 'Coupon applied!') + '</span>'
                    );
                    $('#couponCode').prop('disabled', true);
                    btn.remove();
                    updateCartSummary(res);
                    showToast(res.message || 'Coupon applied!');
                },
                error: function(xhr) {
                    const msg = xhr.responseJSON?.message || 'Invalid coupon';
                    $('#couponMessage').html('<span class="text-danger">' + msg + '</span>');
                    showToast(msg, 'error');
                    btn.html('Apply').prop('disabled', false);
                }
            });
        });

        $('#removeCouponBtn').on('click', function() {
            $.ajax({
                url: '{{ url("/cart/coupon/remove") }}',
                method: 'POST',
                success: function(res) {
                    $('#appliedCoupon').remove();
                    $('#couponCode').prop('disabled', false).val('');
                    $('#couponMessage').html('');
                    updateCartSummary(res);
                    showToast(res.message || 'Coupon removed');
                },
                error: function() {
                    showToast('Failed to remove coupon', 'error');
                }
            });
        });
    });
</script>
@endpush
@endif

@endsection
