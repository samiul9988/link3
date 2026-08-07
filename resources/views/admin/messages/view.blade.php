@extends('admin.layouts.admin')
@section('title', 'View Message')
@section('page_title', 'View Message')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label fw-semibold small text-muted">Name</label>
                <p class="mb-0">{{ $message->name }}</p>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold small text-muted">Email</label>
                <p class="mb-0">{{ $message->email }}</p>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold small text-muted">Phone</label>
                <p class="mb-0">{{ $message->phone ?? 'N/A' }}</p>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold small text-muted">Date</label>
                <p class="mb-0">{{ $message->created_at->format('d M, Y h:i A') }}</p>
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold small text-muted">Subject</label>
                <p class="mb-0">{{ $message->subject }}</p>
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold small text-muted">Message</label>
                <div class="p-3 bg-light rounded">{{ $message->message }}</div>
            </div>
        </div>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Back to Messages</a>
    </div>
</div>
@endsection
