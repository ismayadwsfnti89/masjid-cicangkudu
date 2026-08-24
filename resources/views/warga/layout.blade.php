<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Warga | Masjid Jami Cicangkudu')</title>
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
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <span class="brand-mark"><i class="fa-solid fa-moon"></i></span>
                <span class="brand-copy"><strong>Masjid Jami</strong><small>Cicangkudu</small></span>
            </a>
            <div class="nav-label">Menu utama</div>
            <nav class="sidebar-menu" aria-label="Navigasi utama">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fa-solid fa-house"></i><span>Dashboard</span></a>
                <a href="{{ route('jadwal') }}" class="{{ request()->routeIs('jadwal') ? 'active' : '' }}"><i class="fa-solid fa-clock"></i><span>Jadwal Salat</span></a>
                <a href="{{ route('kegiatan') }}" class="{{ request()->routeIs('kegiatan') ? 'active' : '' }}"><i class="fa-solid fa-calendar-days"></i><span>Kegiatan</span></a>
                <a href="{{ route('donasi') }}" class="{{ request()->routeIs('donasi') ? 'active' : '' }}"><i class="fa-solid fa-hand-holding-heart"></i><span>Donasi</span></a>
                <a href="{{ route('laporan') }}" class="{{ request()->routeIs('laporan') ? 'active' : '' }}"><i class="fa-solid fa-chart-column"></i><span>Laporan</span></a>
                <a href="{{ route('informasi') }}" class="{{ request()->routeIs('informasi') ? 'active' : '' }}"><i class="fa-solid fa-mosque"></i><span>Informasi Masjid</span></a>
                <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}"><i class="fa-solid fa-user"></i><span>Profil Warga</span></a>
                <form action="{{ route('logout') }}" method="POST" class="logout-form">@csrf<button type="submit"><i class="fa-solid fa-right-from-bracket"></i><span>Logout</span></button></form>
            </nav>
            <div class="sidebar-account"><small>Akun warga</small><div class="account-row"><span class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'W', 0, 2)) }}</span><span><strong>{{ auth()->user()->name ?? 'Warga' }}</strong><small>Warga aktif</small></span></div></div>
        </aside>
        <main class="main-content">
            <header class="topbar">
                <div><div class="topbar-eyebrow">{{ now()->translatedFormat('l, d F Y') }}</div><div class="topbar-title">@yield('header', 'Dashboard warga')</div></div>
                <div class="topbar-user"><button class="notification-btn" type="button" onclick="showToast('Belum ada notifikasi baru')"><i class="fa-regular fa-bell"></i><span></span></button><span class="user-chip">{{ strtoupper(substr(auth()->user()->name ?? 'W', 0, 2)) }}</span><strong>{{ auth()->user()->name ?? 'Warga' }}</strong></div>
            </header>
            <section class="page-content">@yield('content')</section>
            <footer class="dashboard-footer">© {{ date('Y') }} Masjid Jami Cicangkudu</footer>
        </main>
    </div>
    <div id="toast" class="toast" role="status"></div>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>function showToast(message){const t=document.getElementById('toast');if(!t)return;t.textContent=message;t.classList.add('show');clearTimeout(window.toastTimer);window.toastTimer=setTimeout(()=>t.classList.remove('show'),2400)}</script>
    @stack('scripts')
</body>
</html>
