<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-body login-page">
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo"><span>Arr</span>Admin</div>
                <h1>Masuk Panel Admin</h1>
                <p>Kelola konten portfolio</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-error" role="alert" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <i class="fas fa-circle-exclamation"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="post" action="{{ route('admin.login') }}" class="login-form" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                               placeholder="admin" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password"
                               placeholder="••••••••" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-right-to-bracket"></i> Login
                </button>
            </form>

            <p class="login-footer-note">
                <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Kembali ke website</a>
            </p>
        </div>
    </div>
</body>
</html>
