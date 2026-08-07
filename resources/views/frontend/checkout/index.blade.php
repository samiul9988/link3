@extends('frontend.layouts.app')

@php
    $pageTitle = 'Checkout';
    $breadcrumbs = collect([
        (object) ['name' => 'Home', 'url' => url('/')],
        (object) ['name' => 'Cart', 'url' => route('cart')],
        (object) ['name' => 'Checkout', 'url' => '#'],
    ]);
@endphp

@push('styles')
<style>
    .checkout-step { margin-bottom: 2rem; }
    .checkout-step h5 { font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; }
    .address-card { border: 2px solid #e5e7eb; border-radius: 8px; padding: 1rem; cursor: pointer; transition: all 0.2s; position: relative; }
    .address-card:hover { border-color: var(--primary); }
    .address-card.selected { border-color: var(--primary); background: var(--primary-50); }
    .address-card .address-radio { position: absolute; top: 1rem; right: 1rem; }
    .address-card .address-radio input { width: 18px; height: 18px; accent-color: var(--primary); cursor: pointer; }
    .address-card .name { font-weight: 600; font-size: 0.95rem; }
    .address-card .phone { font-size: 0.85rem; color: #6b7280; }
    .address-card .addr { font-size: 0.85rem; color: #4b5563; line-height: 1.5; }
    .address-card .badge-type { font-size: 0.7rem; padding: 0.15rem 0.5rem; border-radius: 20px; background: var(--primary-50); color: var(--primary); font-weight: 500; }
    .address-card .badge-default { font-size: 0.65rem; padding: 0.1rem 0.45rem; border-radius: 20px; background: #fef3c7; color: #92400e; font-weight: 500; }
    .payment-method-card { border: 2px solid #e5e7eb; border-radius: 8px; padding: 1rem 1.25rem; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: 0.75rem; }
    .payment-method-card:hover { border-color: var(--primary); }
    .payment-method-card.selected { border-color: var(--primary); background: var(--primary-50); }
    .payment-method-card input[type="radio"] { width: 18px; height: 18px; accent-color: var(--primary); cursor: pointer; flex-shrink: 0; }
    .payment-method-card .method-name { font-weight: 500; font-size: 0.95rem; }
    .payment-method-card i { font-size: 1.2rem; color: var(--primary); }
    .payment-details { background: #f9fafb; border-radius: 8px; padding: 1rem; margin-top: 0.5rem; display: none; }
    .payment-details.show { display: block; }
    .order-summary-card { background: #f9fafb; border-radius: 12px; padding: 1.5rem; position: sticky; top: 1rem; }
    .order-summary-card .summary-title { font-weight: 700; font-size: 1.15rem; margin-bottom: 1rem; }
    .order-item { display: flex; gap: 0.75rem; padding: 0.75rem 0; border-bottom: 1px solid #e5e7eb; }
    .order-item:last-child { border-bottom: none; }
    .order-item img { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #e5e7eb; }
    .order-item .item-info { flex: 1; }
    .order-item .item-name { font-size: 0.85rem; font-weight: 500; line-height: 1.3; }
    .order-item .item-variant { font-size: 0.75rem; color: #6b7280; }
    .order-item .item-qty { font-size: 0.8rem; color: #6b7280; }
    .order-item .item-price { font-weight: 600; font-size: 0.9rem; color: var(--primary); text-align: right; }
    .summary-row { display: flex; justify-content: space-between; padding: 0.5rem 0; font-size: 0.9rem; color: #4b5563; }
    .summary-row.total { font-size: 1.1rem; font-weight: 700; color: #1f2937; border-top: 2px solid #e5e7eb; padding-top: 0.75rem; margin-top: 0.5rem; }
    .summary-row .text-success { color: #22c55e !important; }
    #newAddressForm .form-label { font-size: 0.85rem; font-weight: 500; }
    #newAddressForm .form-control, #newAddressForm .form-select { font-size: 0.85rem; }
    .btn-place-order { padding: 0.85rem; font-weight: 600; font-size: 1rem; letter-spacing: 0.01em; }
    .section-divider { border: none; border-top: 1px solid #e5e7eb; margin: 1.5rem 0; }
</style>
@endpush

@section('content')
    @include('frontend.partials.breadcrumb')

    <div class="container py-4">
        <h2 class="fw-bold mb-4">Checkout</h2>

        <form action="{{ route('checkout.place') }}" method="POST" id="checkoutForm">
            @csrf

            <div class="row g-4">
                <div class="col-lg-8">
                    {{-- Step 1: Shipping Address --}}
                    <div class="checkout-step">
                        <h5 class="d-flex align-items-center gap-2">
                            <span style="width:28px;height:28px;background:var(--primary);color:#fff;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-size:0.8rem;font-weight:600;">1</span>
                            Shipping Address
                        </h5>

                        <div class="row g-3" id="savedAddresses">
                            @foreach($addresses as $address)
                                <div class="col-md-6">
                                    <label class="address-card d-block {{ $address->is_default ? 'selected' : '' }}">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="name">{{ $address->full_name }}</span>
                                            <span class="address-radio">
                                                <input type="radio" name="address_id" value="{{ $address->id }}" {{ $address->is_default ? 'checked' : '' }}>
                                            </span>
                                        </div>
                                        <div class="phone mb-1"><i class="fa-solid fa-phone me-1"></i> {{ $address->phone }}</div>
                                        <div class="addr mb-2">{{ $address->address_line }}, {{ $address->district }}, {{ $address->division }}</div>
                                        <div class="d-flex gap-1">
                                            <span class="badge-type">{{ ucfirst($address->type) }}</span>
                                            @if($address->is_default)
                                                <span class="badge-default">Default</span>
                                            @endif
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#newAddressForm">
                                <i class="fa-solid fa-plus me-1"></i> Add New Address
                            </button>
                        </div>

                        <div class="collapse mt-3" id="newAddressForm">
                            <div class="card card-body border rounded-3 bg-light">
                                <h6 class="fw-semibold mb-3">New Address</h6>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="new[full_name]" class="form-control form-control-sm" form="checkoutForm">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone <span class="text-danger">*</span></label>
                                        <input type="text" name="new[phone]" class="form-control form-control-sm" form="checkoutForm">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="new[email]" class="form-control form-control-sm" form="checkoutForm">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Division <span class="text-danger">*</span></label>
                                        <input type="text" name="new[division]" class="form-control form-control-sm" form="checkoutForm">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">District <span class="text-danger">*</span></label>
                                        <input type="text" name="new[district]" class="form-control form-control-sm" form="checkoutForm">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Upazila</label>
                                        <input type="text" name="new[upazila]" class="form-control form-control-sm" form="checkoutForm">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Address Line <span class="text-danger">*</span></label>
                                        <textarea name="new[address_line]" class="form-control form-control-sm" rows="2" form="checkoutForm"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Postal Code</label>
                                        <input type="text" name="new[postal_code]" class="form-control form-control-sm" form="checkoutForm">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Type</label>
                                        <select name="new[type]" class="form-select form-select-sm" form="checkoutForm">
                                            <option value="home">Home</option>
                                            <option value="office">Office</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input type="checkbox" name="new[is_default]" value="1" class="form-check-input" form="checkoutForm" id="newIsDefault">
                                            <label class="form-check-label" for="newIsDefault" style="font-size: 0.85rem;">Set as default address</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="section-divider">

                    {{-- Step 2: Payment Method --}}
                    <div class="checkout-step">
                        <h5 class="d-flex align-items-center gap-2">
                            <span style="width:28px;height:28px;background:var(--primary);color:#fff;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-size:0.8rem;font-weight:600;">2</span>
                            Payment Method
                        </h5>

                        <div class="d-flex flex-column gap-2">
                            @if(setting('cod_enabled', true))
                                <label class="payment-method-card" data-method="cod">
                                    <input type="radio" name="payment_method" value="cod" checked>
                                    <i class="fa-solid fa-money-bill-wave"></i>
                                    <span class="method-name">Cash on Delivery</span>
                                </label>
                            @endif

                            @if(setting('bkash_enabled', false))
                                <label class="payment-method-card" data-method="bkash">
                                    <input type="radio" name="payment_method" value="bkash">
                                    <i class="fa-solid fa-mobile-screen-button"></i>
                                    <span class="method-name">bKash</span>
                                </label>
                                <div class="payment-details" id="bkashDetails">
                                    @php $bkashNumber = setting('bkash_number', ''); @endphp
                                    @if($bkashNumber)
                                        <div class="mb-2"><strong>bKash Number:</strong> {{ $bkashNumber }}</div>
                                    @endif
                                    <p class="mb-2 small text-muted">Please complete the payment using bKash and enter the Transaction ID below.</p>
                                    <div class="mb-0">
                                        <input type="text" name="transaction_id" class="form-control form-control-sm" placeholder="Enter bKash Transaction ID">
                                    </div>
                                </div>
                            @endif

                            @if(setting('nagad_enabled', false))
                                <label class="payment-method-card" data-method="nagad">
                                    <input type="radio" name="payment_method" value="nagad">
                                    <i class="fa-solid fa-mobile-screen"></i>
                                    <span class="method-name">Nagad</span>
                                </label>
                                <div class="payment-details" id="nagadDetails">
                                    @php $nagadNumber = setting('nagad_number', ''); @endphp
                                    @if($nagadNumber)
                                        <div class="mb-2"><strong>Nagad Number:</strong> {{ $nagadNumber }}</div>
                                    @endif
                                    <p class="mb-2 small text-muted">Please complete the payment using Nagad and enter the Transaction ID below.</p>
                                    <div class="mb-0">
                                        <input type="text" name="transaction_id" class="form-control form-control-sm" placeholder="Enter Nagad Transaction ID">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr class="section-divider">

                    {{-- Customer Note --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Order Note (Optional)</label>
                        <textarea name="customer_note" class="form-control" rows="2" placeholder="Any special instructions for delivery..."></textarea>
                    </div>
                </div>

                {{-- Order Summary --}}
                <div class="col-lg-4">
                    <div class="order-summary-card">
                        <div class="summary-title">Order Summary</div>

                        @foreach($cartItems as $item)
                            <div class="order-item">
                                <img src="{{ asset($item->product->thumbnail) }}" alt="{{ $item->product->name }}">
                                <div class="item-info">
                                    <div class="item-name">{{ $item->product->name }}</div>
                                    @if($item->variant)
                                        <div class="item-variant">{{ $item->variant->variant_type }}: {{ $item->variant->variant_value }}</div>
                                    @endif
                                    <div class="item-qty">Qty: {{ $item->quantity }}</div>
                                </div>
                                <div class="item-price">৳{{ number_format(($item->product->final_price + ($item->variant->additional_price ?? 0)) * $item->quantity, 2) }}</div>
                            </div>
                        @endforeach

                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>৳{{ number_format($subtotal, 2) }}</span>
                        </div>
                        @if($discount > 0)
                            <div class="summary-row">
                                <span class="text-success">Discount {{ $coupon ? '(' . $coupon->code . ')' : '' }}</span>
                                <span class="text-success">-৳{{ number_format($discount, 2) }}</span>
                            </div>
                        @endif
                        <div class="summary-row">
                            <span>Delivery Charge</span>
                            <span>{{ $deliveryCharge > 0 ? '৳' . number_format($deliveryCharge, 2) : 'Free' }}</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span>৳{{ number_format($total, 2) }}</span>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3 btn-place-order">
                            <i class="fa-solid fa-lock me-2"></i> Place Order
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        if ($('input[name="address_id"]:checked').length === 0) {
            $('input[name="address_id"]').first().prop('checked', true);
            $('.address-card').first().addClass('selected');
        }

        $('.address-card').on('click', function (e) {
            if ($(e.target).is('input[type="radio"]')) return;
            $('.address-card').removeClass('selected');
            $(this).addClass('selected');
            $(this).find('input[type="radio"]').prop('checked', true);
        });

        const $bkashDetails = $('#bkashDetails');
        const $nagadDetails = $('#nagadDetails');

        $('input[name="payment_method"]').on('change', function () {
            const method = $(this).val();
            $('.payment-method-card').removeClass('selected');
            $(this).closest('.payment-method-card').addClass('selected');

            $bkashDetails.removeClass('show');
            $nagadDetails.removeClass('show');

            if (method === 'bkash') $bkashDetails.addClass('show');
            if (method === 'nagad') $nagadDetails.addClass('show');
        });

        $('.payment-method-card').on('click', function () {
            $(this).find('input[type="radio"]').prop('checked', true).trigger('change');
        });

        const defaultMethod = $('input[name="payment_method"]:checked').val();
        if (defaultMethod === 'bkash') $bkashDetails.addClass('show');
        if (defaultMethod === 'nagad') $nagadDetails.addClass('show');
    });
</script>
@endpush
