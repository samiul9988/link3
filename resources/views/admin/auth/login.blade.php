<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - {{ setting('site_name', 'Ecommerce') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Inter', sans-serif; }
        .login-card { background: white; border-radius: 16px; padding: 40px; width: 100%; max-width: 420px; box-shadow: 0 25px 50px rgba(0,0,0,0.3); }
        .login-card .icon-circle { width: 64px; height: 64px; background: linear-gradient(135deg, #0D9488, #0F766E); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: white; font-size: 24px; }
        .form-control { padding: 12px 16px; border-radius: 10px; border: 1px solid #E2E8F0; font-size: 14px; }
        .form-control:focus { border-color: #0D9488; box-shadow: 0 0 0 3px rgba(13,148,136,0.1); }
        .btn-login { background: linear-gradient(135deg, #0D9488, #0F766E); color: white; padding: 12px; border-radius: 10px; font-weight: 600; width: 100%; border: none; }
        .btn-login:hover { background: linear-gradient(135deg, #0F766E, #0D9488); }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="icon-circle"><i class="fas fa-lock"></i></div>
        <h4 class="text-center fw-bold mb-2">Admin Login</h4>
        <p class="text-center text-muted mb-4">Sign in to your admin panel</p>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-medium">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="admin@example.com" required autofocus>
            </div>
            <div class="mb-4">
                <label class="form-label fw-medium">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt me-2"></i> Sign In
            </button>
        </form>
        <p class="text-center text-muted mt-4 mb-0" style="font-size:12px">
            <i class="fas fa-shield-alt me-1"></i> Secure Admin Panel
        </p>
    </div>
</body>
</html>
