@extends('frontend.layouts.app')

@php
    $pageTitle = $page->title;
    $metaDescription = $page->meta_description ?? '';
    $metaKeywords = $page->meta_keywords ?? '';
@endphp

@if($page->meta_title)
    @php $pageTitle = $page->meta_title; @endphp
@endif

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h3 class="fw-bold mb-4">{{ $page->title }}</h3>

            <div class="cms-content" style="font-size: 0.95rem; line-height: 1.8; color: #374151;">
                {!! $page->content !!}
            </div>

            @if($page->slug === 'contact')
                <hr class="my-5">
                <div class="row g-5">
                    <div class="col-lg-7">
                        <h4 class="fw-bold mb-4">Send Us a Message</h4>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ url('/contact') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Subject</label>
                                    <input type="text" name="subject" class="form-control" value="{{ old('subject') }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Message <span class="text-danger">*</span></label>
                                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="5" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-paper-plane me-2"></i> Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-4">Get In Touch</h5>

                                @if(setting('address'))
                                    <div class="d-flex mb-4">
                                        <div class="flex-shrink-0">
                                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                                <i class="fas fa-map-marker-alt text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fw-semibold mb-1">Address</h6>
                                            <p class="text-muted mb-0">{{ setting('address') }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if(setting('contact_phone'))
                                    <div class="d-flex mb-4">
                                        <div class="flex-shrink-0">
                                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                                <i class="fas fa-phone text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fw-semibold mb-1">Phone</h6>
                                            <p class="text-muted mb-0">{{ setting('contact_phone') }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if(setting('contact_email'))
                                    <div class="d-flex mb-4">
                                        <div class="flex-shrink-0">
                                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                                <i class="fas fa-envelope text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fw-semibold mb-1">Email</h6>
                                            <p class="text-muted mb-0">{{ setting('contact_email') }}</p>
                                        </div>
                                    </div>
                                @endif

                                <hr class="my-4">

                                <h6 class="fw-semibold mb-3">Follow Us</h6>
                                <div class="d-flex gap-2">
                                    @if(setting('facebook_url'))
                                        <a href="{{ setting('facebook_url') }}" target="_blank" class="btn btn-outline-primary rounded-circle" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    @endif
                                    @if(setting('instagram_url'))
                                        <a href="{{ setting('instagram_url') }}" target="_blank" class="btn btn-outline-primary rounded-circle" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    @endif
                                    @if(setting('twitter_url'))
                                        <a href="{{ setting('twitter_url') }}" target="_blank" class="btn btn-outline-primary rounded-circle" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;">
                                            <i class="fab fa-x-twitter"></i>
                                        </a>
                                    @endif
                                    @if(setting('youtube_url'))
                                        <a href="{{ setting('youtube_url') }}" target="_blank" class="btn btn-outline-danger rounded-circle" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    @endif
                                    @if(setting('whatsapp_number'))
                                        <a href="https://wa.me/{{ setting('whatsapp_number') }}" target="_blank" class="btn btn-outline-success rounded-circle" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .cms-content img {
        max-width: 100%;
        height: auto;
        border-radius: 6px;
    }
    .cms-content h1, .cms-content h2, .cms-content h3, .cms-content h4, .cms-content h5, .cms-content h6 {
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        font-weight: 600;
    }
    .cms-content p {
        margin-bottom: 1rem;
    }
    .cms-content ul, .cms-content ol {
        padding-left: 1.25rem;
        margin-bottom: 1rem;
    }
    .cms-content table {
        width: 100%;
        margin-bottom: 1rem;
    }
    .cms-content table td,
    .cms-content table th {
        border: 1px solid #e5e7eb;
        padding: 0.5rem 0.75rem;
    }
    .cms-content blockquote {
        border-left: 3px solid var(--primary);
        padding: 0.75rem 1rem;
        background: var(--primary-50);
        margin-bottom: 1rem;
        border-radius: 0 6px 6px 0;
    }
</style>
@endpush
@endsection
