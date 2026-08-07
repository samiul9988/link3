@extends('admin.layouts.admin')
@section('title', 'Add Coupon')
@section('page_title', 'Add New Coupon')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.coupons.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Code <span class="text-danger">*</span></label>
                    <input type="text" name="code" class="form-control text-uppercase" value="{{ old('code') }}" required maxlength="50" placeholder="SAVE20">
                    @error('code') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Type <span class="text-danger">*</span></label>
                    <select name="type" class="form-select" required>
                        <option value="">Select Type</option>
                        <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                        <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Percentage</option>
                    </select>
                    @error('type') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Value <span class="text-danger">*</span></label>
                    <input type="number" name="value" class="form-control" value="{{ old('value') }}" required step="0.01" min="0">
                    @error('value') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Min Order Amount</label>
                    <input type="number" name="min_order_amount" class="form-control" value="{{ old('min_order_amount') }}" step="0.01" min="0">
                    @error('min_order_amount') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Max Discount</label>
                    <input type="number" name="max_discount" class="form-control" value="{{ old('max_discount') }}" step="0.01" min="0">
                    @error('max_discount') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Usage Limit</label>
                    <input type="number" name="usage_limit" class="form-control" value="{{ old('usage_limit') }}" min="1" placeholder="Leave empty for unlimited">
                    @error('usage_limit') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Starts At <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="starts_at" class="form-control" value="{{ old('starts_at') }}" required>
                    @error('starts_at') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Expires At <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="expires_at" class="form-control" value="{{ old('expires_at') }}" required>
                    @error('expires_at') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-4">
                    <div class="form-check form-switch mt-4">
                        <input type="checkbox" name="status" value="1" class="form-check-input" checked>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Coupon</button>
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
