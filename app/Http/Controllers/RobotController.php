<?php

namespace App\Http\Controllers;

use App\Models\Robot;
use Illuminate\Http\Request;

class RobotController extends Controller
{
    // =====================================================
    // HALAMAN DAFTAR ROBOT
    // =====================================================
    public function index()
    {
        $robots = Robot::all();
        return view('tambah.robot.index', compact('robots'));
    }

    // =====================================================
    // SIMPAN ROBOT BARU
    // =====================================================
    public function store(Request $request)
    {
        $categories = config('robot');

        $request->validate([
            'robot_id' => 'required|unique:robots,robot_id',
            'features' => 'required|array|min:3',
        ], [
            'features.min' => 'Robot harus memiliki minimal 3 fitur.',
        ]);

        $features = $request->features;
        $errors = [];

        // Validasi tiap kategori wajib 1 fitur
        if (!collect($features)->intersect($categories['navigasi'])->count()) {
            $errors[] = 'Navigasi wajib dipilih minimal 1 fitur.';
        }

        if (!collect($features)->intersect($categories['sensor_lingkungan'])->count()) {
            $errors[] = 'Sensor Lingkungan wajib dipilih minimal 1 fitur.';
        }

        if (!collect($features)->intersect($categories['sistem_kamera'])->count()) {
            $errors[] = 'Sistem Kamera wajib dipilih minimal 1 fitur.';
        }

        // Jika ada kategori yang tidak dipilih
        if (!empty($errors)) {
            return back()
                ->withErrors(['features' => implode(' ', $errors)])
                ->withInput();
        }

        // Simpan data robot
        Robot::create([
            'robot_id' => $request->robot_id,
            'features' => $features,
        ]);

        // ========================================
        // FIX: KEMBALI KE HALAMAN LIST ROBOT
        // ========================================
        return redirect()
            ->route('tambah_robot')
            ->with('success', 'Robot berhasil ditambahkan!');
    }

    // =====================================================
    // DETAIL ROBOT
    // =====================================================
    public function detail($id)
    {
        $robot = Robot::findOrFail($id);
        return view('robot.detail', compact('robot'));
    }

    // =====================================================
    // HAPUS ROBOT
    // =====================================================
    public function destroy($id)
    {
        Robot::findOrFail($id)->delete();

        return redirect()
            ->route('tambah_robot')
            ->with('success', 'Robot berhasil dihapus.');
    }
}
