@extends('admin.layouts.admin')
@section('title', 'Coupons')
@section('page_title', 'Coupons')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-semibold">All Coupons</h6>
        <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i> Add Coupon</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Usage</th>
                    <th>Validity Period</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($coupons as $coupon)
                <tr>
                    <td><strong>{{ $coupon->code }}</strong></td>
                    <td>
                        <span class="badge bg-{{ $coupon->type == 'percent' ? 'info' : 'warning' }}">
                            {{ $coupon->type == 'percent' ? 'Percent' : 'Fixed' }}
                        </span>
                    </td>
                    <td>
                        {{ $coupon->type == 'percent' ? $coupon->value . '%' : '$' . number_format($coupon->value, 2) }}
                    </td>
                    <td>
                        {{ $coupon->used_count ?? 0 }}
                        @if($coupon->usage_limit)
                            / {{ $coupon->usage_limit }}
                        @else
                            / &infin;
                        @endif
                    </td>
                    <td>
                        <small>
                            {{ $coupon->starts_at ? $coupon->starts_at->format('d M Y') : '-' }}
                            -
                            {{ $coupon->expires_at ? $coupon->expires_at->format('d M Y') : '-' }}
                        </small>
                    </td>
                    <td>
                        <span class="badge bg-{{ $coupon->status ? 'success' : 'secondary' }}">
                            {{ $coupon->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" class="d-inline" id="delete-{{ $coupon->id }}">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('delete-{{ $coupon->id }}')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">No coupons found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
