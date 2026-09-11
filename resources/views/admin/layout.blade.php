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
                <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*', 'admin.import-warga*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i><span>Kelola Data Warga</span>
                </a>
                <a href="{{ route('admin.admins') }}" class="{{ request()->routeIs('admin.admins*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-shield"></i><span>Kelola Admin</span>
                </a>
                <a href="{{ route('admin.families.index') }}" class="{{ request()->routeIs('admin.families.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-people-roof"></i><span>Kelola Data KK</span>
                </a>
                <a href="{{ route('admin.jadwal') }}" class="{{ request()->routeIs('admin.jadwal') ? 'active' : '' }}">
                    <i class="fa-solid fa-clock"></i><span>Kelola Jadwal Salat</span>
                </a>
                <a href="{{ route('admin.contents.index', 'donasi') }}" class="{{ request()->is('admin/donasi*') ? 'active' : '' }}">
                    <i class="fa-solid fa-hand-holding-heart"></i><span>Kelola Program Donasi</span>
                </a>
                <a href="{{ route('admin.contents.index', 'laporan-keuangan') }}" class="{{ request()->is('admin/laporan-keuangan*') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-invoice-dollar"></i><span>Catat Transaksi</span>
                </a>
                <a href="{{ route('admin.kas-kk.index') }}" class="{{ request()->routeIs('admin.kas-kk.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-wallet"></i><span>Kelola Kas KK</span>
                </a>
                <a href="{{ route('admin.contents.index', 'informasi-masjid') }}" class="{{ request()->is('admin/informasi-masjid*') ? 'active' : '' }}">
                    <i class="fa-solid fa-mosque"></i><span>Kelola Informasi & Kegiatan</span>
                </a>
                
                <form action="{{ route('logout') }}" method="POST" class="d-inline mt-3" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari sistem?');">
                    @csrf
                    <button type="submit" class="btn btn-link text-danger text-decoration-none p-0 w-100 text-start px-3 py-2">
                        <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar / Logout
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
                    <div class="topbar-eyebrow">{{ now()->translatedFormat('l, d F Y') }} · <span id="currentClock">{{ now()->format('H:i') }}</span> WIB</div>
                    <div class="topbar-title">@yield('header', 'Dashboard admin')</div>
                </div>
                <div class="topbar-user">
                    <a href="{{ route('admin.notifications') }}" class="notification-btn text-decoration-none" title="Buka notifikasi">
                        <i class="fa-regular fa-bell"></i>@if(auth()->user()->unreadNotifications()->count())<span>{{ auth()->user()->unreadNotifications()->count() }}</span>@endif
                    </a>
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
        function updateClock() {
            const clock = document.getElementById('currentClock');
            if (clock) clock.textContent = new Intl.DateTimeFormat('id-ID', {timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', hour12: false}).format(new Date());
        }
        updateClock();
        setInterval(updateClock, 1000);
    </script>
    @stack('scripts')
</body>
</html>
