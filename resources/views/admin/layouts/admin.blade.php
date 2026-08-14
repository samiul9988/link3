<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - {{ setting('site_name', 'Ecommerce') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs5.min.css" rel="stylesheet">
    <style>
        :root { --sidebar-width: 260px; --primary: #0D9488; --sidebar-bg: #0F172A; }
        body { font-family: 'Inter', sans-serif; background: #F1F5F9; }
        .sidebar { width: var(--sidebar-width); background: var(--sidebar-bg); min-height: 100vh; position: fixed; left: 0; top: 0; z-index: 1000; transition: transform 0.3s; }
        .sidebar .nav-link { color: #94A3B8; padding: 12px 20px; border-radius: 8px; margin: 2px 12px; font-size: 14px; transition: all 0.2s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,0.1); }
        .sidebar .nav-link i { width: 20px; margin-right: 10px; }
        .main-content { margin-left: var(--sidebar-width); min-height: 100vh; }
        .topbar { background: #fff; padding: 15px 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 999; }
        .content-area { padding: 25px; }
        .card { border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.04); border-radius: 12px; }
        .stat-card { background: linear-gradient(135deg, #0D9488, #0F766E); color: white; border-radius: 12px; padding: 25px; }
        .stat-card.blue { background: linear-gradient(135deg, #3B82F6, #2563EB); }
        .stat-card.green { background: linear-gradient(135deg, #10B981, #059669); }
        .stat-card.orange { background: linear-gradient(135deg, #F59E0B, #D97706); }
        .stat-card.purple { background: linear-gradient(135deg, #8B5CF6, #7C3AED); }
        @media (max-width: 991px) { .sidebar { transform: translateX(-100%); } .sidebar.show { transform: translateX(0); } .main-content { margin-left: 0; } }
        .table-hover tbody tr { cursor: pointer; }
        .sidebar-logo { padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-logo h4 { color: white; font-weight: 700; font-size: 18px; }
        nav[role="navigation"] { margin-top: 1rem; }
        nav[role="navigation"] span.inline-flex,
        nav[role="navigation"] a.inline-flex {
            display: inline-flex !important;
            align-items: center !important;
            padding: 0.375rem 0.75rem !important;
            font-size: 0.875rem !important;
            line-height: 1.25rem !important;
            border: 1px solid #dee2e6 !important;
            background: #fff !important;
            color: #0d6efd !important;
            text-decoration: none !important;
            border-radius: 0 !important;
        }
        nav[role="navigation"] span.inline-flex:first-child,
        nav[role="navigation"] a.inline-flex:first-child {
            border-radius: 0.375rem 0 0 0.375rem !important;
        }
        nav[role="navigation"] span.inline-flex:last-child,
        nav[role="navigation"] a.inline-flex:last-child {
            border-radius: 0 0.375rem 0.375rem 0 !important;
        }
        nav[role="navigation"] span[aria-current="page"] span {
            background: #0d6efd !important;
            color: #fff !important;
            border-color: #0d6efd !important;
        }
        nav[role="navigation"] span[aria-disabled="true"] span {
            color: #6c757d !important;
            background: #fff !important;
            cursor: not-allowed !important;
        }
        nav[role="navigation"] svg { width: 16px; height: 16px; }
    </style>
    @stack('styles')
</head>
<body>
    @include('admin.layouts.partials.sidebar')
    <div class="main-content">
        @include('admin.layouts.partials.header')
        <div class="content-area">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        function toggleSidebar() { document.querySelector('.sidebar').classList.toggle('show'); }
        function confirmDelete(formId) { if(confirm('Are you sure you want to delete this?')) { document.getElementById(formId).submit(); } }
    </script>
    @stack('scripts')
</body>
</html>
