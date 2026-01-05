@extends('layouts.layout')

@section('title', 'Daftar Robot')
@section('header-title', 'Daftar Robot')

@section('styles')
    {{-- Menggunakan CSS yang sama agar tampilan modal konsisten --}}
    <link rel="stylesheet" href="{{ asset('css/tambah/robot.css') }}">
@endsection

@section('content')

<div class="robot-container">

    {{-- HEADER --}}
    <div class="header">
        <h3><i class="fas fa-robot"></i> Daftar Robot</h3>

        {{-- Tombol Tambah --}}
        <a href="{{ route('robot.create') }}" class="btn-add">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    {{-- TABLE --}}
    <table class="robot-table">
        <thead>
            <tr>
                <th>ID Robot</th>
                <th>Fitur</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($robots as $r)
            <tr>
                <td>{{ $r->robot_id }}</td>

                <td>
                    @foreach ($r->features as $f)
                        <span class="badge badge-info">
                            {{ strtoupper(str_replace('_', ' ', $f)) }}
                        </span><br>
                    @endforeach
                </td>

                <td class="action-column">
                    {{-- DETAIL (belum dibuat → disabled) --}}
                    <button class="btn-detail" disabled>
                        <i class="fas fa-eye"></i> Detail
                    </button>

                    {{-- Hapus Popup --}}
                    <button class="btn-delete" 
                        onclick="openDeleteModal('{{ $r->id }}')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


{{-- ================================================= --}}
{{-- ================ POPUP DELETE MODAL ============== --}}
{{-- ================================================= --}}
<div class="modal-backdrop" id="deleteModal">
    <div class="delete-box">

        <div class="delete-header">
            <span>Hapus Robot?</span>
            <span class="delete-close" onclick="closeDeleteModal()">&times;</span>
        </div>

        <p class="delete-text">Data robot ini tidak bisa dikembalikan setelah dihapus.</p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit" class="delete-btn">
                <i class="fas fa-trash"></i> Hapus
            </button>
        </form>

    </div>
</div>

@endsection

@section('scripts')
<script>
    /* Menampilkan Modal */
    function openDeleteModal(id) {
        // Tampilkan backdrop dengan flex agar box berada di tengah
        document.getElementById('deleteModal').style.display = 'flex';
        // Atur URL hapus secara dinamis
        document.getElementById('deleteForm').action = `/robot/${id}/delete`;
    }

    /* Menutup Modal */
    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    /* Menutup modal jika area luar kotak diklik */
    window.onclick = function(event) {
        let modal = document.getElementById('deleteModal');
        if (event.target === modal) {
            closeDeleteModal();
        }
    }
</script>
@endsection