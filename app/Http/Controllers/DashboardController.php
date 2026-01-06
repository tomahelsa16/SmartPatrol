<?php

namespace App\Http\Controllers;

use App\Models\Penugasan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil semua data penugasan untuk ditampilkan di tabel
        $allPenugasan = Penugasan::with(['robot', 'rutes'])
            ->orderBy('waktu_operasional', 'desc')
            ->get();

        // Hitung statistik khusus untuk robot yang sedang aktif (Berlangsung)
        $totalAktif = $allPenugasan->where('status', 'Berlangsung')->count();

        return view('dashboard.index', [
            'robotAktif' => $allPenugasan, // Variabel tetap bernama robotAktif agar tidak banyak ubah Blade
            'totalAktif' => $totalAktif
        ]);
    }
}