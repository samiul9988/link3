@extends('admin.layouts.admin')
@section('title', 'Categories')
@section('page_title', 'Categories')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-semibold">All Categories</h6>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i> Add Category</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>Image</th><th>Name</th><th>Parent</th><th>Products</th><th>Status</th><th>Order</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>
                        @if($category->image)
                            <img src="{{ asset($category->image) }}" width="40" height="40" class="rounded" style="object-fit:cover;">
                        @else
                            <span class="badge bg-light text-muted">N/A</span>
                        @endif
                    </td>
                    <td>
                        <span @if($category->parent_id) class="ms-3" @endif>
                            {{ $category->name }}
                        </span>
                    </td>
                    <td>{{ $category->parent ? $category->parent->name : '-' }}</td>
                    <td>{{ $category->products_count ?? $category->products()->count() }}</td>
                    <td>
                        <span class="badge bg-{{ $category->status ? 'success' : 'secondary' }}">
                            {{ $category->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>{{ $category->sort_order }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" id="delete-{{ $category->id }}">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('delete-{{ $category->id }}')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">No categories found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
