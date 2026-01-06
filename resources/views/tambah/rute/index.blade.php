@extends('layouts.layout')

@section('title', 'Daftar Rute')
@section('header-title', 'Daftar Rute')

@section('styles')
    <link href="{{ asset('css/tambah/rute.css') }}" rel="stylesheet">

    {{-- Leaflet MAP CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endsection

@section('content')

    <div class="container">

        {{-- HEADER --}}
        <div class="header">
            <h3><i class="fas fa-route"></i> Daftar Rute</h3>
            <a href="{{ route('rute.create') }}" class="btn-add"><i class="fas fa-plus"></i></a>
        </div>

        {{-- TABLE --}}
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tempat</th>
                    <th>Titik Koordinat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @php $no = 1; @endphp
                @foreach ($rutes as $r)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $r->nama_tempat }}</td>
                        <td>{{ $r->latitude }}, {{ $r->longitude }}</td>

                        <td class="aksi-column">

                            {{-- DETAIL --}}
                            <button class="btn-detail" onclick="openDetailModal({{ $r->id }})">
                                <i class="fas fa-eye"></i> Detail
                            </button>

                            {{-- EDIT --}}
                            <button class="btn-edit" onclick="openEditModal({{ $r->id }})">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            {{-- DELETE --}}
                            <button class="btn-delete" onclick="openDeleteModal('{{ $r->id }}')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>

                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>


    {{-- ========================================================= --}}
    {{-- =============== MODAL DETAIL ============================ --}}
    {{-- ========================================================= --}}
    <div id="detailModal" class="modal">
        <div class="modal-content modal-box">

            <div class="modal-header">
                <h3>Detail Rute</h3>
                <span class="close" onclick="closeDetail()">&times;</span>
            </div>

            <div class="form-group">
                <label>Nama Tempat</label>
                <input id="detail_nama" readonly>
            </div>

            <div class="form-group">
                <label>Koordinat</label>
                <input id="detail_koordinat" readonly>
            </div>

            {{-- MAP VIEW --}}
            <div class="form-group">
                <label>Peta Lokasi</label>
                <div id="detail_map" style="height:250px; border-radius:8px;"></div>
            </div>

        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- =============== MODAL EDIT ============================== --}}
    {{-- ========================================================= --}}
    <div id="editModal" class="modal">
        <div class="modal-content modal-box">

            <div class="modal-header">
                <h3>Edit Rute</h3>
                <span class="close" onclick="closeEdit()">&times;</span>
            </div>

            <form id="editForm" method="POST">
                @csrf

                {{-- Nama tempat --}}
                <div class="form-group">
                    <label>Nama Tempat</label>
                    <input id="edit_nama" name="nama_tempat" required>
                </div>

                <div class="edit-modal-row">
                    <div class="form-group">
                        <label>Latitude</label>
                        <input id="edit_latitude" name="latitude" required>
                    </div>

                    <div class="form-group">
                        <label>Longitude</label>
                        <input id="edit_longitude" name="longitude" required>
                    </div>
                </div>


                {{-- SEARCH --}}
                <input type="text" id="edit_search" class="map-search-box" placeholder="Cari lokasi...">

                {{-- MAP EDIT --}}
                <div class="form-group">
                    <label>Atur Lokasi Pada Peta</label>
                    <div id="edit_map" style="height:250px; border-radius:8px; margin-bottom:10px;"></div>
                    <small>Klik pada peta untuk mengisi Latitude & Longitude</small>
                </div>

                {{-- Tombol autofill GPS --}}
                <button type="button" class="btn-save" onclick="getLocation('edit_latitude','edit_longitude')">
                    Gunakan Lokasi Saat Ini
                </button>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeEdit()">Batal</button>
                    <button type="submit" class="btn-save">Simpan</button>
                </div>

            </form>

        </div>
    </div>

    <div class="modal-backdrop" id="deleteModal">
        <div class="delete-box">
            <div class="delete-header">
                <span>Hapus Data Rute?</span>
                <span class="delete-close" onclick="closeDeleteModal()">&times;</span>
            </div>
            <p class="delete-text">Data rute ini tidak bisa dipulihkan setelah dihapus.</p>
            <form id="deleteForm" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="delete-btn">Hapus</button>
            </form>
        </div>
    </div>
@endsection


@section('scripts')

    {{-- Leaflet MAP JS --}}
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script src="{{ asset('js/rute.js') }}"></script>

@endsection
