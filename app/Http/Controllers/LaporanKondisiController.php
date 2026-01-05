<?php

namespace App\Http\Controllers;

use App\Models\LaporanKondisi;
use App\Models\Rute; // Tambahkan ini
use Illuminate\Http\Request;

class LaporanKondisiController extends Controller
{
    public function index()
    {
        // Ambil data terbaru berdasarkan waktu
        $data = LaporanKondisi::orderBy('waktu', 'desc')->get();
        // Ambil data rute untuk modal edit
        $rutes = Rute::all();
        return view('laporan.kondisi.index', compact('data', 'rutes'));
    }

    public function create()
    {
        // Kirim data rute ke halaman create
        $rutes = Rute::all();
        return view('laporan.kondisi.create', compact('rutes'));
    }

    public function store(Request $request)
    {
        // Validasi: Area harus berupa array dan berisi tepat 2 titik
        $request->validate([
            'waktu' => 'required',
            'area' => 'required|array|size:2', 
            'informasi' => 'required',
        ]);

        // Gabungkan 2 titik rute menjadi satu string (misal: "Lobby - Parkir")
        $input = $request->all();
        $input['area'] = implode(' - ', $request->area);

        LaporanKondisi::create($input);
        return redirect()->route('laporan.kondisi.index');
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        // Jika area dikirim sebagai array, gabungkan kembali
        if(is_array($request->area)){
            $input['area'] = implode(' - ', $request->area);
        }

        LaporanKondisi::find($id)->update($input);
        return back();
    }

    public function destroy($id)
    {
        LaporanKondisi::destroy($id);
        return back();
    }
}