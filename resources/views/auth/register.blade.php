<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | Masjid Jami Cicangkudu</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <!-- CSS Custom -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <main class="login-page">

        <div class="login-card">

            <!-- Logo -->
            <div class="logo-wrapper">
                <div class="logo">
                    <i class="fa-solid fa-mosque"></i>
                </div>
            </div>

            <!-- Judul -->
            <div class="text-center">

                <h1>
                    Buat Akun
                </h1>

                <p class="subtitle">
                    Masjid Jami Cicangkudu
                </p>

            </div>

            <!-- Form Register -->
            <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <!-- Input Nama -->
        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <div class="input-box">
                <i class="fa-solid fa-user"></i>
                <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" required>
            </div>
        </div>

        <!-- Input Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-box">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Masukkan email" required>
            </div>
        </div>

        <!-- Input Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-box">
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Buat password" required>
            </div>
        </div>

            <!-- Konfirmasi Password -->
            <div class="form-group">
                <label for="confirmPassword">Konfirmasi Password</label>
                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Ulangi password" required>
                </div>
            </div>

            <!-- Tombol Daftar (yang Anda tanyakan) -->
            <button type="submit" class="login-button">
                <i class="fa-solid fa-user-plus"></i>
                Daftar
            </button>
        </form>


            <!-- Kembali Login -->
            <div class="register-section">

                <span>
                    Sudah punya akun?
                </span>

                <a href="{{ route('login') }}">
                    Login sekarang
                </a>

            </div>


            <!-- Footer -->
            <div class="footer">

                <i class="fa-solid fa-mosque"></i>

                <span>
                    Masjid Jami Cicangkudu
                </span>

            </div>

        </div>

    </main>


    <!-- Bootstrap JS -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>