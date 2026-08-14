@php
    $siteName = setting('site_name', 'E-Commerce');
    $logo = setting('logo');
    $topBarText = setting('topbar_text', 'Welcome to our store!');
    $categories = \App\Models\Category::where('status', 1)->whereNull('parent_id')->with(['children' => function($q) { $q->where('status', 1); }])->orderBy('sort_order')->take(10)->get();
    $pages = \App\Models\Page::where('status', 1)->orderBy('id')->get();
@endphp

<header class="sticky-top">
    <div class="bg-primary text-white py-1 d-none d-md-block" style="font-size: 0.8rem;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <span>{{ $topBarText }}</span>
                <div>
                    <a href="tel:{{ setting('contact_phone', '') }}" class="text-white text-decoration-none me-3">
                        <i class="fa-solid fa-phone me-1"></i> {{ setting('contact_phone', '+8801XXX') }}
                    </a>
                    <a href="mailto:{{ setting('contact_email', '') }}" class="text-white text-decoration-none">
                        <i class="fa-solid fa-envelope me-1"></i> {{ setting('contact_email', 'support@example.com') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white border-bottom py-2" style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
        <div class="container">
            <div class="row align-items-center g-3">
                <div class="col-5 col-lg-2">
                    <a href="{{ url('/') }}" class="d-block">
                        @if($logo)
                            <img src="{{ asset($logo) }}" alt="{{ $siteName }}" style="height: 40px;">
                        @else
                            <span class="fw-bold fs-4 text-primary">{{ $siteName }}</span>
                        @endif
                    </a>
                </div>

                <div class="col-lg-5 d-none d-lg-block position-relative">
                    <form action="{{ url('/search') }}" method="GET" class="search-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control search-input" placeholder="Search products..." autocomplete="off"
                                   style="border-radius: 6px 0 0 6px; border-color: #e5e7eb;">
                            <button class="btn btn-primary" type="submit" style="border-radius: 0 6px 6px 0;">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                    <div class="search-dropdown" id="searchDropdown"></div>
                </div>

                <div class="col-7 col-lg-5">
                    <div class="d-flex align-items-center justify-content-end gap-1 gap-md-2">
                        <button class="btn btn-link text-dark d-lg-none p-0 me-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
                            <i class="fa-solid fa-bars fs-5"></i>
                        </button>

                        <div class="d-none d-md-flex gap-2 align-items-center">
                            @auth('customer')
                                <div class="dropdown">
                                    <button class="btn btn-link text-dark text-decoration-none dropdown-toggle p-0" data-bs-toggle="dropdown" style="font-size: 0.85rem;">
                                        <i class="fa-regular fa-circle-user me-1"></i> {{ auth('customer')->user()->name }}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="border-radius: 8px;">
                                        <li><a href="{{ url('/account') }}" class="dropdown-item"><i class="fa-solid fa-user me-2"></i> My Account</a></li>
                                        <li><a href="{{ url('/account/orders') }}" class="dropdown-item"><i class="fa-solid fa-box me-2"></i> My Orders</a></li>
                                        <li><a href="{{ url('/account/wishlist') }}" class="dropdown-item"><i class="fa-regular fa-heart me-2"></i> My Wishlist</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a href="{{ url('/logout') }}" class="dropdown-item"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                                            </a>
                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">@csrf</form>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <a href="{{ url('/login') }}" class="btn btn-link text-dark text-decoration-none p-0" style="font-size: 0.85rem;">
                                    <i class="fa-regular fa-circle-user me-1"></i> Login
                                </a>
                                <span class="text-muted" style="font-size: 0.8rem;">|</span>
                                <a href="{{ url('/register') }}" class="btn btn-link text-dark text-decoration-none p-0" style="font-size: 0.85rem;">
                                    Register
                                </a>
                            @endauth
                        </div>

                        <a href="{{ url('/account/wishlist') }}" class="btn btn-link text-dark p-0 position-relative d-none d-md-inline-block">
                            <i class="fa-regular fa-heart fs-5"></i>
                            @auth('customer')
                                @php $wishlistCount = \App\Models\Wishlist::where('customer_id', auth('customer')->id())->count(); @endphp
                                @if($wishlistCount > 0)
                                    <span class="cart-badge">{{ $wishlistCount }}</span>
                                @endif
                            @endauth
                        </a>

                        <a href="{{ url('/cart') }}" class="btn btn-link text-dark p-0 position-relative">
                            <i class="fa-solid fa-bag-shopping fs-5"></i>
                            <span class="cart-badge cart-count">{{ cart_count() }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="d-lg-none mt-2">
                <form action="{{ url('/search') }}" method="GET">
                    <div class="input-group input-group-sm">
                        <input type="text" name="q" class="form-control" placeholder="Search products..." style="border-radius: 6px 0 0 6px;">
                        <button class="btn btn-primary" type="submit" style="border-radius: 0 6px 6px 0;">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <nav class="bg-white border-bottom d-none d-lg-block">
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="dropdown mega-menu-trigger">
                    <button class="btn btn-primary dropdown-toggle px-3 py-2 rounded-0" style="font-size: 0.85rem;" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                        <i class="fa-solid fa-bars-staggered me-2"></i>All Categories
                    </button>
                    <div class="dropdown-menu mega-dropdown p-3 border-0 shadow-lg" style="width: 720px; border-radius: 0 0 12px 12px;">
                        <div class="row">
                            @php $catChunks = $categories->chunk(ceil($categories->count() / 3)); @endphp
                            @foreach($catChunks as $chunk)
                                <div class="col-4">
                                    @foreach($chunk as $category)
                                        <a href="{{ url('/category/' . $category->slug) }}" class="d-block fw-semibold mb-1 text-decoration-none" style="font-size: 0.8rem;">
                                            <i class="fa-solid fa-chevron-right me-1" style="font-size: 0.5rem;"></i> {{ $category->name }}
                                        </a>
                                        @foreach($category->children as $child)
                                            <a href="{{ url('/category/' . $child->slug) }}" class="d-block text-muted ps-3 mb-1 text-decoration-none" style="font-size: 0.75rem;">
                                                {{ $child->name }}
                                            </a>
                                        @endforeach
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <ul class="list-unstyled d-flex mb-0 ms-2 gap-0">
                    <li><a href="{{ url('/') }}" class="d-block px-3 py-2 text-dark text-decoration-none fw-medium" style="font-size: 0.85rem;">Home</a></li>
                    <li><a href="{{ url('/products') }}" class="d-block px-3 py-2 text-dark text-decoration-none fw-medium" style="font-size: 0.85rem;">All Products</a></li>
                    @foreach($pages->take(5) as $page)
                        <li><a href="{{ url('/page/' . $page->slug) }}" class="d-block px-3 py-2 text-dark text-decoration-none fw-medium" style="font-size: 0.85rem;">{{ $page->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="mobileMenu">
    <div class="offcanvas-header bg-primary text-white">
        <h5 class="offcanvas-title"><i class="fa-solid fa-bars me-2"></i> Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="list-group list-group-flush">
            <a href="{{ url('/') }}" class="list-group-item list-group-item-action"><i class="fa-solid fa-house me-2"></i> Home</a>
            <a href="{{ url('/products') }}" class="list-group-item list-group-item-action"><i class="fa-solid fa-box me-2"></i> All Products</a>
        </div>
        <div class="px-3 py-2 fw-semibold text-primary"><i class="fa-solid fa-layer-group me-2"></i> Categories</div>
        <div class="list-group list-group-flush border-bottom">
            @foreach($categories as $category)
                <a href="{{ url('/category/' . $category->slug) }}" class="list-group-item list-group-item-action ps-4">
                    {{ $category->name }}
                    @if($category->children->count())
                        <span class="badge bg-light text-dark ms-1" style="font-size: 0.65rem;">+{{ $category->children->count() }}</span>
                    @endif
                </a>
            @endforeach
        </div>
        <div class="px-3 py-2 fw-semibold text-primary"><i class="fa-solid fa-file-lines me-2"></i> Pages</div>
        <div class="list-group list-group-flush">
            @foreach($pages as $page)
                <a href="{{ url('/page/' . $page->slug) }}" class="list-group-item list-group-item-action">{{ $page->title }}</a>
            @endforeach
        </div>
        <div class="px-3 py-3">
            @auth('customer')
                <p class="mb-2"><i class="fa-regular fa-circle-user me-1"></i> {{ auth('customer')->user()->name }}</p>
                <a href="{{ url('/account') }}" class="btn btn-outline-primary btn-sm w-100 mb-2">My Account</a>
                <a href="{{ url('/logout') }}" class="btn btn-outline-danger btn-sm w-100"
                   onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">Logout</a>
                <form id="logout-form-mobile" action="{{ url('/logout') }}" method="POST" class="d-none">@csrf</form>
            @else
                <a href="{{ url('/login') }}" class="btn btn-primary btn-sm w-100 mb-2">Login</a>
                <a href="{{ url('/register') }}" class="btn btn-outline-primary btn-sm w-100">Register</a>
            @endauth
        </div>
    </div>
</div>

@push('scripts')
<script>
$(function() {
    let searchTimer;
    $('.search-input').on('keyup', function() {
        const q = $(this).val().trim();
        const dropdown = $('#searchDropdown');
        if (q.length < 2) { dropdown.hide(); return; }

        clearTimeout(searchTimer);
        searchTimer = setTimeout(function() {
            $.ajax({
                url: '{{ url("/search/ajax") }}',
                data: { q: q },
                success: function(products) {
                    if (products.length === 0) {
                        dropdown.html('<div class="p-3 text-muted text-center" style="font-size:0.85rem;">No products found</div>').show();
                        return;
                    }
                    dropdown.html(products.map(function(p) {
                        return `<a href="{{ url('/product') }}/${p.slug}" class="item text-decoration-none">
                            <img src="${p.image || '{{ asset("placeholder.png") }}'}" alt="${p.name}">
                            <div>
                                <div class="name">${p.name}</div>
                                <div class="price">${p.price ? '৳ ' + parseFloat(p.price).toLocaleString('en-IN') : ''}</div>
                            </div>
                        </a>`;
                    }).join('')).show();
                }
            });
        }, 350);
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('.search-form').length) {
            $('#searchDropdown').hide();
        }
    });
});
</script>
@endpush
