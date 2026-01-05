<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Sistem Smart Patrol</title>
    
    <!-- Google Fonts and Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <i class="fas fa-robot logo-icon"></i>
                <h3>SMART PATROL</h3>
            </div>
            
            <!-- Login Form -->
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email">ID Pengguna / Email</label>
                    <input type="text" id="email" name="email" placeholder="Masukkan ID atau Email Anda" required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi" required>

                    <!-- Menampilkan pesan error jika ada -->
                    @if ($errors->has('email') || $errors->has('password'))
                        <div class="error-message">
                            <p>Email atau Password tidak valid</p>
                        </div>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </button>
            </form>

            <div class="footer-links">
                <p class="footer-link">
                    Lupa Kata Sandi? <a href="#">Klik di sini.</a>
                </p>
                <p class="register-link">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar di sini.</a>
                </p>
            </div>
        </div>
    </div>

</body>

</html>
