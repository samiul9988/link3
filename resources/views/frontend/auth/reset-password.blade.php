@extends('frontend.layouts.app')

@php $pageTitle = 'Reset Password'; @endphp

@push('styles')
<style>
    .auth-wrapper {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f9fafb;
        padding: 2rem 0;
    }
    .auth-card {
        width: 100%;
        max-width: 450px;
        background: #fff;
        border-radius: 12px;
        padding: 2.5rem 2rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 8px 24px rgba(0,0,0,0.04);
    }
    .auth-logo {
        text-align: center;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
    }
    .auth-title {
        font-size: 1.35rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 0.5rem;
    }
    .auth-subtitle {
        text-align: center;
        color: #6b7280;
        font-size: 0.85rem;
        margin-bottom: 1.75rem;
    }
    .auth-card .form-label { font-size: 0.85rem; font-weight: 500; color: #374151; }
    .auth-card .form-control {
        font-size: 0.9rem;
        padding: 0.65rem 0.85rem;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .auth-card .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(13,148,136,0.1);
    }
    .auth-card .form-control[readonly] { background: #f9fafb; cursor: default; }
    .auth-card .btn-primary {
        padding: 0.7rem;
        font-weight: 600;
        font-size: 0.95rem;
        border-radius: 8px;
        width: 100%;
    }
    .auth-links {
        text-align: center;
        font-size: 0.85rem;
        margin-top: 1.25rem;
    }
    .auth-links a { text-decoration: none; font-weight: 500; }
</style>
@endpush

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-logo">
            <i class="fa-solid fa-store me-1"></i>{{ setting('site_name', 'E-Shop') }}
        </div>
        <h2 class="auth-title">Reset Password</h2>
        <p class="auth-subtitle">Enter your new password below.</p>

        @if($errors->any())
            <div class="alert alert-danger py-2 small mb-3">
                <i class="fa-solid fa-circle-exclamation me-1"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('reset.password.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $email }}" readonly>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="At least 6 characters" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-enter password" required>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>

        <div class="auth-links">
            <a href="{{ route('login') }}"><i class="fa-solid fa-arrow-left me-1"></i> Back to Login</a>
        </div>
    </div>
</div>
@endsection
