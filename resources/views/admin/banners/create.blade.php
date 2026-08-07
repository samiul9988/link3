@extends('admin.layouts.admin')
@section('title', 'Add Banner')
@section('page_title', 'Add New Banner')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Link</label>
                    <input type="text" name="link" class="form-control" value="{{ old('link') }}" placeholder="https://">
                    @error('link') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Position <span class="text-danger">*</span></label>
                    <select name="position" class="form-select" required>
                        <option value="">Select Position</option>
                        <option value="home_top" {{ old('position') == 'home_top' ? 'selected' : '' }}>Home Top</option>
                        <option value="home_middle" {{ old('position') == 'home_middle' ? 'selected' : '' }}>Home Middle</option>
                        <option value="product_page" {{ old('position') == 'product_page' ? 'selected' : '' }}>Product Page</option>
                        <option value="listing_page" {{ old('position') == 'listing_page' ? 'selected' : '' }}>Listing Page</option>
                        <option value="checkout_page" {{ old('position') == 'checkout_page' ? 'selected' : '' }}>Checkout Page</option>
                    </select>
                    @error('position') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                    @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-check form-switch mt-4">
                        <input type="checkbox" name="status" value="1" class="form-check-input" checked>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Banner</button>
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
