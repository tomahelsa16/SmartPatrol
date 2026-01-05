<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Smart Patrol</title>
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
</head>

<body>
    <div class="register-container">
        <form id="registerForm" class="register-form" action="{{ route('register') }}" method="POST" onsubmit="return validatePassword()">
            @csrf
            <h2>Daftar Smart Patrol</h2>
            <p class="tagline">Bergabung dan kelola patroli dengan lebih mudah.</p>

            <!-- Name -->
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email" required>
                <!-- Pesan error email -->
                @if ($errors->has('email'))
                    <div class="error-message">
                        <p>Akun sudah terdaftar</p>
                    </div>
                @endif
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                <!-- Persyaratan Password -->
                <div class="password-requirements">
                    <ul>
                        <li>min 8/maks 10 karakter.</li>
                        <li>harus angka dan huruf kecil.</li>
                        <li>tidak boleh pakai karakter/tanda baca (# $ % &).</li>
                    </ul>
                </div>
                <!-- Pesan error password -->
                <div id="password-error" class="error-message" style="display: none;">
                    <p>Password tidak valid.</p>
                </div>
            </div>

            <!-- Password Confirmation -->
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password" required>
                <!-- Pesan error confirm password -->
                <div id="confirm-password-error" class="error-message" style="display: none;">
                    <p>Password dan konfirmasi password tidak cocok.</p>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-submit">Daftar</button>

            <!-- Link ke halaman Login -->
            <div class="links">
                Sudah punya akun? <a href="{{ route('login') }}"> Login</a>
            </div>
        </form>
    </div>

    <!-- Menghubungkan file JavaScript -->
    <script src="{{ asset('js/register.js') }}"></script>
</body>

</html>
