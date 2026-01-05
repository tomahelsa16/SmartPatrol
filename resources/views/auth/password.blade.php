<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Smart Patrol</title>
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
</head>
<body>
    <div class="reset-container">
        <form id="resetForm" class="reset-form" action="{{ route('password.email') }}" method="POST">
            @csrf
            <h2>Lupa Password?</h2>
            <p class="tagline">Masukkan email untuk mengatur ulang password Anda.</p>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email" required>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-submit">Kirim Tautan Reset</button>

            <!-- Link ke halaman Login -->
            <div class="links">
                <a href="{{ route('login') }}">Kembali ke Login</a>
            </div>
        </form>
    </div>
</body>
</html>
