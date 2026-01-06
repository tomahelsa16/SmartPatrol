@extends('layouts.layout')

@section('title', 'Laporan Insiden')
@section('header-title', 'Laporan Insiden')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/laporan/laporan-insiden.css') }}">
@endsection

@section('content')
    <div class="container-laporan">
        <div class="header-laporan">
            <h3><i class="fas fa-exclamation-triangle"></i> Laporan Insiden</h3>
            <a href="{{ route('insiden.create') }}" class="btn-add"><i class="fas fa-plus"></i></a>
        </div>

        <table class="table-insiden">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Area</th>
                    <th>Informasi</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataInsiden as $insiden)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($insiden->waktu)->format('d-m-Y, H:i') }}</td>
                        <td>{{ $insiden->area }}</td>
                        <td>{{ $insiden->informasi }}</td>
                        <td>{{ $insiden->keterangan }}</td>
                        <td class="action-column">
                            <button class="btn-edit"
                                onclick="openEditModal('{{ $insiden->id }}', '{{ $insiden->waktu }}', '{{ $insiden->area }}', '{{ $insiden->informasi }}', `{{ $insiden->keterangan }}`)">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn-delete" onclick="openDeleteModal('{{ $insiden->id }}')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- MODAL EDIT --}}
    <div class="modal-backdrop" id="editModal">
        <div class="modal-box">
            <div class="modal-header">
                <span>Edit Laporan Insiden</span>
                <span style="cursor:pointer" onclick="closeEditModal()">&times;</span>
            </div>
            <form class="modal-form" id="editForm" method="POST">
                @csrf
                @method('PUT')
                
                <label>Waktu</label>
                <input type="datetime-local" id="edit_waktu" name="waktu" required>

                <label>Pilih Area</label>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                    <select name="area[]" id="edit_area_1" required>
                        @foreach ($rutes as $r)
                            <option value="{{ $r->nama_tempat }}">{{ $r->nama_tempat }}</option>
                        @endforeach
                    </select>
                    <select name="area[]" id="edit_area_2" required>
                        @foreach ($rutes as $r)
                            <option value="{{ $r->nama_tempat }}">{{ $r->nama_tempat }}</option>
                        @endforeach
                    </select>
                </div>

                <label>Informasi</label>
                <input type="text" id="edit_informasi" name="informasi" required>

                <label>Keterangan</label>
                <textarea name="keterangan" id="edit_keterangan" rows="3" required></textarea>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL DELETE --}}
    <div class="modal-backdrop" id="deleteModal">
        <div class="delete-box">
            <div class="delete-header">
                <span>Hapus Laporan Insiden?</span>
                <span style="cursor:pointer" onclick="closeDeleteModal()">&times;</span>
            </div>
            <p style="color: #666; font-size: 14px; margin-bottom: 20px;">Data ini tidak bisa dipulihkan setelah dihapus.</p>
            <form id="deleteForm" method="POST">
                @csrf 
                @method('DELETE')
                <button type="submit" class="delete-btn"> Hapus </button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openEditModal(id, waktu, area, informasi, keterangan) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            // Pastikan route update ini sesuai dengan route di web.php Anda
            form.action = `/laporan/insiden/${id}/update`;

            let formattedWaktu = waktu.replace(' ', 'T').substring(0, 16);
            document.getElementById('edit_waktu').value = formattedWaktu;
            document.getElementById('edit_informasi').value = informasi;
            document.getElementById('edit_keterangan').value = keterangan;

            // Memisahkan string "Area A - Area B" ke dua select ganda
            let areaParts = area.split(' - ');
            if (areaParts.length === 2) {
                document.getElementById('edit_area_1').value = areaParts[0];
                document.getElementById('edit_area_2').value = areaParts[1];
            }

            modal.style.display = 'flex';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function openDeleteModal(id) {
            const form = document.getElementById('deleteForm');
            form.action = `/laporan/insiden/${id}/hapus`;
            document.getElementById('deleteModal').style.display = 'flex';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal-backdrop')) {
                closeEditModal();
                closeDeleteModal();
            }
        }
    </script>
@endsection