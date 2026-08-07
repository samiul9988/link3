@extends('admin.layouts.admin')
@section('title', 'Edit Slider')
@section('page_title', 'Edit Slider')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $slider->title) }}">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $slider->subtitle) }}">
                    @error('subtitle') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $slider->description) }}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Desktop Image</label>
                    <input type="file" name="image_desktop" class="form-control" accept="image/*">
                    @if($slider->image_desktop)
                        <img src="{{ asset($slider->image_desktop) }}" class="mt-2 rounded" width="120">
                    @endif
                    @error('image_desktop') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mobile Image</label>
                    <input type="file" name="image_mobile" class="form-control" accept="image/*">
                    @if($slider->image_mobile)
                        <img src="{{ asset($slider->image_mobile) }}" class="mt-2 rounded" width="120">
                    @endif
                    @error('image_mobile') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Link</label>
                    <input type="text" name="link" class="form-control" value="{{ old('link', $slider->link) }}" placeholder="https://">
                    @error('link') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Button Text</label>
                    <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $slider->button_text) }}" maxlength="50">
                    @error('button_text') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $slider->sort_order) }}">
                    @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-check form-switch mt-4">
                        <input type="checkbox" name="status" value="1" class="form-check-input" {{ $slider->status ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Update Slider</button>
                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
