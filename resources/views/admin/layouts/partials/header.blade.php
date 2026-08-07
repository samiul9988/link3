<header class="topbar d-flex justify-content-between align-items-center">
    <div>
        <button class="btn btn-outline-secondary d-lg-none me-2" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <span class="fw-semibold text-muted">@yield('page_title', 'Dashboard')</span>
    </div>
    <div class="d-flex align-items-center gap-3">
        <form action="{{ route('admin.cache.clear') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-warning" title="Clear Cache">
                <i class="fas fa-bolt"></i> Clear Cache
            </button>
        </form>
        <a href="{{ url('/') }}" target="_blank" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-external-link-alt"></i> View Site
        </a>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width:32px;height:32px;color:white;font-size:14px;">
                    {{ substr(auth()->guard('admin')->user()->name, 0, 1) }}
                </div>
                <span class="d-none d-md-inline">{{ auth()->guard('admin')->user()->name }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fas fa-user me-2"></i> Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
