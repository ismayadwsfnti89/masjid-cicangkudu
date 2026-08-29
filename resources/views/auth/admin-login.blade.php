<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Masjid Jami Cicangkudu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main class="auth-page">
        <div class="auth-decoration auth-decoration-one"></div>
        <div class="auth-decoration auth-decoration-two"></div>

        <section class="auth-card">
            <div class="auth-brand">
                <span class="auth-mark"><i class="fa-solid fa-moon"></i></span>
                <span>
                    <strong>Admin Panel</strong>
                    <small>Masjid Jami Cicangkudu</small>
                </span>
            </div>

            <div class="auth-intro">
                <span class="auth-kicker">Khusus Pengelola</span>
                <h1>Login Administrator</h1>
                <p>Masuk menggunakan email dan password admin Anda.</p>
            </div>

            @if(session('success'))
                <div class="auth-alert success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="auth-alert danger">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="auth-form">
                @csrf

                <label for="email">Email Admin</label>
                <div class="auth-input">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="Masukkan email admin" value="{{ old('email') }}" autocomplete="email" required>
                </div>

                <label for="password">Password</label>
                <div class="auth-input">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Masukkan password" autocomplete="current-password" required>
                    <button type="button" id="togglePassword" aria-label="Tampilkan password">
                        <i class="fa-solid fa-eye" id="eyeIcon"></i>
                    </button>
                </div>

                <button type="submit" class="auth-submit">
                    <span>
                        <i class="fa-solid fa-right-to-bracket"></i> Masuk ke Dashboard Admin
                    </span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>

            <div class="auth-note">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Halaman ini dibatasi khusus untuk pengurus masjid.</span>
            </div>

            <p class="auth-footer">
                <i class="fa-solid fa-mosque"></i> Masjid Jami Cicangkudu
            </p>
        </section>
    </main>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (togglePassword) {
            togglePassword.addEventListener('click', function () {
                const showPassword = password.type === 'password';
                password.type = showPassword ? 'text' : 'password';
                eyeIcon.classList.toggle('fa-eye', !showPassword);
                eyeIcon.classList.toggle('fa-eye-slash', showPassword);
            });
        }
    </script>
</body>
</html>