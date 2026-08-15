<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="{{ setting('primary_color', '#0D9488') }}">
    <title>{{ $pageTitle ?? setting('site_name', 'E-Commerce') }}</title>
    <meta name="description" content="{{ $metaDescription ?? setting('meta_description', '') }}">
    <meta name="keywords" content="{{ $metaKeywords ?? setting('meta_keywords', '') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="manifest" href="/manifest.json">

    <style>
        :root {
            --primary: {{ setting('primary_color', '#0D9488') }};
            --primary-dark: {{ setting('primary_color', '#0D9488') }};
            --primary-light: #CCFBF1;
            --primary-50: #F0FDFA;
            --bs-primary: {{ setting('primary_color', '#0D9488') }};
            --bs-primary-rgb: 13, 148, 136;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #1f2937;
            -webkit-font-smoothing: antialiased;
        }

        .text-primary { color: var(--primary) !important; }
        .bg-primary { background-color: var(--primary) !important; }
        .btn-primary {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }
        .btn-primary:hover {
            background-color: var(--primary-dark) !important;
            border-color: var(--primary-dark) !important;
        }
        .btn-outline-primary {
            color: var(--primary) !important;
            border-color: var(--primary) !important;
        }
        .btn-outline-primary:hover {
            background-color: var(--primary) !important;
            color: #fff !important;
        }
        a { color: var(--primary); }
        a:hover { color: var(--primary-dark); }

        .service-bar-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .service-bar-item i {
            font-size: 1.5rem;
            color: var(--primary);
        }
        .service-bar-item .text small { font-size: 0.75rem; }
        .section-heading {
            position: relative;
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        .section-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary);
            border-radius: 2px;
        }
        .view-all-link {
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
        }
        .view-all-link i {
            font-size: 0.75rem;
            transition: transform 0.2s;
        }
        .view-all-link:hover i { transform: translateX(3px); }

        .toast-container {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
        }
        .toast-notification {
            background: #fff;
            border-left: 4px solid var(--primary);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 1rem 1.25rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            min-width: 280px;
            animation: slideInRight 0.3s ease;
        }
        .toast-notification.success { border-left-color: #22c55e; }
        .toast-notification.error { border-left-color: #ef4444; }
        .toast-notification i { font-size: 1.1rem; }
        .toast-notification.success i { color: #22c55e; }
        .toast-notification.error i { color: #ef4444; }

        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .product-card { transition: box-shadow 0.3s, transform 0.3s; }
        .product-card:hover { box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important; transform: translateY(-2px); }

        .image-zoom { overflow: hidden; }
        .image-zoom img { transition: transform 0.4s ease; }
        .image-zoom:hover img { transform: scale(1.08); }

        .badge-discount {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #ef4444;
            color: #fff;
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-weight: 600;
            z-index: 2;
        }
        .badge-new {
            position: absolute;
            top: 10px;
            left: 10px;
            background: var(--primary);
            color: #fff;
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-weight: 600;
            z-index: 2;
        }
        .badge-flash {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #f59e0b;
            color: #fff;
            font-size: 0.65rem;
            padding: 0.2rem 0.45rem;
            border-radius: 4px;
            font-weight: 600;
            z-index: 2;
        }
        .wishlist-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 32px;
            height: 32px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 2;
            transition: all 0.2s;
            font-size: 0.85rem;
            color: #9ca3af;
        }
        .wishlist-btn:hover { border-color: #ef4444; color: #ef4444; }
        .wishlist-btn.active { color: #ef4444; border-color: #ef4444; }

        .rating-stars { color: #f59e0b; font-size: 0.7rem; }
        .rating-stars .empty { color: #d1d5db; }

        .search-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-top: none;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            z-index: 1000;
            display: none;
            max-height: 350px;
            overflow-y: auto;
        }
        .search-dropdown .item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            cursor: pointer;
            border-bottom: 1px solid #f3f4f6;
            transition: background 0.15s;
        }
        .search-dropdown .item:hover { background: var(--primary-50); }
        .search-dropdown .item:last-child { border-bottom: none; }
        .search-dropdown .item img { width: 45px; height: 45px; object-fit: cover; border-radius: 4px; }
        .search-dropdown .item .name { font-size: 0.85rem; font-weight: 500; color: #1f2937; }
        .search-dropdown .item .price { font-size: 0.8rem; color: var(--primary); font-weight: 600; }

        .cart-badge {
            position: absolute;
            top: -6px;
            right: -8px;
            background: #ef4444;
            color: #fff;
            font-size: 0.6rem;
            min-width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .banner-section img {
            width: 100%;
            border-radius: 8px;
            transition: transform 0.3s;
        }
        .banner-section a:hover img { transform: scale(1.02); }

        .flash-timer {
            background: #fef2f2;
            color: #ef4444;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80px;
            padding: 0.5rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            transition: border-color 0.2s;
        }
        .brand-logo:hover { border-color: var(--primary); }
        .brand-logo img { max-height: 50px; max-width: 100%; object-fit: contain; filter: grayscale(100%); opacity: 0.6; transition: all 0.3s; }
        .brand-logo:hover img { filter: grayscale(0%); opacity: 1; }

        .category-card {
            text-align: center;
            padding: 1.25rem 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            transition: all 0.3s;
            background: #fff;
            display: block;
            text-decoration: none;
            color: #1f2937;
        }
        .category-card:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 15px rgba(13,148,136,0.1);
            transform: translateY(-3px);
        }
        .category-card img { width: 60px; height: 60px; object-fit: cover; border-radius: 50%; margin-bottom: 0.5rem; }
        .category-card .name { font-size: 0.85rem; font-weight: 500; }

        .hero-slide {
            position: relative;
            overflow: hidden;
        }
        .hero-slide img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }
        .hero-content {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.2) 100%);
        }
        .hero-content .content { max-width: 600px; }
        .hero-content .content h2 { font-size: 3rem; font-weight: 700; }
        .hero-content .content p { font-size: 1.15rem; opacity: 0.85; }
        @media (max-width: 768px) {
            .hero-content .content h2 { font-size: 1.6rem; }
            .hero-content .content p { font-size: 0.9rem; }
        }

        .newsletter-form .input-group { max-width: 400px; }
        .newsletter-form input { border-radius: 6px 0 0 6px; border-right: none; }
        .newsletter-form button { border-radius: 0 6px 6px 0; }

        footer a { text-decoration: none; }
        footer a:hover { text-decoration: underline; }

        @media (max-width: 991px) {
            .offcanvas-header { background: var(--primary); color: #fff; }
            .offcanvas-header .btn-close { filter: brightness(0) invert(1); }
        }
    </style>
    @stack('styles')
</head>
<body>

    @include('frontend.layouts.partials.header')

    <main class="min-vh-100">
        @yield('content')
    </main>

    @include('frontend.layouts.partials.footer')

    <div class="toast-container" id="toastContainer"></div>

    @include('frontend.partials.toast')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function showToast(message, type = 'success') {
            const icons = { success: 'fa-circle-check', error: 'fa-circle-xmark' };
            const toast = $(`
                <div class="toast-notification ${type}">
                    <i class="fa-solid ${icons[type] || icons.success}"></i>
                    <span>${message}</span>
                </div>
            `);
            $('#toastContainer').append(toast);
            setTimeout(() => toast.fadeOut(300, () => toast.remove()), 4000);
        }

        $(document).on('click', '.wishlist-btn', function(e) {
            e.preventDefault();
            const btn = $(this);
            const productId = btn.data('product-id');
            const isLoggedIn = {{ auth()->guard('customer')->check() ? 'true' : 'false' }};

            if (!isLoggedIn) {
                showToast('Please login to add to wishlist', 'error');
                return;
            }

            $.ajax({
                url: '{{ url("/account/wishlist/toggle") }}',
                method: 'POST',
                data: { product_id: productId },
                success: function(res) {
                    btn.toggleClass('active');
                    btn.find('i').toggleClass('fa-regular fa-solid');
                    showToast(res.message);
                },
                error: function() {
                    showToast('Something went wrong', 'error');
                }
            });
        });

        $(document).on('click', '.add-to-cart-btn', function(e) {
            e.preventDefault();
            const btn = $(this);
            const productId = btn.data('product-id');
            const variantId = btn.data('variant-id') || null;
            const quantity = 1;

            btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i>');

            $.ajax({
                url: '{{ url("/cart/add") }}',
                method: 'POST',
                data: { product_id: productId, variant_id: variantId, quantity: quantity },
                success: function(res) {
                    showToast(res.message || 'Added to cart!');
                    if (res.count !== undefined) {
                        $('.cart-count').text(res.count);
                    }
                    btn.html('<i class="fa-solid fa-basket-shopping me-1"></i> Add to Cart').prop('disabled', false);
                },
                error: function() {
                    showToast('Something went wrong', 'error');
                    btn.html('<i class="fa-solid fa-basket-shopping me-1"></i> Add to Cart').prop('disabled', false);
                }
            });
        });
    </script>

    <script>
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/serviceworker.js').then(function(registration) {
            console.log('ServiceWorker registered');
        }, function(err) {
            console.log('ServiceWorker registration failed: ', err);
        });
    });
}
</script>

    @stack('scripts')
</body>
</html>
