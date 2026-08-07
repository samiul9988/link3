@extends('admin.layouts.admin')
@section('title', 'Edit Banner')
@section('page_title', 'Edit Banner')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title) }}">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @if($banner->image)
                        <img src="{{ asset($banner->image) }}" class="mt-2 rounded" width="120">
                    @endif
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Link</label>
                    <input type="text" name="link" class="form-control" value="{{ old('link', $banner->link) }}" placeholder="https://">
                    @error('link') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Position <span class="text-danger">*</span></label>
                    <select name="position" class="form-select" required>
                        <option value="">Select Position</option>
                        <option value="home_top" {{ old('position', $banner->position) == 'home_top' ? 'selected' : '' }}>Home Top</option>
                        <option value="home_middle" {{ old('position', $banner->position) == 'home_middle' ? 'selected' : '' }}>Home Middle</option>
                        <option value="product_page" {{ old('position', $banner->position) == 'product_page' ? 'selected' : '' }}>Product Page</option>
                        <option value="listing_page" {{ old('position', $banner->position) == 'listing_page' ? 'selected' : '' }}>Listing Page</option>
                        <option value="checkout_page" {{ old('position', $banner->position) == 'checkout_page' ? 'selected' : '' }}>Checkout Page</option>
                    </select>
                    @error('position') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $banner->sort_order) }}">
                    @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-check form-switch mt-4">
                        <input type="checkbox" name="status" value="1" class="form-check-input" {{ $banner->status ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Update Banner</button>
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
