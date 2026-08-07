@extends('admin.layouts.admin')
@section('title', 'Brands')
@section('page_title', 'Brands')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-semibold">All Brands</h6>
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i> Add Brand</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>Logo</th><th>Name</th><th>Products</th><th>Status</th><th>Order</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($brands as $brand)
                <tr>
                    <td>
                        @if($brand->logo)
                            <img src="{{ asset($brand->logo) }}" width="40" height="40" class="rounded" style="object-fit:cover;">
                        @else
                            <span class="badge bg-light text-muted">N/A</span>
                        @endif
                    </td>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $brand->products_count ?? $brand->products()->count() }}</td>
                    <td>
                        <span class="badge bg-{{ $brand->status ? 'success' : 'secondary' }}">
                            {{ $brand->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>{{ $brand->sort_order }}</td>
                    <td>
                        <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="d-inline" id="delete-{{ $brand->id }}">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('delete-{{ $brand->id }}')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">No brands found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
