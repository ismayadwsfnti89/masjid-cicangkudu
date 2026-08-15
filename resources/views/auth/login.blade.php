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

    <!-- CSS -->
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
            <div class="login-heading text-center">

                <h1>
                    Masjid Jami Cicangkudu
                </h1>

                <p class="subtitle">
                    Sistem Digital Masjid
                </p>

                <p class="login-description">
                    Silakan masuk untuk mengakses layanan warga.
                </p>

            </div>


            <!-- Success -->
            @if(session('success'))

                <div class="alert alert-success login-alert">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            <!-- Error -->
            @if($errors->any())

                <div class="alert alert-danger login-alert">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <span>
                        {{ $errors->first() }}
                    </span>

                </div>

            @endif


            <!-- FORM -->
            <form action="{{ route('login.submit') }}" method="POST">

                @csrf


                <!-- USERNAME -->
                <div class="form-group">

                    <label for="username">
                        Username
                    </label>

                    <div class="input-box">

                        <i class="fa-solid fa-user input-icon"></i>

                        <input
                            type="text"
                            name="username"
                            id="username"
                            class="form-control"
                            placeholder="Masukkan username"
                            value="{{ old('username') }}"
                            autocomplete="username"
                            required>

                    </div>

                </div>


                <!-- PASSWORD -->
                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <div class="input-box">

                        <i class="fa-solid fa-lock input-icon"></i>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control password-input"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required>

                        <button
                            type="button"
                            class="password-toggle"
                            id="togglePassword"
                            aria-label="Tampilkan password">

                            <i
                                class="fa-solid fa-eye"
                                id="eyeIcon">
                            </i>

                        </button>

                    </div>

                </div>


                <!-- LOGIN BUTTON -->
                <button
                    type="submit"
                    class="login-button">

                    <span>
                        <i class="fa-solid fa-right-to-bracket"></i>
                        Login
                    </span>

                    <i class="fa-solid fa-arrow-right login-arrow"></i>

                </button>

            </form>


            <!-- INFO -->
            <div class="login-info">

                <i class="fa-solid fa-circle-info"></i>

                <span>
                    Akun warga diberikan oleh pengurus masjid.
                </span>

            </div>


            <!-- FOOTER -->
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


    <!-- Password Toggle -->
    <script>

        const togglePassword =
            document.getElementById('togglePassword');

        const password =
            document.getElementById('password');

        const eyeIcon =
            document.getElementById('eyeIcon');


        togglePassword.addEventListener('click', function () {

            const isPassword =
                password.type === 'password';


            password.type =
                isPassword ? 'text' : 'password';


            eyeIcon.classList.toggle(
                'fa-eye',
                !isPassword
            );

            eyeIcon.classList.toggle(
                'fa-eye-slash',
                isPassword
            );

        });

    </script>

</body>

</html>