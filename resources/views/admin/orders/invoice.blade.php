@php
    $siteName = setting('site_name', 'Ecommerce');
    $siteAddress = setting('site_address', '');
    $sitePhone = setting('site_phone', '');
    $siteEmail = setting('site_email', '');
    $siteLogo = setting('site_logo', '');
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_number }} - {{ $siteName }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: #fff !important; }
            .invoice-wrapper { box-shadow: none !important; padding: 0 !important; }
        }
        body { background: #F1F5F9; padding: 30px 0; }
        .invoice-wrapper { max-width: 800px; margin: 0 auto; background: #fff; padding: 40px; box-shadow: 0 2px 20px rgba(0,0,0,0.08); border-radius: 8px; }
        .invoice-header { border-bottom: 2px solid #0D9488; padding-bottom: 20px; margin-bottom: 25px; }
        .invoice-header .logo { max-height: 50px; }
        .invoice-to { margin-bottom: 25px; }
        .invoice-table th { background: #F8FAFC; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; color: #64748B; }
        .invoice-table td { font-size: 14px; }
        .invoice-summary { max-width: 300px; margin-left: auto; }
        .invoice-summary td { padding: 6px 12px; font-size: 14px; }
        .invoice-summary .total-row td { font-size: 16px; font-weight: 700; border-top: 2px solid #0D9488; }
        .invoice-footer { margin-top: 40px; padding-top: 20px; border-top: 1px solid #E2E8F0; font-size: 13px; color: #94A3B8; }
    </style>
</head>
<body>
    <div class="invoice-wrapper">
        {{-- Print Button --}}
        <div class="text-end mb-4 no-print">
            <button onclick="window.print()" class="btn btn-primary btn-sm">
                <i class="fas fa-print me-1"></i> Print Invoice
            </button>
            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline-secondary btn-sm ms-2">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>

        {{-- Header --}}
        <div class="invoice-header d-flex justify-content-between align-items-start">
            <div>
                @if($siteLogo)
                    <img src="{{ asset($siteLogo) }}" alt="{{ $siteName }}" class="logo mb-2">
                @else
                    <h4 class="fw-bold text-primary mb-1">{{ $siteName }}</h4>
                @endif
                @if($siteAddress)
                    <div class="text-muted" style="font-size:13px;">{{ $siteAddress }}</div>
                @endif
                @if($sitePhone)
                    <div class="text-muted" style="font-size:13px;">Phone: {{ $sitePhone }}</div>
                @endif
                @if($siteEmail)
                    <div class="text-muted" style="font-size:13px;">Email: {{ $siteEmail }}</div>
                @endif
            </div>
            <div class="text-end">
                <h3 class="fw-bold text-primary mb-1">INVOICE</h3>
                <div style="font-size:14px;"><strong>Invoice #:</strong> {{ $order->order_number }}</div>
                <div style="font-size:13px;color:#64748B;">Date: {{ $order->created_at->format('d M, Y') }}</div>
                <div style="font-size:13px;color:#64748B;">Payment: {{ ucfirst($order->payment_method) }}</div>
            </div>
        </div>

        {{-- Bill To & Order Info --}}
        <div class="row invoice-to">
            <div class="col-7">
                <h6 class="fw-semibold text-muted text-uppercase" style="font-size:12px;letter-spacing:0.5px;">Bill To</h6>
                @if($order->customer)
                    <div class="fw-semibold">{{ $order->customer->name }}</div>
                    <div>{{ $order->customer->email }}</div>
                    @if($order->customer->phone)
                        <div>{{ $order->customer->phone }}</div>
                    @endif
                @else
                    <div class="text-muted">Guest</div>
                @endif
            </div>
            <div class="col-5">
                <h6 class="fw-semibold text-muted text-uppercase" style="font-size:12px;letter-spacing:0.5px;">Ship To</h6>
                @if($order->address)
                    <div class="fw-semibold">{{ $order->address->full_name }}</div>
                    <div>{{ $order->address->phone }}</div>
                    <div>{{ $order->address->address_line }}, {{ $order->address->upazila }}</div>
                    <div>{{ $order->address->district }}, {{ $order->address->division }}</div>
                    @if($order->address->postal_code)
                        <div>{{ $order->address->postal_code }}</div>
                    @endif
                @else
                    <div class="text-muted">—</div>
                @endif
            </div>
        </div>

        {{-- Items Table --}}
        <table class="table invoice-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Unit Price</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div>{{ $item->product_name }}</div>
                        @if($item->variant_details)
                            <small class="text-muted">{{ $item->variant_details }}</small>
                        @endif
                    </td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-end">৳{{ number_format($item->unit_price, 2) }}</td>
                    <td class="text-end">৳{{ number_format($item->subtotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Summary --}}
        <table class="invoice-summary table table-borderless">
            <tbody>
                <tr>
                    <td class="text-muted">Subtotal</td>
                    <td class="text-end">৳{{ number_format($order->subtotal, 2) }}</td>
                </tr>
                @if($order->discount > 0)
                <tr>
                    <td class="text-muted">Discount</td>
                    <td class="text-end text-danger">- ৳{{ number_format($order->discount, 2) }}</td>
                </tr>
                @endif
                <tr>
                    <td class="text-muted">Delivery Charge</td>
                    <td class="text-end">৳{{ number_format($order->delivery_charge, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td>Total</td>
                    <td class="text-end">৳{{ number_format($order->total, 2) }}</td>
                </tr>
            </tbody>
        </table>

        @if($order->admin_note)
        <div class="mt-4">
            <strong style="font-size:13px;">Note:</strong>
            <p class="text-muted mb-0" style="font-size:13px;">{{ $order->admin_note }}</p>
        </div>
        @endif

        {{-- Footer --}}
        <div class="invoice-footer text-center">
            Thank you for your order. For any queries, please contact us.
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
