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
    .address-card .address-actions { position: absolute; bottom: 0.5rem; right: 0.75rem; display: flex; gap: 0.5rem; }
    .address-card .address-actions a { font-size: 0.75rem; cursor: pointer; color: var(--primary); text-decoration: none; }
    .address-card .address-actions a:hover { text-decoration: underline; }
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
    .address-form .form-label { font-size: 0.85rem; font-weight: 500; }
    .address-form .form-control, .address-form .form-select { font-size: 0.85rem; }
    .btn-place-order { padding: 0.85rem; font-weight: 600; font-size: 1rem; letter-spacing: 0.01em; }
    .section-divider { border: none; border-top: 1px solid #e5e7eb; margin: 1.5rem 0; }
    .coupon-input-group .form-control { border-right: none; font-size: 0.85rem; }
    .coupon-input-group .btn { border-left: none; }
    .applied-coupon { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; padding: 0.4rem 0.75rem; border-radius: 6px; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.5rem; }
    .applied-coupon .remove-coupon { cursor: pointer; color: #dc2626; font-size: 0.9rem; }
    #addressModal .form-label { font-size: 0.85rem; font-weight: 500; }
    #addressModal .form-control, #addressModal .form-select { font-size: 0.85rem; }
</style>
@endpush

@section('content')
    @include('frontend.partials.breadcrumb')

    <div class="container py-4">
        <h2 class="fw-bold mb-4">Checkout</h2>

        <form action="{{ route('checkout.place') }}" method="POST" id="checkoutForm">
            @csrf
            <input type="hidden" name="address_id" id="selectedAddressId" value="">

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
                                <div class="col-md-6 address-col" data-address-id="{{ $address->id }}">
                                    <label class="address-card d-block {{ $address->is_default ? 'selected' : '' }}" data-address-id="{{ $address->id }}">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="name">{{ $address->full_name }}</span>
                                            <span class="address-radio">
                                                <input type="radio" name="address_radio" value="{{ $address->id }}" data-district="{{ $address->district }}" {{ $address->is_default ? 'checked' : '' }}>
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
                                        <div class="address-actions">
                                            <a href="javascript:void(0)" class="edit-address-btn" data-id="{{ $address->id }}" data-name="{{ $address->full_name }}" data-phone="{{ $address->phone }}" data-email="{{ $address->email }}" data-division="{{ $address->division }}" data-district="{{ $address->district }}" data-upazila="{{ $address->upazila }}" data-address-line="{{ $address->address_line }}" data-postal="{{ $address->postal_code }}" data-type="{{ $address->type }}" data-default="{{ $address->is_default ? '1' : '0' }}">
                                                <i class="fa-solid fa-pen me-1"></i>Edit
                                            </a>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-outline-primary btn-sm" type="button" id="addNewAddressBtn">
                                <i class="fa-solid fa-plus me-1"></i> Add New Address
                            </button>
                        </div>

                        <div id="noAddressWarning" class="alert alert-warning mt-3" style="display:{{ $addresses->isEmpty() ? 'block' : 'none' }};">
                            <i class="fa-solid fa-exclamation-triangle me-1"></i> Please add a shipping address to continue.
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
                            <span id="subtotalDisplay">৳{{ number_format($subtotal, 2) }}</span>
                        </div>

                        <div class="mb-3 pt-2">
                            <label class="form-label small fw-semibold text-muted mb-1">Coupon Code</label>
                            <div class="input-group input-group-sm coupon-input-group" id="couponInputGroup">
                                <input type="text" class="form-control" id="checkoutCouponCode" placeholder="Enter coupon" {{ $coupon ? 'disabled' : '' }}>
                                @if(!$coupon)
                                    <button class="btn btn-primary" type="button" id="checkoutApplyCouponBtn">Apply</button>
                                @endif
                            </div>
                            <div id="checkoutCouponMessage" class="mt-1" style="font-size: 0.75rem;"></div>
                            @if($coupon)
                                <div class="mt-2 applied-coupon" id="checkoutAppliedCoupon">
                                    <i class="fa-solid fa-tag"></i>
                                    <span>{{ $coupon->code }}</span>
                                    <span class="remove-coupon" id="checkoutRemoveCouponBtn" title="Remove"><i class="fa-solid fa-xmark"></i></span>
                                </div>
                            @endif
                        </div>

                        <div class="summary-row" id="discountRow" style="{{ $discount > 0 ? '' : 'display:none;' }}">
                            <span class="text-success">Discount <span id="discountCodeLabel">{{ $coupon ? '(' . $coupon->code . ')' : '' }}</span></span>
                            <span class="text-success" id="discountDisplay">-৳{{ number_format($discount, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Delivery Charge</span>
                            <span id="deliveryChargeDisplay">৳0</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span id="totalDisplay">৳{{ number_format($total, 2) }}</span>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3 btn-place-order" id="placeOrderBtn">
                            <i class="fa-solid fa-lock me-2"></i> Place Order
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Address Modal (Add/Edit) --}}
    <div class="modal fade" id="addressModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-semibold" id="addressModalTitle">Add New Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addressForm" class="address-form">
                        <input type="hidden" id="editAddressId" value="">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" id="addrFullName" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" id="addrPhone" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" id="addrEmail" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Division <span class="text-danger">*</span></label>
                                <input type="text" id="addrDivision" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">District <span class="text-danger">*</span></label>
                                <input type="text" id="addrDistrict" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Upazila</label>
                                <input type="text" id="addrUpazila" class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Address Line <span class="text-danger">*</span></label>
                                <textarea id="addrAddressLine" class="form-control form-control-sm" rows="2" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Postal Code</label>
                                <input type="text" id="addrPostalCode" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Type</label>
                                <select id="addrType" class="form-select form-select-sm">
                                    <option value="home">Home</option>
                                    <option value="office">Office</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" id="addrIsDefault" value="1" class="form-check-input">
                                    <label class="form-check-label" for="addrIsDefault" style="font-size: 0.85rem;">Set as default address</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btn-sm" id="saveAddressBtn">
                        <i class="fa-solid fa-check me-1"></i> Save Address
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        const insideDhakaCharge = {{ $insideDhakaCharge }};
        const outsideDhakaCharge = {{ $outsideDhakaCharge }};
        const freeDeliveryAbove = {{ $freeDeliveryAbove }};
        const subtotal = {{ $subtotal }};
        let discount = {{ $discount }};
        const storeUrl = '{{ route("customer.address.store") }}';
        const updateUrlBase = '{{ url("/account/addresses") }}';

        function updateDeliveryCharge(district) {
            let deliveryCharge = 0;
            if (subtotal <= freeDeliveryAbove) {
                deliveryCharge = (!district || district.toLowerCase() === 'dhaka') ? insideDhakaCharge : outsideDhakaCharge;
            }
            const total = subtotal - discount + deliveryCharge;
            $('#deliveryChargeDisplay').text(deliveryCharge > 0 ? '৳' + deliveryCharge.toLocaleString('en-IN') : 'Free');
            $('#totalDisplay').text('৳' + total.toLocaleString('en-IN'));
        }

        function updateDiscountDisplay(discountAmount, code) {
            discount = parseFloat(discountAmount) || 0;
            if (discount > 0) {
                $('#discountRow').show();
                $('#discountCodeLabel').text(code ? '(' + code + ')' : '');
                $('#discountDisplay').text('-৳' + discount.toLocaleString('en-IN'));
            } else {
                $('#discountRow').hide();
            }
            var district = $('input[name="address_radio"]:checked').data('district') || '';
            updateDeliveryCharge(district);
        }

        function selectAddress(addressId, district) {
            $('#selectedAddressId').val(addressId);
            $('.address-card').removeClass('selected');
            $('.address-card[data-address-id="' + addressId + '"]').addClass('selected');
            $('input[name="address_radio"][value="' + addressId + '"]').prop('checked', true);
            updateDeliveryCharge(district || '');
            $('#noAddressWarning').hide();
        }

        function buildAddressCardHtml(address, isDefault) {
            var defaultBadge = isDefault ? '<span class="badge-default">Default</span>' : '';
            return '<div class="col-md-6 address-col" data-address-id="' + address.id + '">' +
                '<label class="address-card d-block' + (isDefault ? ' selected' : '') + '" data-address-id="' + address.id + '">' +
                '<div class="d-flex justify-content-between align-items-start mb-2">' +
                '<span class="name">' + address.full_name + '</span>' +
                '<span class="address-radio"><input type="radio" name="address_radio" value="' + address.id + '" data-district="' + address.district + '"' + (isDefault ? ' checked' : '') + '></span>' +
                '</div>' +
                '<div class="phone mb-1"><i class="fa-solid fa-phone me-1"></i> ' + address.phone + '</div>' +
                '<div class="addr mb-2">' + address.address_line + ', ' + address.district + ', ' + address.division + '</div>' +
                '<div class="d-flex gap-1"><span class="badge-type">' + (address.type ? address.type.charAt(0).toUpperCase() + address.type.slice(1) : 'Home') + '</span>' + defaultBadge + '</div>' +
                '<div class="address-actions"><a href="javascript:void(0)" class="edit-address-btn" data-id="' + address.id + '" data-name="' + address.full_name + '" data-phone="' + address.phone + '" data-email="' + (address.email || '') + '" data-division="' + address.division + '" data-district="' + address.district + '" data-upazila="' + (address.upazila || '') + '" data-address-line="' + address.address_line + '" data-postal="' + (address.postal_code || '') + '" data-type="' + (address.type || 'home') + '" data-default="' + (isDefault ? '1' : '0') + '"><i class="fa-solid fa-pen me-1"></i>Edit</a></div>' +
                '</label></div>';
        }

        // Auto-select first address if available
        if ($('input[name="address_radio"]:checked').length === 0) {
            var firstRadio = $('input[name="address_radio"]').first();
            if (firstRadio.length) {
                selectAddress(firstRadio.val(), firstRadio.data('district'));
            }
        } else {
            var checkedRadio = $('input[name="address_radio"]:checked');
            $('#selectedAddressId').val(checkedRadio.val());
            updateDeliveryCharge(checkedRadio.data('district') || '');
        }

        // Address card click
        $(document).on('click', '.address-card', function (e) {
            if ($(e.target).closest('.address-actions').length) return;
            if ($(e.target).is('input[type="radio"]')) return;
            var radio = $(this).find('input[name="address_radio"]');
            selectAddress(radio.val(), radio.data('district'));
        });

        // Address radio change
        $(document).on('change', 'input[name="address_radio"]', function () {
            selectAddress($(this).val(), $(this).data('district'));
        });

        // Open Add New Address modal
        $('#addNewAddressBtn').on('click', function () {
            $('#addressModalTitle').text('Add New Address');
            $('#editAddressId').val('');
            $('#addressForm')[0].reset();
            $('#addrIsDefault').prop('checked', false);
            var modal = new bootstrap.Modal(document.getElementById('addressModal'));
            modal.show();
        });

        // Open Edit Address modal
        $(document).on('click', '.edit-address-btn', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var btn = $(this);
            $('#addressModalTitle').text('Edit Address');
            $('#editAddressId').val(btn.data('id'));
            $('#addrFullName').val(btn.data('name'));
            $('#addrPhone').val(btn.data('phone'));
            $('#addrEmail').val(btn.data('email'));
            $('#addrDivision').val(btn.data('division'));
            $('#addrDistrict').val(btn.data('district'));
            $('#addrUpazila').val(btn.data('upazila'));
            $('#addrAddressLine').val(btn.data('address-line'));
            $('#addrPostalCode').val(btn.data('postal'));
            $('#addrType').val(btn.data('type') || 'home');
            $('#addrIsDefault').prop('checked', btn.data('default') == '1');
            var modal = new bootstrap.Modal(document.getElementById('addressModal'));
            modal.show();
        });

        // Save Address (Add or Edit)
        $('#saveAddressBtn').on('click', function () {
            var fullName = $('#addrFullName').val().trim();
            var phone = $('#addrPhone').val().trim();
            var division = $('#addrDivision').val().trim();
            var district = $('#addrDistrict').val().trim();
            var addressLine = $('#addrAddressLine').val().trim();

            if (!fullName || !phone || !division || !district || !addressLine) {
                showToast('Please fill in all required fields', 'error');
                return;
            }

            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-1"></i> Saving...');

            var editId = $('#editAddressId').val();
            var isEdit = editId !== '';
            var url = isEdit ? updateUrlBase + '/' + editId : storeUrl;
            var method = isEdit ? 'PUT' : 'POST';

            var data = {
                full_name: fullName,
                phone: phone,
                email: $('#addrEmail').val().trim(),
                division: division,
                district: district,
                upazila: $('#addrUpazila').val().trim(),
                address_line: addressLine,
                postal_code: $('#addrPostalCode').val().trim(),
                type: $('#addrType').val(),
                is_default: $('#addrIsDefault').is(':checked') ? 1 : 0,
            };

            if (isEdit) {
                data._token = '{{ csrf_token() }}';
                data._method = 'PUT';
            }

            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                success: function (res) {
                    if (res.success) {
                        var addr = res.address;
                        var isDefault = addr.is_default || data.is_default;

                        if (isDefault) {
                            $('.address-card .badge-default').remove();
                        }

                        if (isEdit) {
                            // Update existing card
                            var card = $('.address-card[data-address-id="' + editId + '"]');
                            card.find('.name').text(addr.full_name);
                            card.find('.phone').html('<i class="fa-solid fa-phone me-1"></i> ' + addr.phone);
                            card.find('.addr').text(addr.address_line + ', ' + addr.district + ', ' + addr.division);
                            card.find('.badge-type').text(addr.type ? addr.type.charAt(0).toUpperCase() + addr.type.slice(1) : 'Home');
                            var radio = card.find('input[name="address_radio"]');
                            radio.data('district', addr.district);
                            radio.attr('data-district', addr.district);
                            // Update edit button data
                            var editBtn = card.find('.edit-address-btn');
                            editBtn.data('name', addr.full_name).data('phone', addr.phone).data('email', addr.email || '').data('division', addr.division).data('district', addr.district).data('upazila', addr.upazila || '').data('address-line', addr.address_line).data('postal', addr.postal_code || '').data('type', addr.type || 'home').data('default', isDefault ? '1' : '0');
                            if (isDefault) {
                                card.find('.badge-default').remove();
                                card.find('.d-flex.gap-1').append('<span class="badge-default">Default</span>');
                            }
                        } else {
                            // Add new card
                            var html = buildAddressCardHtml(addr, isDefault);
                            $('#savedAddresses').append(html);
                        }

                        // Select the address
                        selectAddress(addr.id, addr.district);

                        // Close modal
                        bootstrap.Modal.getInstance(document.getElementById('addressModal')).hide();
                        showToast(res.message || 'Address saved!');
                    }
                },
                error: function (xhr) {
                    var msg = 'Failed to save address';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = Object.values(xhr.responseJSON.errors);
                        msg = errors[0][0];
                    }
                    showToast(msg, 'error');
                },
                complete: function () {
                    btn.prop('disabled', false).html('<i class="fa-solid fa-check me-1"></i> Save Address');
                }
            });
        });

        // Payment method
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

        // Coupon
        $('#checkoutApplyCouponBtn').on('click', function() {
            const code = $('#checkoutCouponCode').val().trim();
            if (!code) { showToast('Please enter a coupon code', 'error'); return; }
            const btn = $(this);
            btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i>');
            $.ajax({
                url: '{{ url("/cart/coupon") }}',
                method: 'POST',
                data: { code: code },
                success: function(res) {
                    $('#checkoutCouponMessage').html('<span class="text-success">' + (res.message || 'Coupon applied!') + '</span>');
                    $('#checkoutCouponCode').prop('disabled', true);
                    btn.remove();
                    var couponCode = res.code || code;
                    updateDiscountDisplay(res.discount, couponCode);
                    if (!$('#checkoutAppliedCoupon').length) {
                        $('#checkoutCouponMessage').after(
                            '<div class="mt-2 applied-coupon" id="checkoutAppliedCoupon"><i class="fa-solid fa-tag"></i> <span>' + couponCode + '</span> <span class="remove-coupon" id="checkoutRemoveCouponBtn" title="Remove"><i class="fa-solid fa-xmark"></i></span></div>'
                        );
                    }
                    showToast(res.message || 'Coupon applied!');
                },
                error: function(xhr) {
                    const msg = xhr.responseJSON?.message || 'Invalid coupon';
                    $('#checkoutCouponMessage').html('<span class="text-danger">' + msg + '</span>');
                    showToast(msg, 'error');
                    btn.html('Apply').prop('disabled', false);
                }
            });
        });

        $(document).on('click', '#checkoutRemoveCouponBtn', function() {
            $.ajax({
                url: '{{ url("/cart/coupon/remove") }}',
                method: 'POST',
                success: function(res) {
                    $('#checkoutAppliedCoupon').remove();
                    $('#checkoutCouponCode').prop('disabled', false).val('');
                    $('#checkoutCouponMessage').html('');
                    $('#couponInputGroup').html('<input type="text" class="form-control" id="checkoutCouponCode" placeholder="Enter coupon"><button class="btn btn-primary" type="button" id="checkoutApplyCouponBtn">Apply</button>');
                    updateDiscountDisplay(0, '');
                    showToast('Coupon removed');
                },
                error: function() { showToast('Failed to remove coupon', 'error'); }
            });
        });

        // Form submit validation
        $('#checkoutForm').on('submit', function (e) {
            if (!$('#selectedAddressId').val()) {
                e.preventDefault();
                showToast('Please select or add a shipping address', 'error');
                $('#noAddressWarning').show();
                return false;
            }
        });
    });
</script>
@endpush
