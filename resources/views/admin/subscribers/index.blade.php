@extends('admin.layouts.admin')
@section('title', 'Subscribers')
@section('page_title', 'Newsletter Subscribers')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-semibold">All Subscribers</h6>
        <a href="{{ route('admin.subscribers.export') }}" class="btn btn-success btn-sm"><i class="fas fa-download me-1"></i> Export CSV</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subscribers as $subscriber)
                <tr>
                    <td>{{ $subscriber->email }}</td>
                    <td>
                        <span class="badge bg-{{ $subscriber->status ? 'success' : 'secondary' }}">
                            {{ $subscriber->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>{{ $subscriber->created_at->format('d M, Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-muted">No subscribers found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($subscribers->hasPages())
    <div class="card-footer">
        {{ $subscribers->links() }}
    </div>
    @endif
</div>
@endsection
