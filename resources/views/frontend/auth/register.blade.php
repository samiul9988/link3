@extends('frontend.layouts.app')

@php $pageTitle = 'Create Account'; @endphp

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
        margin-bottom: 0.25rem;
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
        <h2 class="auth-title">Create Account</h2>
        <p class="auth-subtitle">Fill in the details to get started.</p>

        @if($errors->any())
            <div class="alert alert-danger py-2 small mb-3">
                <i class="fa-solid fa-circle-exclamation me-1"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="John Doe" required autofocus>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="you@example.com" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" placeholder="01XXXXXXXXX">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="At least 6 characters" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-enter password" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Account</button>
        </form>

        <div class="auth-links">
            Already have an account? <a href="{{ route('login') }}">Sign In</a>
        </div>
    </div>
</div>
@endsection
