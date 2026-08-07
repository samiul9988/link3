@extends('admin.layouts.admin')
@section('title', 'Customers')
@section('page_title', 'Customers')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-semibold">All Customers</h6>
        <span class="badge bg-primary">{{ $customers->total() }} customers</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Orders</th>
                    <th>Status</th>
                    <th>Join Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width:36px;height:36px;color:white;font-size:14px;font-weight:600;">
                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                            </div>
                            <div>
                                <a href="{{ route('admin.customers.show', $customer) }}" class="fw-medium text-decoration-none">
                                    {{ $customer->name }}
                                </a>
                            </div>
                        </div>
                    </td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone ?: '—' }}</td>
                    <td>
                        <span class="badge bg-info">{{ $customer->orders_count }}</span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $customer->status ? 'success' : 'secondary' }}">
                            {{ $customer->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>{{ $customer->created_at->format('d M, Y') }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-sm btn-outline-primary" title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form action="{{ route('admin.customers.toggleStatus', $customer) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-{{ $customer->status ? 'danger' : 'success' }}"
                                    title="{{ $customer->status ? 'Deactivate' : 'Activate' }}">
                                <i class="fas fa-{{ $customer->status ? 'ban' : 'check' }}"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No customers found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($customers->hasPages())
    <div class="card-footer">
        {{ $customers->links() }}
    </div>
    @endif
</div>
@endsection
