@extends('admin.layouts.admin')
@section('title', 'Sliders')
@section('page_title', 'Sliders')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-semibold">All Sliders</h6>
        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i> Add Slider</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Sort Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sliders as $slider)
                <tr>
                    <td>
                        @if($slider->image_desktop)
                            <img src="{{ asset($slider->image_desktop) }}" width="60" height="35" class="rounded" style="object-fit:cover;">
                        @else
                            <span class="badge bg-light text-muted">N/A</span>
                        @endif
                    </td>
                    <td>{{ $slider->title ?: '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $slider->status ? 'success' : 'secondary' }}">
                            {{ $slider->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>{{ $slider->sort_order }}</td>
                    <td>
                        <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="d-inline" id="delete-{{ $slider->id }}">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('delete-{{ $slider->id }}')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-4 text-muted">No sliders found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
