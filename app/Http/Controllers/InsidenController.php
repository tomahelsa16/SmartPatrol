<?php

namespace App\Http\Controllers;

use App\Models\Insiden;
use App\Models\Rute; // Pastikan Model Rute di-import untuk dropdown area
use Illuminate\Http\Request;

class InsidenController extends Controller
{
    /**
     * Menampilkan daftar laporan insiden
     */
    public function index()
    {
        // Mengambil data rute juga untuk dikirim ke modal edit di view
        $rutes = Rute::all();
        $dataInsiden = Insiden::orderBy('waktu', 'DESC')->get();
        
        return view('laporan.insiden.index', compact('dataInsiden', 'rutes'));
    }

    /**
     * Menampilkan form tambah laporan
     */
    public function create()
    {
        // Mengambil data rute untuk dropdown area (Titik A & Titik B)
        $rutes = Rute::all();
        return view('laporan.insiden.create', compact('rutes'));
    }

    /**
     * Menyimpan data laporan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'waktu' => 'required',
            'area' => 'required|array|min:2', // Validasi harus berupa array (2 titik)
            'informasi' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        // Menggabungkan array area ['Lobby', 'Parkir'] menjadi string "Lobby - Parkir"
        $areaFormatted = implode(' - ', $request->area);

        Insiden::create([
            'waktu' => $request->waktu,
            'area' => $areaFormatted,
            'informasi' => $request->informasi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('insiden.index')->with('success', 'Laporan insiden berhasil ditambahkan');
    }

    /**
     * Memperbarui data laporan (melalui Modal)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'waktu' => 'required',
            'area' => 'required|array|min:2',
            'informasi' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        $insiden = Insiden::findOrFail($id);

        // Menggabungkan kembali array area menjadi string
        $areaFormatted = implode(' - ', $request->area);

        $insiden->update([
            'waktu' => $request->waktu,
            'area' => $areaFormatted,
            'informasi' => $request->informasi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('insiden.index')->with('success', 'Laporan insiden berhasil diperbarui');
    }

    /**
     * Menghapus data laporan
     */
    public function destroy($id)
    {
        $insiden = Insiden::findOrFail($id);
        $insiden->delete();

        return redirect()->route('insiden.index')->with('success', 'Laporan insiden berhasil dihapus');
    }
}