@extends('layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/laporan/laporan.kondisi.create.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="header">
        <h3><i class="fas fa-exclamation-triangle"></i> Tambah Laporan Kondisi</h3>
    </div>

    <form class="edit-form" method="POST" action="{{ route('laporan.kondisi.store') }}">
        @csrf

        <div class="form-group">
            <label> Waktu </label>
            <input type="datetime-local" name="waktu" required>
        </div>

        <div class="form-group">
            <label> Area </label>
            <div class="area-grid">
                <div class="select-wrapper">
                    <select name="area[]" required class="form-control">
                        <option value="" disabled selected>-- Titik Awal --</option>
                        @foreach($rutes as $rute)
                            <option value="{{ $rute->nama_tempat }}">{{ $rute->nama_tempat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="select-wrapper">
                    <select name="area[]" required class="form-control">
                        <option value="" disabled selected>-- Titik Akhir --</option>
                        @foreach($rutes as $rute)
                            <option value="{{ $rute->nama_tempat }}">{{ $rute->nama_tempat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <small class="helper-text">*Laporan mencakup kondisi di antara dua titik rute ini.</small>
        </div>

        <div class="form-group">
            <label> Informasi </label>
            <input type="text" name="informasi" placeholder="masukkan informasi...." required>
        </div>

        <div class="form-group">
            <label> Keterangan </label>
            <textarea name="keterangan" rows="5" placeholder="masukkan keterangan...."></textarea>
        </div>

        <div class="edit-footer">
            <a href="{{ route('laporan.kondisi.index') }}" class="btn-cancel-page">
                Batal
            </a>
            <button type="submit" class="btn-save-page">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection