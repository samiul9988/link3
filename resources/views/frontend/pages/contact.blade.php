@extends('frontend.layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-6">
            <h2 class="fw-bold mb-4">Contact Us</h2>
            <p class="text-muted mb-4">Have a question or need help? Send us a message and we'll get back to you as soon as possible.</p>

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

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Get In Touch</h4>

                    @if(setting('contact_address'))
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-semibold mb-1">Address</h6>
                                <p class="text-muted mb-0">{{ setting('contact_address') }}</p>
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

                    <h5 class="fw-semibold mb-3">Follow Us</h5>
                    <div class="d-flex gap-2">
                        @if(setting('social_facebook'))
                            <a href="{{ setting('social_facebook') }}" target="_blank" class="btn btn-outline-primary rounded-circle" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if(setting('social_instagram'))
                            <a href="{{ setting('social_instagram') }}" target="_blank" class="btn btn-outline-primary rounded-circle" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if(setting('social_twitter'))
                            <a href="{{ setting('social_twitter') }}" target="_blank" class="btn btn-outline-primary rounded-circle" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;">
                                <i class="fab fa-x-twitter"></i>
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
</div>
@endsection
