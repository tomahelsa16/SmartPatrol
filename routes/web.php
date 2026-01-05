<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RobotController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\InsidenController;
use App\Http\Controllers\LaporanKondisiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/* ================================
   GUEST (BELUM LOGIN)
================================ */
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.submit');
    Route::get('password/reset', [AuthController::class, 'showResetForm'])->name('password.request');
    Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');
});

/* ================================
   AUTH (HARUS LOGIN)
================================ */
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function () {return view('dashboard.index');})->name('dashboard');

    /* ------------------------------
       MENU UTAMA
    ------------------------------ */
    Route::get('/tambah', fn() => view('tambah.index'))->name('tambah');
    Route::get('/laporan', fn() => view('laporan.index'))->name('laporan');
});

/* ================================
   ROOT DEFAULT
================================ */
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

/* ================================
   DATA ROBOT
================================ */
Route::get('/tambah/robot', [RobotController::class, 'index'])->name('tambah_robot');
Route::get('/tambah/robot/create', fn() => view('tambah.robot.create'))->name('robot.create');
Route::post('/robot/store', [RobotController::class, 'store'])->name('robot.store');
Route::get('/robot/{id}/detail', [RobotController::class, 'detail'])->name('robot.detail');
Route::delete('/robot/{id}/delete', [RobotController::class, 'destroy'])->name('robot.delete');

/* ================================
   DATA RUTE
================================ */
Route::get('/tambah/rute', [RuteController::class, 'index'])->name('rute.index');
Route::get('/tambah/rute/create', [RuteController::class, 'create'])->name('rute.create');
Route::post('/tambah/rute/store', [RuteController::class, 'store'])->name('rute.store');
Route::get('/tambah/rute/{id}/detail', [RuteController::class, 'show'])->name('rute.show');
Route::get('/tambah/rute/{id}/edit', [RuteController::class, 'edit'])->name('rute.edit');
Route::post('/tambah/rute/{id}/update', [RuteController::class, 'update'])->name('rute.update');
Route::delete('/tambah/rute/{id}/delete', [RuteController::class, 'destroy'])->name('rute.delete');

/* ================================
   PENUGASAN ROBOT
================================ */
Route::get('/penugasan', [PenugasanController::class, 'index'])->name('penugasan');
Route::get('/penugasan/tambah', [PenugasanController::class, 'create'])->name('tambah_penugasan');
Route::post('/penugasan/simpan', [PenugasanController::class, 'store'])->name('penugasan.store');
Route::post('/penugasan/{id}/mulai', [PenugasanController::class, 'mulai'])->name('penugasan.mulai');
Route::post('/penugasan/{id}/batalkan', [PenugasanController::class, 'batalkan'])->name('penugasan.batalkan');
Route::post('/penugasan/{id}/selesai', [PenugasanController::class, 'selesai'])->name('penugasan.selesai');
Route::get('/penugasan/{id}/detail', [PenugasanController::class, 'detail'])->name('penugasan.detail');
Route::get('/penugasan/{id}/edit', [PenugasanController::class, 'edit'])->name('penugasan.edit');
Route::post('/penugasan/{id}/update', [PenugasanController::class, 'update'])->name('penugasan.update');
Route::delete('/penugasan/{id}/hapus', [PenugasanController::class, 'destroy'])->name('penugasan.hapus');


/* ================================
   LAPORAN → INSIDEN
================================ */
Route::prefix('laporan')->group(function () {
    Route::get('/insiden', [InsidenController::class, 'index'])->name('insiden.index');
    Route::get('/insiden/tambah', [InsidenController::class, 'create'])->name('insiden.create');
    Route::post('/insiden/simpan', [InsidenController::class, 'store'])->name('insiden.store');
    Route::put('/insiden/{id}/update', [InsidenController::class, 'update'])->name('insiden.update');
    Route::delete('/insiden/{id}/hapus', [InsidenController::class, 'destroy'])->name('insiden.destroy');
});

/* ================================
   LAPORAN → KONDISI
================================ */
Route::prefix('laporan/kondisi')->name('laporan.kondisi.')->group(function () {
    Route::get('/', [LaporanKondisiController::class, 'index'])->name('index');
    Route::get('/tambah', [LaporanKondisiController::class, 'create'])->name('create');
    Route::post('/store', [LaporanKondisiController::class, 'store'])->name('store');
    Route::put('/update/{id}', [LaporanKondisiController::class, 'update'])->name('update');
    Route::delete('/hapus/{id}', [LaporanKondisiController::class, 'destroy'])->name('hapus');
});
