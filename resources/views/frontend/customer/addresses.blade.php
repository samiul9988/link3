@extends('frontend.layouts.app')

@php
    $pageTitle = 'My Addresses';
@endphp

@push('styles')
<style>
    .address-card {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        transition: all 0.2s;
        position: relative;
    }
    .address-card:hover {
        border-color: var(--primary);
        box-shadow: 0 4px 12px rgba(13,148,136,0.08);
    }
    .address-card.default {
        border-color: var(--primary);
        background: var(--primary-50);
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-3">
            @include('frontend.customer.partials.sidebar')
        </div>

        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">My Addresses</h4>
                <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#addressForm">
                    <i class="fa-solid fa-plus me-1"></i> Add New Address
                </button>
            </div>

            <div class="collapse mb-4" id="addressForm">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="fw-semibold mb-0">{{ isset($editAddress) ? 'Edit Address' : 'Add New Address' }}</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($editAddress) ? url('/account/addresses/' . $editAddress->id) : url('/account/addresses') }}" method="POST">
                            @csrf
                            @if(isset($editAddress))
                                @method('PUT')
                            @endif

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="full_name" class="form-label" style="font-size: 0.85rem;">Full Name</label>
                                    <input type="text" id="full_name" name="full_name"
                                           class="form-control @error('full_name') is-invalid @enderror"
                                           value="{{ old('full_name', $editAddress->full_name ?? '') }}" required>
                                    @error('full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label" style="font-size: 0.85rem;">Phone</label>
                                    <input type="text" id="phone" name="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone', $editAddress->phone ?? '') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label" style="font-size: 0.85rem;">Email (optional)</label>
                                    <input type="email" id="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email', $editAddress->email ?? '') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="type" class="form-label" style="font-size: 0.85rem;">Address Type</label>
                                    <select id="type" name="type" class="form-select @error('type') is-invalid @enderror">
                                        <option value="home" {{ old('type', $editAddress->type ?? '') == 'home' ? 'selected' : '' }}>Home</option>
                                        <option value="office" {{ old('type', $editAddress->type ?? '') == 'office' ? 'selected' : '' }}>Office</option>
                                        <option value="other" {{ old('type', $editAddress->type ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="division" class="form-label" style="font-size: 0.85rem;">Division</label>
                                    <input type="text" id="division" name="division"
                                           class="form-control @error('division') is-invalid @enderror"
                                           value="{{ old('division', $editAddress->division ?? '') }}" required>
                                    @error('division')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="district" class="form-label" style="font-size: 0.85rem;">District</label>
                                    <input type="text" id="district" name="district"
                                           class="form-control @error('district') is-invalid @enderror"
                                           value="{{ old('district', $editAddress->district ?? '') }}" required>
                                    @error('district')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="upazila" class="form-label" style="font-size: 0.85rem;">Upazila</label>
                                    <input type="text" id="upazila" name="upazila"
                                           class="form-control @error('upazila') is-invalid @enderror"
                                           value="{{ old('upazila', $editAddress->upazila ?? '') }}" required>
                                    @error('upazila')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-8">
                                    <label for="address_line" class="form-label" style="font-size: 0.85rem;">Address Line</label>
                                    <input type="text" id="address_line" name="address_line"
                                           class="form-control @error('address_line') is-invalid @enderror"
                                           value="{{ old('address_line', $editAddress->address_line ?? '') }}" required>
                                    @error('address_line')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="postal_code" class="form-label" style="font-size: 0.85rem;">Postal Code</label>
                                    <input type="text" id="postal_code" name="postal_code"
                                           class="form-control @error('postal_code') is-invalid @enderror"
                                           value="{{ old('postal_code', $editAddress->postal_code ?? '') }}">
                                    @error('postal_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input type="checkbox" id="is_default" name="is_default" class="form-check-input" value="1"
                                               {{ old('is_default', $editAddress->is_default ?? false) ? 'checked' : '' }}>
                                        <label for="is_default" class="form-check-label" style="font-size: 0.85rem;">Set as default address</label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">
                                <i class="fa-solid fa-check me-1"></i> {{ isset($editAddress) ? 'Update Address' : 'Save Address' }}
                            </button>
                            <button type="button" class="btn btn-outline-secondary mt-3 ms-2" data-bs-toggle="collapse" data-bs-target="#addressForm">
                                Cancel
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @if(isset($addresses) && $addresses->count())
                <div class="row g-3">
                    @foreach($addresses as $address)
                        <div class="col-md-6">
                            <div class="address-card p-3 {{ $address->is_default ? 'default' : '' }}">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <span class="fw-semibold">{{ $address->full_name }}</span>
                                        <span class="d-block text-muted" style="font-size: 0.8rem;">{{ $address->phone }}</span>
                                    </div>
                                    <div class="d-flex gap-1">
                                        <span class="badge bg-primary" style="font-size: 0.65rem;">{{ ucfirst($address->type) }}</span>
                                        @if($address->is_default)
                                            <span class="badge bg-success" style="font-size: 0.65rem;">Default</span>
                                        @endif
                                    </div>
                                </div>

                                @if($address->email)
                                    <div class="text-muted mb-1" style="font-size: 0.8rem;">{{ $address->email }}</div>
                                @endif

                                <div class="text-muted mb-3" style="font-size: 0.82rem;">
                                    {{ $address->address_line }},
                                    {{ $address->upazila }},
                                    {{ $address->district }},
                                    {{ $address->division }}
                                    @if($address->postal_code)
                                        - {{ $address->postal_code }}
                                    @endif
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="{{ url('/account/addresses/' . $address->id . '/edit') }}" class="btn btn-outline-primary btn-sm" style="font-size: 0.75rem;">
                                        <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                    </a>
                                    @if(!$address->is_default)
                                        <form action="{{ url('/account/addresses/' . $address->id . '/default') }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-outline-secondary btn-sm" style="font-size: 0.75rem;">
                                                <i class="fa-solid fa-check-circle me-1"></i> Make Default
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fa-solid fa-map-location-dot fa-3x text-muted mb-3"></i>
                        <h5 class="fw-semibold">No addresses saved</h5>
                        <p class="text-muted">Add a shipping address to make checkout faster.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
