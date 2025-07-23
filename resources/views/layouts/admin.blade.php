<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli - @yield('title', 'Yönetim')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; }
        .sidebar { min-height: 100vh; background: #212529; color: #fff; }
        .sidebar a { color: #adb5bd; text-decoration: none; }
        .sidebar a.active, .sidebar a:hover { color: #fff; background: #495057; border-radius: 4px; }
        .sidebar .nav-link { padding: 0.75rem 1rem; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar py-4">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('admin.profile.*')) active @endif" href="#">CV Yönetimi</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('admin.blog.*')) active @endif" href="#">Blog</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('admin.gallery.*')) active @endif" href="{{ route('admin.gallery.index') }}">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('admin.reference.*')) active @endif" href="{{ route('admin.reference.index') }}">Referanslar</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('admin.users.*')) active @endif" href="#">Kullanıcılar</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('admin.settings.*')) active @endif" href="#">Ayarlar</a></li>
                </ul>
                <!-- Türkçe yorum: Sidebar menü ve aktif link vurgusu -->
            </div>
        </nav>
        <main class="col-md-10 ms-sm-auto px-md-4 py-4">
            <nav class="navbar navbar-expand navbar-light bg-light rounded mb-4">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h6">@yield('title', 'Yönetim Paneli')</span>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name ?? 'Admin' }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="#">Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Çıkış</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                </div>
            </nav>
            <!-- Türkçe yorum: Header ve kullanıcı menüsü -->
            @yield('content')
            <footer class="mt-5 text-center text-muted small">&copy; {{ date('Y') }} Admin Paneli</footer>
            <!-- Türkçe yorum: Footer -->
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 