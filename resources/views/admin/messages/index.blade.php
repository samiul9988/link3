@extends('admin.layouts.admin')
@section('title', 'Messages')
@section('page_title', 'Contact Messages')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-semibold">All Messages</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                <tr>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ Str::limit($message->subject, 40) }}</td>
                    <td>{{ $message->created_at->format('d M, Y h:i A') }}</td>
                    <td>
                        <span class="badge bg-{{ $message->is_read ? 'success' : 'warning' }}">
                            {{ $message->is_read ? 'Read' : 'Unread' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i></a>
                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline" id="delete-{{ $message->id }}">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('delete-{{ $message->id }}')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No messages found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
    <div class="card-footer">
        {{ $messages->links() }}
    </div>
    @endif
</div>
@endsection
