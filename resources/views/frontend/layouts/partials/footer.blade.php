@php
    $siteName = setting('site_name', 'E-Commerce');
    $logo = setting('site_footer_logo') ?: setting('site_logo');
    $categories = \App\Models\Category::where('status', 1)->whereNull('parent_id')->orderBy('sort_order')->take(8)->get();
@endphp

<footer class="bg-dark text-white pt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                @if($logo)
                    <img src="{{ asset($logo) }}" alt="{{ $siteName }}" class="mb-3" style="height: 35px; filter: brightness(0) invert(1);">
                @else
                    <h5 class="fw-bold text-white mb-3">{{ $siteName }}</h5>
                @endif
                <p class="text-white-50" style="font-size: 0.85rem;">{{ setting('site_about', 'Your trusted online shopping destination.') }}</p>
                <div class="d-flex gap-2 mt-3">
                    @if(setting('social_facebook'))
                        <a href="{{ setting('social_facebook') }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle" style="width:34px;height:34px;display:flex;align-items:center;justify-content:center;">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    @endif
                    @if(setting('social_instagram'))
                        <a href="{{ setting('social_instagram') }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle" style="width:34px;height:34px;display:flex;align-items:center;justify-content:center;">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    @endif
                    @if(setting('social_twitter'))
                        <a href="{{ setting('social_twitter') }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle" style="width:34px;height:34px;display:flex;align-items:center;justify-content:center;">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                    @endif
                    @if(setting('social_youtube'))
                        <a href="{{ setting('social_youtube') }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle" style="width:34px;height:34px;display:flex;align-items:center;justify-content:center;">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    @endif
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="fw-semibold text-white mb-3">Quick Links</h6>
                <ul class="list-unstyled" style="font-size: 0.85rem;">
                    <li class="mb-2"><a href="{{ url('/about') }}" class="text-white-50 text-decoration-none">About Us</a></li>
                    <li class="mb-2"><a href="{{ url('/contact') }}" class="text-white-50 text-decoration-none">Contact</a></li>
                    <li class="mb-2"><a href="{{ url('/faq') }}" class="text-white-50 text-decoration-none">FAQ</a></li>
                    <li class="mb-2"><a href="{{ url('/page/privacy-policy') }}" class="text-white-50 text-decoration-none">Privacy Policy</a></li>
                    <li class="mb-2"><a href="{{ url('/page/terms-conditions') }}" class="text-white-50 text-decoration-none">Terms & Conditions</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="fw-semibold text-white mb-3">Categories</h6>
                <ul class="list-unstyled" style="font-size: 0.85rem;">
                    @foreach($categories as $category)
                        <li class="mb-2"><a href="{{ url('/category/' . $category->slug) }}" class="text-white-50 text-decoration-none">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <h6 class="fw-semibold text-white mb-3">Contact Info</h6>
                <ul class="list-unstyled text-white-50" style="font-size: 0.85rem;">
                    @if(setting('contact_address'))
                        <li class="mb-2"><i class="fa-solid fa-location-dot me-2 text-primary"></i> {{ setting('contact_address') }}</li>
                    @endif
                    @if(setting('contact_phone'))
                        <li class="mb-2"><i class="fa-solid fa-phone me-2 text-primary"></i> {{ setting('contact_phone') }}</li>
                    @endif
                    @if(setting('contact_email'))
                        <li class="mb-2"><i class="fa-solid fa-envelope me-2 text-primary"></i> {{ setting('contact_email') }}</li>
                    @endif
                </ul>

                <h6 class="fw-semibold text-white mb-2 mt-3">Newsletter</h6>
                <form action="{{ url('/newsletter') }}" method="POST" class="newsletter-form">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="email" name="email" class="form-control" placeholder="Your email" required>
                        <button class="btn btn-primary" type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <hr class="border-secondary my-4">

        <div class="row align-items-center pb-3">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                <small class="text-white-50">&copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.</small>
            </div>
            <div class="col-md-6 text-center text-md-end">
                @php
                    $paymentImg = setting('payment_icons');
                @endphp
                @if($paymentImg)
                    <img src="{{ asset($paymentImg) }}" alt="Payment Methods" style="height: 25px;">
                @else
                    <span class="text-white-50">
                        <i class="fa-brands fa-cc-visa me-1 fs-5"></i>
                        <i class="fa-brands fa-cc-mastercard me-1 fs-5"></i>
                        <i class="fa-brands fa-cc-paypal me-1 fs-5"></i>
                        <i class="fa-brands fa-cc-amex fs-5"></i>
                    </span>
                @endif
            </div>
        </div>
    </div>
</footer>
