<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Admin Portofolio</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-brand">
                <a href="{{ route('admin.dashboard') }}">
                    <span class="brand-accent">Arr</span>Admin
                </a>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.portfolio.index') }}" class="nav-item {{ request()->routeIs('admin.portfolio.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i>
                    <span>Portofolio</span>
                </a>
                <a href="{{ route('admin.certifications.index') }}" class="nav-item {{ request()->routeIs('admin.certifications.*') ? 'active' : '' }}">
                    <i class="fas fa-certificate"></i>
                    <span>Sertifikat</span>
                </a>
                <a href="{{ route('admin.achievements.index') }}" class="nav-item {{ request()->routeIs('admin.achievements.*') ? 'active' : '' }}">
                    <i class="fas fa-trophy"></i>
                    <span>Prestasi</span>
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="nav-item {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                    <i class="fas fa-images"></i>
                    <span>Galeri</span>
                </a>
                <a href="{{ route('admin.music.index') }}" class="nav-item {{ request()->routeIs('admin.music.*') ? 'active' : '' }}">
                    <i class="fas fa-music"></i>
                    <span>Music Player</span>
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="nav-item {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <i class="fas fa-address-book"></i>
                    <span>Kontak</span>
                </a>
                <a href="{{ route('admin.comments.index') }}" class="nav-item {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                    <i class="fas fa-comments"></i>
                    <span>Komentar</span>
                </a>
                <a href="{{ route('admin.settings.index') }}" class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <a href="{{ route('home') }}" target="_blank" class="sidebar-link-out">
                    <i class="fas fa-external-link-alt"></i> Lihat Website
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="sidebar-logout" style="border: none; background: none; width: 100%; text-align: left; cursor: pointer;">
                        <i class="fas fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            </div>
        </aside>
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <div class="admin-main">
            <header class="admin-topbar">
                <button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Buka menu">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="topbar-title">
                    <h1>@yield('title', 'Dashboard')</h1>
                    <p>Selamat datang, <strong>{{ Auth::guard('admin')->user()->username }}</strong></p>
                </div>
            </header>

            <main class="admin-content">
                @if (session('success'))
                    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
