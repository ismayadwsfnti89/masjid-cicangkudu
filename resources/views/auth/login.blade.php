<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Masjid Jami Cicangkudu</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <!-- CSS Custom -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <!-- =========================
         LOGIN PAGE
    ========================= -->
    <main class="login-page">

        <div class="login-card">

            <!-- Logo Masjid -->
            <div class="logo-wrapper">
                <div class="logo">
                    <i class="fa-solid fa-mosque"></i>
                </div>
            </div>

            <!-- Judul -->
            <div class="text-center">
                <h1>Masjid Jami Cicangkudu</h1>

                <p class="subtitle">
                    Sistem Digital Masjid
                </p>
            </div>

            <!-- Form Login -->
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="form-group">

                    <label for="email">
                        Email
                    </label>

                    <div class="input-box">

                        <i class="fa-solid fa-envelope"></i>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Masukkan email"
                            autocomplete="email"
                            required>

                    </div>

                    <small class="error-message" id="emailError"></small>

                </div>


                <!-- Password -->
                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <div class="input-box">

                        <i class="fa-solid fa-lock"></i>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required>

                        <!-- Tombol lihat password -->
                        <button
                            type="button"
                            class="password-toggle"
                            id="togglePassword"
                            aria-label="Tampilkan password">

                            <i class="fa-solid fa-eye" id="eyeIcon"></i>

                        </button>

                    </div>

                    <small class="error-message" id="passwordError"></small>

                </div>


                <!-- Lupa Password -->
                <div class="forgot-password">

                    <a href="#">
                        Lupa password?
                    </a>

                </div>


                <!-- Tombol Login -->
                <button
                    type="submit"
                    class="login-button">

                    <i class="fa-solid fa-right-to-bracket"></i>

                    Login

                </button>

            </form>


            <!-- Register -->
            <div class="register-section">

                <span>
                    Belum punya akun?
                </span>

                <a href="{{ route('register') }}">
                    Daftar sekarang
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

    <!-- JavaScript Custom -->
    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>