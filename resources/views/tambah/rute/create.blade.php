@extends('layouts.layout')

@section('title', 'Tambah Rute')
@section('header-title', 'Tambah Rute')

@section('styles')
    <link href="{{ asset('css/tambah/rute.create.css') }}" rel="stylesheet">

    {{-- Leaflet MAP CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endsection

@section('content')

    <div class="container">

        <div class="header">
            <h3><i class="fas fa-route"></i> Tambah Rute</h3>
        </div>

        <form action="{{ route('rute.store') }}" method="POST" class="edit-form">
            @csrf

            {{-- Nama Tempat --}}
            <div class="form-group">
                <label>Nama Tempat</label>
                <input type="text" name="nama_tempat" required>
            </div>

            <div class="coord-row">
                <div class="form-group">
                    <label>Latitude</label>
                    <input type="text" name="latitude" id="create_latitude" required>
                </div>

                <div class="form-group">
                    <label>Longitude</label>
                    <input type="text" name="longitude" id="create_longitude" required>
                </div>
            </div>


            {{-- SEARCH --}}
            <input type="text" id="create_search" class="map-search-box" placeholder="Cari lokasi...">

            {{-- MAP --}}
            <div class="form-group">
                <label>Pilih Titik pada Peta</label>
                <div id="create_map" style="height: 300px; border-radius: 8px;"></div>
                <small>Klik pada peta untuk mengisi latitude & longitude</small>
            </div>

            {{-- Tombol Autofill GPS --}}
            <button type="button" class="btn-save" onclick="getLocation('create_latitude','create_longitude')">
                Gunakan Lokasi Saat Ini
            </button>

            <div class="edit-footer">
                <a href="{{ route('rute.index') }}" class="btn-cancel-page">Batal</a>
                <button type="submit" class="btn-save-page">Simpan</button>
            </div>

        </form>

    </div>

@endsection

@section('scripts')

    {{-- Leaflet MAP JS --}}
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script src="{{ asset('js/rute.js') }}"></script>

@endsection
