@extends('admin.layouts.admin')
@section('title', 'Reviews')
@section('page_title', 'Product Reviews')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-semibold">All Reviews</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reviews as $review)
                <tr>
                    <td>{{ $review->product->name ?? 'N/A' }}</td>
                    <td>{{ $review->customer->name ?? 'N/A' }}</td>
                    <td>
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star{{ $i <= $review->rating ? ' text-warning' : ' text-muted' }}"></i>
                        @endfor
                    </td>
                    <td>{{ Str::limit($review->comment, 60) }}</td>
                    <td>
                        <span class="badge bg-{{ $review->status ? 'success' : 'secondary' }}">
                            {{ $review->status ? 'Approved' : 'Pending' }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.reviews.toggle', $review) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-info" title="Toggle Status">
                                <i class="fas fa-toggle-{{ $review->status ? 'on' : 'off' }}"></i>
                            </button>
                        </form>
                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="d-inline" id="delete-{{ $review->id }}">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('delete-{{ $review->id }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No reviews found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($reviews->hasPages())
    <div class="card-footer">
        {{ $reviews->links() }}
    </div>
    @endif
</div>
@endsection
