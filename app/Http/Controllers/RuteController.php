<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rute;

class RuteController extends Controller
{
    // INDEX
    public function index()
    {
        $rutes = Rute::all();
        return view('tambah.rute.index', compact('rutes'));
    }

    // FORM CREATE HALAMAN
    public function create()
    {
        return view('tambah.rute.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'nama_tempat' => 'required',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
        ]);

        Rute::create([
            'nama_tempat' => $request->nama_tempat,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'koordinat'   => $request->latitude . ', ' . $request->longitude,
        ]);

        return redirect()->route('rute.index')->with('success', 'Rute berhasil ditambahkan!');
    }

    // EDIT – JSON untuk modal
    public function edit($id)
    {
        $rute = Rute::findOrFail($id);
        return response()->json($rute);
    }

    // UPDATE – POST
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tempat' => 'required',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
        ]);

        $rute = Rute::findOrFail($id);

        $rute->update([
            'nama_tempat' => $request->nama_tempat,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'koordinat'   => $request->latitude . ', ' . $request->longitude,
        ]);

        return redirect()->route('rute.index')->with('success', 'Rute berhasil diperbarui!');
    }

    // DETAIL – JSON
    public function show($id)
    {
        return response()->json(Rute::findOrFail($id));
    }

    // DELETE
    public function destroy($id)
    {
        Rute::findOrFail($id)->delete();
        return redirect()->route('rute.index')->with('success', 'Rute dihapus.');
    }
}
