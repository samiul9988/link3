@extends('frontend.layouts.app')

@php $pageTitle = 'Sign In'; @endphp

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
    .divider-line {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 1.5rem 0;
        color: #9ca3af;
        font-size: 0.8rem;
    }
    .divider-line::before, .divider-line::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #e5e7eb;
    }
    .divider-line::before { margin-right: 0.75rem; }
    .divider-line::after { margin-left: 0.75rem; }
    .social-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        padding: 0.6rem;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        border: 1px solid #e5e7eb;
        transition: background 0.2s, border-color 0.2s;
    }
    .social-btn.google { color: #ea4335; }
    .social-btn.google:hover { background: #fef2f2; border-color: #fecaca; }
    .social-btn.facebook { color: #1877f2; }
    .social-btn.facebook:hover { background: #eff6ff; border-color: #bfdbfe; }
    .social-btn i { font-size: 1.1rem; width: 20px; text-align: center; }
    .form-check-label { font-size: 0.85rem; color: #4b5563; }
    .form-check-input:checked { background-color: var(--primary); border-color: var(--primary); }
    .forgot-link { font-size: 0.85rem; text-decoration: none; font-weight: 500; }
</style>
@endpush

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-logo">
            <i class="fa-solid fa-store me-1"></i>{{ setting('site_name', 'E-Shop') }}
        </div>
        <h2 class="auth-title">Sign In</h2>
        <p class="auth-subtitle">Welcome back! Please sign in to continue.</p>

        @if($errors->any())
            <div class="alert alert-danger py-2 small mb-3">
                <i class="fa-solid fa-circle-exclamation me-1"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email or Phone</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
            </div>
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="password" class="form-label">Password</label>
                    <a href="{{ route('forgot.password') }}" class="forgot-link">Forgot Password?</a>
                </div>
                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="form-check-label">Remember me</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>

        @if(setting('google_enabled') || setting('facebook_enabled'))
            <div class="divider-line">or continue with</div>
            <div class="d-flex gap-2">
                @if(setting('google_enabled'))
                    <a href="{{ route('auth.google') }}" class="social-btn google">
                        <i class="fa-brands fa-google"></i> Google
                    </a>
                @endif
                @if(setting('facebook_enabled'))
                    <a href="{{ route('auth.facebook') }}" class="social-btn facebook">
                        <i class="fa-brands fa-facebook-f"></i> Facebook
                    </a>
                @endif
            </div>
        @endif

        <div class="auth-links mt-3">
            Don't have an account? <a href="{{ route('register') }}">Register</a>
        </div>
    </div>
</div>
@endsection
