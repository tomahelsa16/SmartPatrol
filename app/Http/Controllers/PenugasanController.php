<?php

namespace App\Http\Controllers;

use App\Models\Penugasan;
use App\Models\Robot;
use App\Models\Rute;
use Illuminate\Http\Request;

class PenugasanController extends Controller
{
    /* ======================================================
       1. INDEX — Tampilkan daftar penugasan
    ======================================================= */
    public function index()
    {
        // Ambil penugasan + relasi robot dan SEMUA rute dinamis
        $penugasans = Penugasan::with(['robot', 'rutes'])
            ->orderBy('id', 'DESC')
            ->get();

        // Untuk modal edit (dropdown rute)
        $rutes = Rute::all();

        return view('penugasan.index', compact('penugasans', 'rutes'));
    }

    /* ======================================================
       2. CREATE — Form tambah penugasan
    ======================================================= */
    public function create()
    {
        $robots = Robot::all();
        $rutes  = Rute::all();

        return view('penugasan.form', compact('robots', 'rutes'));
    }

    /* ======================================================
       3. STORE — Simpan penugasan baru (rute dinamis)
    ======================================================= */
    public function store(Request $request)
    {
        $request->validate([
            'robot_id'          => 'required|exists:robots,id',
            'waktu_operasional' => 'required|date',
            'rute_ids'          => 'required|array|min:3', // Menangkap input rute_ids[]
        ]);

        // Buat header penugasan
        $penugasan = Penugasan::create([
            'robot_id'          => $request->robot_id,
            'waktu_operasional' => $request->waktu_operasional,
            'status'            => 'Menunggu',
        ]);

        // Simpan rute dinamis ke tabel pivot
        foreach ($request->rute_ids as $index => $ruteId) {
            $penugasan->rutes()->attach($ruteId, [
                'urutan' => $index + 1,
            ]);
        }

        return redirect()->route('penugasan')->with('success', 'Penugasan berhasil dibuat!');
    }

    /* ======================================================
       4. MULAI — Ubah status menjadi BERLANGSUNG
    ======================================================= */
    public function mulai($id)
    {
        $p = Penugasan::findOrFail($id);

        if ($p->status === 'Menunggu') {
            $p->status = 'Berlangsung';
            $p->save();
        }

        return redirect()->route('penugasan')->with('success', 'Penugasan berhasil dimulai.');
    }

    /* ======================================================
       5. BATALKAN — Ubah status menjadi DIBATALKAN
    ======================================================= */
    public function batalkan($id)
    {
        $p = Penugasan::findOrFail($id);

        if ($p->status !== 'Dibatalkan' && $p->status !== 'Selesai') {
            $p->status = 'Dibatalkan';
            $p->save();
        }

        return redirect()->route('penugasan')->with('success', 'Penugasan berhasil dibatalkan.');
    }

    /* ======================================================
       6. SELESAI — Ubah status menjadi SELESAI
    ======================================================= */
    public function selesai($id)
    {
        $p = Penugasan::findOrFail($id);

        if ($p->status === 'Berlangsung') {
            $p->status = 'Selesai';
            $p->save();
        }

        return redirect()->route('penugasan')->with('success', 'Penugasan ditandai selesai.');
    }

    /* ======================================================
       7. DETAIL — Tampilkan detail penugasan
    ======================================================= */
    public function detail($id)
    {
        $penugasan = Penugasan::with(['robot', 'rutes'])
            ->findOrFail($id);

        return view('penugasan.detail', compact('penugasan'));
    }

    /* ======================================================
       8. EDIT — (kalau mau pakai halaman terpisah)
    ======================================================= */
    public function edit($id)
    {
        $penugasan = Penugasan::with('rutes')->findOrFail($id);
        $robots    = Robot::all();
        $rutes     = Rute::all();

        return view('penugasan.edit', compact('penugasan', 'robots', 'rutes'));
    }

    /* ======================================================
       9. UPDATE — Simpan hasil edit (waktu + rute dinamis)
    ======================================================= */
    public function update(Request $request, $id)
    {
        $request->validate([
            'waktu_operasional' => 'required|date',
            'rute_ids'          => 'required|array|min:3',
            'rute_ids.*'        => 'required|exists:rutes,id',
        ]);

        $p = Penugasan::findOrFail($id);

        // Update header (robot_id tidak diubah di modal, jadi pakai yang lama)
        $p->update([
            'waktu_operasional' => $request->waktu_operasional,
        ]);

        // Ganti semua rute pada penugasan ini
        $p->rutes()->detach();

        foreach ($request->rute_ids as $index => $ruteId) {
            $p->rutes()->attach($ruteId, [
                'urutan' => $index + 1,
            ]);
        }

        return redirect()->route('penugasan')->with('success', 'Penugasan berhasil diperbarui.');
    }

    /* ======================================================
       10. HAPUS — Hapus penugasan
    ======================================================= */
    public function destroy($id)
    {
        $p = Penugasan::findOrFail($id);

        // Lepas rutenya dulu
        $p->rutes()->detach();

        $p->delete();

        return redirect()->route('penugasan')->with('success', 'Penugasan berhasil dihapus.');
    }
}
