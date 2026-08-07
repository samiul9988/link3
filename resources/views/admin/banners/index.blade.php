@extends('admin.layouts.admin')
@section('title', 'Banners')
@section('page_title', 'Banners')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-semibold">All Banners</h6>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i> Add Banner</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $banner)
                <tr>
                    <td>
                        @if($banner->image)
                            <img src="{{ asset($banner->image) }}" width="60" height="35" class="rounded" style="object-fit:cover;">
                        @else
                            <span class="badge bg-light text-muted">N/A</span>
                        @endif
                    </td>
                    <td>{{ $banner->title ?: '-' }}</td>
                    <td><span class="badge bg-info">{{ $banner->position }}</span></td>
                    <td>
                        <span class="badge bg-{{ $banner->status ? 'success' : 'secondary' }}">
                            {{ $banner->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline" id="delete-{{ $banner->id }}">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('delete-{{ $banner->id }}')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-4 text-muted">No banners found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
