@extends('layouts.layout')

@section('title', 'Penugasan')
@section('header-title', 'Manajemen Penugasan Robot Patroli')

@section('styles')
    <link href="{{ asset('css/penugasan/index.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="card robot-status-card">

    <div class="table-header">
        <h3><i class="fas fa-clipboard-list"></i> Jadwal Penugasan Robot</h3>
        <a href="{{ route('tambah_penugasan') }}" class="btn-add">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <div class="robot-table-container">
        <table class="robot-status-table">
            <thead>
                <tr>
                    <th>ID Robot</th>
                    <th>Waktu</th>
                    <th>Rute</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($penugasans as $p)
                <tr>
                    <td>{{ $p->robot->robot_id }}</td>

                    <td>{{ \Carbon\Carbon::parse($p->waktu_operasional)->format('d-m-Y, H:i') }}</td>

                    <td>
                        @php
                            $namaRute = $p->rutes->pluck('nama_tempat')->toArray();
                        @endphp
                        {{ implode(' → ', $namaRute) }}
                    </td>

                    <td class="
                        @if ($p->status == 'Berlangsung') txt-progress
                        @elseif($p->status == 'Menunggu') txt-waiting
                        @elseif($p->status == 'Dibatalkan') txt-cancelled
                        @else txt-done @endif
                    ">
                        {{ $p->status }}
                    </td>

                    <td>
                        <!-- Row Aksi 1 -->
                        <div class="action-row">
                            <button class="btn-start" onclick="openModal('modalMulai{{ $p->id }}')">
                                <i class="fas fa-play"></i> Mulai
                            </button>

                            <button class="btn-done" onclick="openModal('modalSelesai{{ $p->id }}')">
                                <i class="fas fa-check"></i> Selesai
                            </button>

                            <button class="btn-cancel" onclick="openModal('modalBatal{{ $p->id }}')">
                                <i class="fas fa-times"></i> Batalkan
                            </button>
                        </div>

                        <!-- Row Aksi 2 -->
                        <div class="action-row mt-1">
                            <button class="btn-detail" onclick="openModal('modalDetail{{ $p->id }}')">
                                <i class="fas fa-eye"></i> Detail
                            </button>

                            <button class="btn-edit" onclick="openModal('modalEdit{{ $p->id }}')">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            <button class="btn-delete" onclick="openModal('modalHapus{{ $p->id }}')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- MODAL DETAIL -->
                <div class="custom-modal" id="modalDetail{{ $p->id }}">
                    <div class="modal-content detail-modal">
                        <button class="modal-x" onclick="closeModal('modalDetail{{ $p->id }}')">×</button>

                        <h3>Detail Penugasan</h3>

                        <label>Robot</label>
                        <div class="detail-box">{{ $p->robot->robot_id }}</div>

                        <label>Waktu Operasional</label>
                        <div class="detail-box">
                            {{ \Carbon\Carbon::parse($p->waktu_operasional)->format('d-m-Y H:i') }}
                        </div>

                        <label>Rute Patroli</label>
                        <ul>
                            @foreach ($p->rutes as $r)
                                <li>{{ $r->nama_tempat }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- MODAL MULAI -->
                <div class="custom-modal" id="modalMulai{{ $p->id }}">
                    <div class="modal-content small-modal">

                        <div class="modal-header">
                            <h3>Mulai Penugasan?</h3>
                            <button class="modal-x" onclick="closeModal('modalMulai{{ $p->id }}')">×</button>
                        </div>

                        <p>Robot akan mulai beroperasi.</p>

                        <form action="{{ route('penugasan.mulai', $p->id) }}" method="POST">
                            @csrf
                            <button class="btn-start">
                                <i class="fas fa-play"></i> Mulai
                            </button>
                        </form>

                    </div>
                </div>

                <!-- MODAL BATALKAN -->
                <div class="custom-modal" id="modalBatal{{ $p->id }}">
                    <div class="modal-content small-modal">

                        <div class="modal-header">
                            <h3>Batalkan Penugasan?</h3>
                            <button class="modal-x" onclick="closeModal('modalBatal{{ $p->id }}')">×</button>
                        </div>

                        <p>Penugasan ini akan dibatalkan.</p>

                        <form action="{{ route('penugasan.batalkan', $p->id) }}" method="POST">
                            @csrf
                            <button class="btn-cancel">
                                <i class="fas fa-times"></i> Batalkan
                            </button>
                        </form>

                    </div>
                </div>

                <!-- MODAL SELESAI -->
                <div class="custom-modal" id="modalSelesai{{ $p->id }}">
                    <div class="modal-content small-modal">

                        <div class="modal-header">
                            <h3>Tandai Selesai?</h3>
                            <button class="modal-x" onclick="closeModal('modalSelesai{{ $p->id }}')">×</button>
                        </div>

                        <p>Robot telah menyelesaikan penugasan.</p>

                        <form action="{{ route('penugasan.selesai', $p->id) }}" method="POST">
                            @csrf
                            <button class="btn-done">
                                <i class="fas fa-check"></i> Selesai
                            </button>
                        </form>

                    </div>
                </div>

                <!-- MODAL HAPUS -->
                <div class="custom-modal" id="modalHapus{{ $p->id }}">
                    <div class="modal-content small-modal">

                        <div class="modal-header">
                            <h3>Hapus Penugasan?</h3>
                            <button class="modal-x" onclick="closeModal('modalHapus{{ $p->id }}')">×</button>
                        </div>

                        <p>Data ini tidak bisa dipulihkan setelah dihapus.</p>

                        <form action="{{ route('penugasan.hapus', $p->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>

                    </div>
                </div>

                <!-- MODAL EDIT -->
                <div class="custom-modal" id="modalEdit{{ $p->id }}">
                    <div class="modal-content edit-modal">
                        <button class="modal-x" onclick="closeModal('modalEdit{{ $p->id }}')">×</button>

                        <h3>Edit Penugasan</h3>

                        <form action="{{ route('penugasan.update', $p->id) }}" method="POST">
                            @csrf

                            <label>ID Robot</label>
                            <input type="text" value="{{ $p->robot->robot_id }}" disabled>

                            <label>Waktu Operasional</label>
                            <input type="datetime-local" name="waktu_operasional"
                                   value="{{ \Carbon\Carbon::parse($p->waktu_operasional)->format('Y-m-d\TH:i') }}"
                                   required>

                            <label class="mt-3">Rute Patroli</label>

                            @foreach ($p->rutes as $idx => $rute)
                                <div class="form-group">
                                    <label>Titik {{ $idx + 1 }}</label>
                                    <select name="rute_ids[]" required>
                                        @foreach ($rutes as $r)
                                            <option value="{{ $r->id }}" {{ $r->id == $rute->id ? 'selected' : '' }}>
                                                {{ $r->nama_tempat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach

                            <button type="submit" class="btn-save-blue">Simpan</button>
                        </form>
                    </div>
                </div>

            @endforeach
            </tbody>

        </table>
    </div>

</div>

@endsection

@section('scripts')
<script>
    function openModal(id) {
        const el = document.getElementById(id);
        if (el) el.style.display = 'flex';
    }

    function closeModal(id) {
        const el = document.getElementById(id);
        if (el) el.style.display = 'none';
    }
</script>
@endsection
