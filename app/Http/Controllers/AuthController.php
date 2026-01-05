<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Halaman Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validasi input untuk email dan password
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
                'max:10',
                'regex:/[a-z]/', // Harus ada huruf kecil
                'regex:/[0-9]/',  // Harus ada angka
                'regex:/^[A-Za-z0-9]+$/', // Tidak boleh ada tanda baca atau karakter khusus
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard'); // Arahkan ke dashboard setelah login berhasil
        } else {
            return redirect()->back()->with('error', 'Email atau password salah');
        }
    }

    // Halaman Register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses Register
    public function register(Request $request)
    {
        // Validasi input untuk register
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'min:8',
                'max:10',
                'confirmed',
                'regex:/[a-z]/', // Harus ada huruf kecil
                'regex:/[0-9]/',  // Harus ada angka
                'regex:/^[A-Za-z0-9]+$/', // Tidak boleh ada tanda baca atau karakter khusus
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menciptakan user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Mengarahkan ke halaman login setelah berhasil mendaftar
        return redirect()->route('login')->with('status', 'Akun Anda berhasil dibuat. Silakan login.');
    }

    // Halaman Reset Password
    public function showResetForm()
    {
        return view('auth.password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $response = Password::sendResetLink($request->only('email'));

        return $response == Password::RESET_LINK_SENT
            ? back()->with('status', 'Tautan reset password telah dikirim ke email Anda.')
            : back()->withErrors(['email' => 'Email tidak ditemukan.']);
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
                'max:10',
                'confirmed',
                'regex:/[a-z]/', // Harus ada huruf kecil
                'regex:/[0-9]/',  // Harus ada angka
                'regex:/^[A-Za-z0-9]+$/', // Tidak boleh ada tanda baca atau karakter khusus
            ],
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $response = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });

        return $response == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'Password berhasil direset.')
            : back()->withErrors(['email' => 'Tautan reset tidak valid.']);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
