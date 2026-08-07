<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <nav class="nav flex-column">
            <a href="{{ url('/account') }}" class="nav-link {{ request()->is('account') ? 'active bg-primary text-white' : 'text-dark' }} py-2 px-3" style="border-bottom: 1px solid #f3f4f6; font-size: 0.85rem;">
                <i class="fa-solid fa-gauge me-2" style="width: 18px;"></i> Dashboard
            </a>
            <a href="{{ url('/account/orders') }}" class="nav-link {{ request()->is('account/orders*') ? 'active bg-primary text-white' : 'text-dark' }} py-2 px-3" style="border-bottom: 1px solid #f3f4f6; font-size: 0.85rem;">
                <i class="fa-solid fa-box me-2" style="width: 18px;"></i> My Orders
            </a>
            <a href="{{ url('/account/wishlist') }}" class="nav-link {{ request()->is('account/wishlist') ? 'active bg-primary text-white' : 'text-dark' }} py-2 px-3" style="border-bottom: 1px solid #f3f4f6; font-size: 0.85rem;">
                <i class="fa-regular fa-heart me-2" style="width: 18px;"></i> Wishlist
            </a>
            <a href="{{ url('/account/profile') }}" class="nav-link {{ request()->is('account/profile') ? 'active bg-primary text-white' : 'text-dark' }} py-2 px-3" style="border-bottom: 1px solid #f3f4f6; font-size: 0.85rem;">
                <i class="fa-regular fa-circle-user me-2" style="width: 18px;"></i> Profile
            </a>
            <a href="{{ url('/account/addresses') }}" class="nav-link {{ request()->is('account/addresses*') ? 'active bg-primary text-white' : 'text-dark' }} py-2 px-3" style="border-bottom: 1px solid #f3f4f6; font-size: 0.85rem;">
                <i class="fa-solid fa-location-dot me-2" style="width: 18px;"></i> Addresses
            </a>
            <a href="{{ url('/account/profile') }}" class="nav-link {{ request()->is('account/change-password') ? 'active bg-primary text-white' : 'text-dark' }} py-2 px-3" style="border-bottom: 1px solid #f3f4f6; font-size: 0.85rem;">
                <i class="fa-solid fa-lock me-2" style="width: 18px;"></i> Change Password
            </a>
            <a href="{{ url('/logout') }}" class="nav-link text-dark py-2 px-3" style="font-size: 0.85rem;"
               onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                <i class="fa-solid fa-right-from-bracket me-2" style="width: 18px;"></i> Logout
            </a>
            <form id="logout-form-sidebar" action="{{ url('/logout') }}" method="POST" class="d-none">@csrf</form>
        </nav>
    </div>
</div>

<style>
    .nav-link:hover {
        background: var(--primary-50);
    }
</style>
