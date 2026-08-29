<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin | Masjid Jami Cicangkudu')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                <span class="brand-mark"><i class="fa-solid fa-moon"></i></span>
                <span class="brand-copy"><strong>Admin Masjid</strong><small>Cicangkudu</small></span>
            </a>
            <div class="nav-label">Menu Pengelola</div>
            <nav class="sidebar-menu" aria-label="Navigasi admin">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-pie"></i><span>Dashboard Admin</span>
                </a>
                <a href="{{ route('admin.jadwal') }}" class="{{ request()->routeIs('admin.jadwal') ? 'active' : '' }}">
                    <i class="fa-solid fa-clock"></i><span>Kelola Jadwal</span>
                </a>
                <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users', 'admin.users.edit') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i><span>Data Warga</span>
                </a>
                <a href="{{ route('admin.import-warga') }}" class="{{ request()->routeIs('admin.import-warga') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-excel"></i><span>Import Warga</span>
                </a>
                <a href="{{ route('admin.admins') }}" class="{{ request()->routeIs('admin.admins') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-shield"></i><span>Kelola Admin</span>
                </a>
                
                <form action="{{ route('logout') }}" method="POST" class="d-inline mt-3" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari sistem?');">
                    @csrf
                    <button type="submit" class="btn btn-link text-danger text-decoration-none p-0 w-100 text-start px-3 py-2">
                        <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar / Logout
                    </button>
                </form>
            </nav>
            
            <div class="sidebar-account">
                <small>Akun pengelola</small>
                <div class="account-row">
                    <span class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}</span>
                    <span><strong>{{ auth()->user()->name ?? 'Admin' }}</strong><small>Administrator</small></span>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <header class="topbar">
                <div>
                    <div class="topbar-eyebrow">{{ now()->translatedFormat('l, d F Y') }}</div>
                    <div class="topbar-title">@yield('header', 'Dashboard admin')</div>
                </div>
                <div class="topbar-user">
                    <button class="notification-btn" type="button" onclick="showToast('Belum ada notifikasi baru')">
                        <i class="fa-regular fa-bell"></i><span></span>
                    </button>
                    <span class="user-chip">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}</span>
                    <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                </div>
            </header>
            
            <section class="page-content">
                {{-- Notifikasi Global (Cukup di sini saja agar tidak dobel) --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert" style="border-radius: 1rem;">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert" style="border-radius: 1rem;">
                    <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @yield('content')
            </section>
            
            <footer class="dashboard-footer">© {{ date('Y') }} Masjid Jami Cicangkudu</footer>
        </main>
    </div>
    
    <div id="toast" class="toast" role="status"></div>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        function showToast(message){
            const t = document.getElementById('toast');
            if(!t) return;
            t.textContent = message;
            t.classList.add('show');
            clearTimeout(window.toastTimer);
            window.toastTimer = setTimeout(() => t.classList.remove('show'), 2400);
        }
    </script>
    @stack('scripts')
</body>
</html>